<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use App\Models\Customer;
use App\Models\CustomerBankDetails;
use App\Models\CustomerTransactionHistory;

use Zainpay\SDK\Engine;
use Zainpay\SDK\ZainBox;
use Zainpay\SDK\VirtualAccount;
use Zainpay\SDK\Bank;

use Session;
use Exception;
use Carbon\Carbon;

use App\Mail\ForgotPasswordMail;
use App\Mail\VerifyEmail;

require base_path('vendor/autoload.php');

class CustomerController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function privacy(){
        return view('privacy');
    }

    // Deposit Check 
    public function merchantDeposit(Request $request){

        $payload = $request->getContent();

        // extract the Zainpay-Signature from header
        $signature = $request->header('Zainpay-Signature');
        $secretKey = env('ZAINPAY_SECRET_KEY');

        if ($this->verifySignature($payload, $signature, $secretKey)) {

            Log::info('Zainpay Event', array('payload' => $payload));

            $event = $request->input('event');
            $data = $request->input('data');

            switch($event){
                case 'deposit.success':
                    $acct_transfer = $data['beneficiaryAccountNumber'];
                    $amount_deposit = $data['depositedAmount'] / 100;
                    $amount_transfer = $data['amountAfterCharges'] / 100;
                    $payment_reference = $data['paymentRef'];
                    $charges = $amount_deposit - $amount_transfer;

                    // Handle deposit success event
                    $cust_id = CustomerBankDetails::select('cust_id')->where('acct_no', $acct_transfer)->pluck('cust_id')->first();
                    
                    if($cust_id){
                        // process payment
                        $customer = Customer::where('id', $cust_id)->first();
                        $cust_username = $customer->username;
                        $cust_wallet_balance = $customer->acct_balance;

                        // Check whether Transaction has been processed 
                        $check_transaction = CustomerTransactionHistory::where('reference', $payment_reference)->count();

                        if($check_transaction == 0){

                            // Yusuf Charges Lost 
                            $piccolopay_amount_payimg_to_customer = $amount_deposit - 50;
                            $deposit_profit = $amount_transfer - $piccolopay_amount_payimg_to_customer;

                            // Store Transaction History
                            $new_transaction = CustomerTransactionHistory::create([
                                'cust_id' => $cust_username,
                                'network_id' => 200,
                                'transaction_type' => 'Deposit',
                                'transaction_no' => $acct_transfer,
                                'transaction_amount' => $piccolopay_amount_payimg_to_customer,
                                'transaction_paid' => $amount_deposit,
                                'reference' => $payment_reference,
                                'profit' => $deposit_profit,
                                'status' => 1,
                            ]);

                            // Update Customer Wallet Balance 
                            $new_cust_acct_balance = $cust_wallet_balance + $piccolopay_amount_payimg_to_customer;
                            $update_cust_acct_bal = Customer::where('username', $cust_username)->update(['acct_balance' => $new_cust_acct_balance]);
                            
                            return response()->json(['message' => 'Transaction processed successfully'], 200);
                        }else{
                            return response()->json(['message' => 'Transaction already processed'], 200);
                        }
                    }else{
                        return response()->json(['message' => 'Account No not found'], 400);
                    }
                    break;
                case 'transfer.success':
                    $acct_transfer = $data['beneficiaryAccountNumber'];
                    $payment_reference = $data['txnRef'];
                    
                    // Check whether Transaction has been processed 
                    $check_transaction = CustomerTransactionHistory::where('transaction_no', $acct_transfer)->where('reference', $payment_reference)->count();

                    if($check_transaction == 0){
                        
                        // Update Transaction History 
                        $update_transaction_status = CustomerTransactionHistory::where('transaction_no', $acct_transfer)->where('reference', $payment_reference)
                        ->update(
                            [
                              'status' => 1, 
                            ]
                        );
                        
                        return response()->json(['message' => 'Transaction processed successfully'], 200);
                    }else{
                        return response()->json(['message' => 'Transaction already processed'], 200);
                    }

                    break;
                case 'transfer.failed':
                    // Handle Transfer fail event
                    $acct_transfer = $data['beneficiaryAccountNumber'];
                    $payment_reference = $data['txnRef'];
                    
                    // Check whether Transaction has been processed 
                    $check_transaction = CustomerTransactionHistory::where('transaction_no', $acct_transfer)->where('reference', $payment_reference)->count();

                    if($check_transaction == 0){
                        
                        // Update Transaction History 
                        $update_transaction_status = CustomerTransactionHistory::where('transaction_no', $acct_transfer)->where('reference', $payment_reference)
                        ->update(
                            [
                              'status' => 0, 
                            ]
                        );
                        
                        return response()->json(['message' => 'Transaction processed successfully'], 200);
                    }else{
                        return response()->json(['message' => 'Transaction already processed'], 200);
                    }

                    break;
                default:
                    return response()->json(['error' => 'Invalid event'], 400);
            }
            return response()->json(['message' => 'Webhook received'], 200);
        }

        return response()->json(['error' => 'Invalid signature'], 400);
    }

    // Verify Signature 
    private function verifySignature(string $payload, string $signature, string $secretKey): bool{
        // Generate the expected signature using the webhook payload and the secret key
        $expectedSignature =  hash_hmac('sha256', $payload, $secretKey);

        // Compare the expected and actual signatures
        return hash_equals($expectedSignature, $signature);
    }

    public function signUpPage(){
        return view('signup');
    }
    
    public function privacyPolicy(){
        return view('dashboard.privacy_policy');
    }
    
    public static function piccoloPayUSSD(Request $request){
        //$request->all();
        $text=$request->input('text');
        $session_id = $request->input('sessionId');
        $phone_number = $request->input('phoneNumber');
        $service_code = $request->input('serviceCode');
        $network_code = $request->input('networkCode');
        $level = explode("*", $text);
        //if (isset($text)) {
   
        if ( $text == "" ) {
            $response="CON Welcome John Doe\n";
            $response .= "1. Account Bal\n";
            $response .= "2. Transfer \n";
            $response .= "3. Airtime Recharge \n";
            $response .= "0. Exit";
        }
        if(isset($level[0]) && $level[0] == 1 && !isset($level[1]))
        {
            $response="END Your account Bal: \n";
            $response .=" #50,000.00 \n";
        }
        if(isset($level[0]) && $level[0] == 2 && !isset($level[1]))
        {
            $response="CON Select Bank \n";
            $response .="1. GTB\n";
            $response .="2. First Bank \n";
            $response .="3. Access Bank \n";
            $response .="4. FCMB \n";
            $response .= "0. back";
        }
        if(isset($level[0]) && $level[0] == 2  && isset($level[1]) && !isset($level[2]))
        {
            $response="CON enter Acct. No.\n";
           
        }
        if(isset($level[0]) && $level[0] == 2  && isset($level[1])  && isset($level[2]))
        {
            
            $response="END Transaction Successful \n";
            $response .="thanks for patronage \n";
           
        }
            header('Content-type: text/plain');
            echo $response;
        //}
    }

    public function signUpForm(Request $request){
        
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|unique:customers,username',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{

            $fullname = $request->fullname;
            $username = $request->username;
            $email = $request->email;
            $phone = $request->phone;
            $password = Hash::make($request->password);
            $verification_code = Str::random(6);

            try{
                // Add Customer 
                $new_customer = Customer::create([
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'verification_code' => $verification_code,
                    'phone' => $phone,
                    'password' => $password,
                ]);

                try{       
                    $email = Customer::select('email')->where('cust_status', 1)->where('username', $request->username)->where('email', $request->email)->where('phone', $request->phone)->pluck('email')->first();

                    $cust = Customer::where('email', $email)->firstOrFail();
                    
                    $username = $request->username;
                    
                    Session::put('verification_code', $verification_code);
                    Session::put('email', $email);
                    Session::put('username', $username);
                    
                    if($cust){
                        Mail::to($email)->send(new VerifyEmail($email));
                        return response()->json([
                            "status" => true, 
                            "redirect" => url('/confirm/account')
                        ]);
                    }else{
                        return response()->json([
                            "status" => true, 
                            'message' => 'Email was not sent, please try again...',
                        ]);
                    }   
                }catch(Expection $e){
                    return response()->json([
                        'status' => true,
                        'message' => 'Please try again later! ('.$e.')'
                    ]);
                }
            }catch(Expection $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later! ('.$e.')'
                ]);
            }
        }
    }

    public function confirmAccount(){
        $email = Session::get('email'); 
        $username = Session::get('username');
        return view('verify_account', compact('email', 'username'));
    }

    public function confirmAccountConfirm(Request $request){

        $validator = Validator::make($request->all(), [
            'verification_code' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            $username = $request->username;
            $email = $request->email;

            $cust = Customer::where('verification_code', $request->verification_code)->where('cust_status', 1)->where('username', $request->username)->where('email', $request->email)->first();

            $username = $cust->username;
            $password = $cust->password;
            
            $input['verification_status'] = 1;
                            
            if($cust->update($input)){

                $cust_id = $cust->id;
                // Check if Customer has an account 
                $check_if_user_has_an_account = CustomerBankDetails::where('cust_id', $cust_id)->where('bank_name', 'wemaBank')->count();

                if($check_if_user_has_an_account == 0){
                    // Create Customer Virtual Wallet Using ZainPay API     
                        require base_path('vendor/autoload.php');
    
                        Engine::setMode(Engine::MODE_PRODUCTION);
                        Engine::setToken(env('ZAINPAY_BEARER_TOKEN'));
    
                        $response = VirtualAccount::instantiate()->createVirtualAccount(
                            'wemaBank',            
                            '22175618554',         
                            '-PiccoloPay',         
                            $username,             
                            $email,                
                            '08068593127',                   
                            '27-07-1993',                    
                            'M',                             
                            'Farawa Layout Kano',   
                            'Mr',                            
                            'Kano',                          
                            env('ZAINPAY_BOX')                   
                        );
    
                        if($response->hasSucceeded()){
    
                            $data = $response->getData();
    
                            if(!empty($data)){
                                // Handle the API response as needed
                                $acct_no = $data['accountNumber'];
                                $acct_name = $data['accountName'];
                                $bank_name = $data['bankName'];
    
                                // Store Customer Bank Details
                                try{
                                    $cust_bank_details = CustomerBankDetails::create([
                                        'cust_id' => $cust_id,
                                        'bank_name' => $bank_name,
                                        'acct_name' => $acct_name,
                                        'acct_no' => $acct_no,
                                        'gateway' => 'Zainpay',
                                    ]);
                                    
                                    // Log In Customer 
                                    try{
                                        if($cust){
                                            // Optionally, check if the account is active
                                            if($cust->cust_status == '1') {
                                                
                                                // Log the user in using their ID
                                                Auth::loginUsingId($cust->id);
                                
                                                // Regenerate session to prevent session fixation attacks
                                                $request->session()->regenerate();
                                
                                                return response()->json([
                                                    "status" => true,
                                                    "redirect" => url('/dashboard/index'),
                                                    "message" => 'Welcome to PiccoloPay!'
                                                ]);
                                            }else{
                                                return response()->json([
                                                    'status' => false,
                                                    'message' => 'Account is not active!'
                                                ]);
                                            }
                                        }else{
                                            return response()->json([
                                                'status' => false,
                                                'message' => 'Invalid Account!'
                                            ]);
                                        }
                                    }catch(Exception $e){
                                        return response()->json([
                                            'status' => false,
                                            'message' => 'Error: Login. Please try again!'
                                        ]);
                                    }
                                }catch(Exception $e){
                                    return response()->json([
                                        'status' => false,
                                        'message' => 'Error: Can\'t add bank details. Please try again!'
                                    ]);
                                }
                            }else{
                                // If the Customer Acct No is not generated 
                                $delete_cust = Customer::where('id', $cust_id)->delete();
                                
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Error Creating Virutal Account, Please try again!'
                                ]);
                            }
                        }else{
                            // If the Customer Acct No is not generated 
                            $delete_cust = Customer::where('id', $cust_id)->delete();
                            
                            return response()->json([
                                'status' => false,
                                'message' => 'Error Creating Virutal Account, Please try again!'
                            ]);
                        }
                    // End of Create Customer Virtual Wallet Using ZainPay API
                }else{
                    // Log in Customer 
                    try{
                        if($cust){
                            // Optionally, check if the account is active
                            if($cust->cust_status == '1') {
                                
                                // Log the user in using their ID
                                Auth::loginUsingId($cust->id);
                
                                // Regenerate session to prevent session fixation attacks
                                $request->session()->regenerate();
                
                                return response()->json([
                                    "status" => true,
                                    "redirect" => url('/dashboard/index'),
                                    "message" => 'Welcome to PiccoloPay!'
                                ]);
                            }else{
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Account is not active!'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'status' => false,
                                'message' => 'Invalid Account!'
                            ]);
                        }
                    }catch(Exception $e){
                        return response()->json([
                            'status' => false,
                            'message' => 'Error: Login. Please try again!'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Invalid Verification Code'
                ]);
            }

        }
    }

    public function createFCMBAccount(){
        $customers_list = Customer::orderby('id', 'asc')->where('username', 'not like', '%\_%')->get();
        
        foreach($customers_list as $cust){
            $cust_id = $cust->id;
            $username = $cust->username;
            $email = $cust->email;
            $phone = $cust->phone;
            
            // Check if User has a FCMB account 
            $check = CustomerBankDetails::where('cust_id', $cust_id)->where('bank_name', 'fcmb')->count();

            if($check == 0){
                // Create Customer Virtual Wallet Using ZainPay API 
                    
                require base_path('vendor/autoload.php');

                Engine::setMode(Engine::MODE_PRODUCTION);
                Engine::setToken(env('ZAINPAY_BEARER_TOKEN'));

                $response = VirtualAccount::instantiate()->createVirtualAccount(
                    'fcmb',            
                    '22175618554',         
                    '-PiccoloPay',         
                    $username,             
                    $email,                
                    '08068593127',                   
                    '27-07-1993',                    
                    'M',                             
                    'Farawa Layout Kano',   
                    'Mr',                            
                    'Kano',                          
                    env('ZAINPAY_BOX')                   
                );

                if($response->hasSucceeded()){

                    $data = $response->getData();
                    
                    if(!empty($data)){
                        // Handle the API response as needed
                        $acct_no = $data['accountNumber'];
                        $acct_name = $data['accountName'];
                        $bank_name = $data['bankName'];

                        // Store Customer Bank Details
                        try{
                            $cust_bank_details = CustomerBankDetails::create([
                                'cust_id' => $cust_id,
                                'bank_name' => $bank_name,
                                'acct_name' => $acct_name,
                                'acct_no' => $acct_no,
                                'gateway' => 'Zainpay',
                            ]);
                                    
                        }catch(Exception $e){
                            return response()->json([
                                'status' => false,
                                'message' => 'Error: Can\'t add bank details. Please try again!'
                            ]);
                        }
                    }else{
                        
                        return response()->json([
                            'status' => false,
                            'message' => 'Error Creating Virutal Account, Please try again II!'
                        ]);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Error Creating Virutal Account, Please try again I! - ' .$response->getErrorMessage()
                    ]);
                }
                
            // End of Create Customer Virtual Wallet Using ZainPay API
            
            }
        }
        
        dd('Accounts Created');

    }

    public function loginPage(){
        return view('login');
    }

    public function loginForm(Request $request){
        
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{

            $username = $request->username;
            $password = $request->password;
            $verification_code = Str::random(6);

            try{
                $cust_account_status = Customer::where('username', $request->username)->where('verification_status', '1')->count();
                // Check if Customer has verify account 
                if($cust_account_status == 1){
                    if(Auth::guard('web')->attempt($request->only(["username", "password"]))) {
                        try{
                            $cust_status = Customer::where('username', $request->username)->where('cust_status', '1')->count();
                            
                            if($cust_status == 1){
                                $request->session()->regenerate();
                                return response()->json([
                                    "status" => true, 
                                    "redirect" => url('/dashboard/index'),
                                    "message" => 'Welcome to PiccoloPay!'
                                ]);
                            }else{
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Account not active!'
                                ]);
                            }       
                        }catch(Exception $e){
                            return response()->json([
                                'status' => false,
                                'message' => $e->getMessage()
                            ]);            
                        }
                    }else{
                        return response()->json([
                            "status" => false,
                            "errors" => 'Wrong email & password combination!'
                        ]);
                    }
                }else{
                    
                    $input['verification_code'] = $verification_code;

                    $cust = Customer::where('cust_status', 1)->where('username', $request->username)->first();
                    
                    $cust->update($input);
                    
                    try{       
                        $email = Customer::select('email')->where('cust_status', 1)->where('username', $request->username)->where('email', $cust->email)->pluck('email')->first();
    
                        $cust = Customer::where('email', $email)->firstOrFail();
                        
                        $username = $request->username;
                        
                        Session::put('verification_code', $verification_code);
                        Session::put('email', $email);
                        Session::put('username', $username);
                        
                        if($cust){
                            Mail::to($email)->send(new VerifyEmail($email));
                            return response()->json([
                                "status" => true, 
                                "redirect" => url('/confirm/account'),
                                "message" => 'Check your email for your verification code!',
                            ]);
                        }else{
                            return response()->json([
                                "status" => true, 
                                'message' => 'Email was not sent, please try again...',
                            ]);
                        }   
                    }catch(Expection $e){
                        return response()->json([
                            'status' => true,
                            'message' => 'Please try again later! ('.$e.')'
                        ]);
                    }
                }
            }catch(Expection $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later! ('.$e.')'
                ]);
            }
        }
    }

    // Logout 
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    //Forgot Password
    public function forgotPassword(){
        return view('forgotpassword');
    } 

    // Forgot Password Submit 
    public function forgotPasswordForm(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            try{
                $cust_status = Customer::where('cust_status', 1)->where('username', $request->username)->where('email', $request->email)->where('phone', $request->phone)->count();
                    if($cust_status == 1){
                        try{       
                            $email = Customer::select('email')->where('cust_status', 1)->where('username', $request->username)->where('email', $request->email)->where('phone', $request->phone)->pluck('email')->first();

                            $cust = Customer::where('email', $email)->firstOrFail();
                            
                            $autopass = Str::random(12);
                            
                            $input['password'] = Hash::make($autopass);
                            
                            Session::put('password', $autopass);
                            
                            if($cust->update($input)){
                                Mail::to($email)->send(new ForgotPasswordMail($email));
                                
                                return response()->json([
                                    "status" => true, 
                                    'message' => "Check your email for your new password..."
                                ]);
                            }else{
                                return response()->json([
                                    "status" => true, 
                                    'message' => 'Email was not sent, please try again...',
                                ]);
                            }
                            
                        }catch(Expection $e){
                            return response()->json([
                                'status' => true,
                                'message' => 'Please try again later! ('.$e.')'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status' => true,
                            'message' => 'Invalid details... try again'
                        ]);
                    }
            }catch(Exception $e){
                return response()->json([
                    'status' => true,
                    'message' => $e->getMessage()
                ]);            
            }
        }
    }

    // Dashboard 
    public function dashboard(){
        $customer = Auth::guard('web')->user();
        
        $cust_account = CustomerBankDetails::select('acct_no')->where('cust_id', $customer->id)->pluck('acct_no')->first();
        
        $cust_count = Customer::where('cust_status', 1)->count();
        
        $cust_active = Customer::where('acct_balance', '>', 0)->count();
        
        $cust_verify_account_count = Customer::where('verification_status', 1)->count();
        
        $cust_balance = Customer::select('acct_balance')->sum('acct_balance');

        $transaction_count = CustomerTransactionHistory::where('cust_id', $customer->username)
            ->where('status', 1)
            ->whereMonth('created_at', date('m'))  
            ->whereYear('created_at', date('Y')) 
            ->count();
        
        $amount_spent = CustomerTransactionHistory::where('cust_id', $customer->username)
            ->where('transaction_type', 'Data')
            ->where('status', 1)
            ->whereMonth('created_at', date('m'))  
            ->whereYear('created_at', date('Y'))
            ->sum('transaction_paid');
        
        $profit_made = CustomerTransactionHistory::where('status', 1)
            ->where('transaction_type', 'Data')
            ->whereMonth('created_at', date('m'))  
            ->whereYear('created_at', date('Y'))
            ->sum('profit'); 

        if(!empty($customer->pin)){

            // Function to fetch user data from API
                function fetchUserData($url, $tokenKey) {
                    try {
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => env($tokenKey),
                        ])->get($url);

                        return $response->successful() ? $response->json() : null;
                    } catch (Exception $e) {
                        return null;
                    }
                }
            // End of Function to fetch user data from API

            // Check if customer is authenticated
            if (!$customer) {
                return redirect()->route('login');
            }

            // Default variables for the view
            $viewData = [
                'transaction_count', 'amount_spent', 'cust_balance', 'customer'
            ];

            // Fetch additional data only if the customer type is 1
            if ($customer->cust_type == 1) {

                require base_path('vendor/autoload.php');

                Engine::setMode(Engine::MODE_PRODUCTION);
                Engine::setToken(env('ZAINPAY_BEARER_TOKEN'));

                // Getting ISA Balance 
                    $response = VirtualAccount::instantiate()->balance(
                        '7966155227' //virtualAccoutNumber - required (string)
                    );

                    if($response->hasSucceeded()){
                        $data = $response->getData();
                
                        if(!empty($data)){
                            // Handle the API response as needed
                            $isa_acct_name = $data['accountName'];
                            $isa_acct_no = $data['accountNumber'];
                            $isa_balance_amount = $data['balanceAmount'] / 100;
                            $isa_bank_code = $data['bankCode'];
                            $isa_bank_type = $data['bankType'];
                        }
                    }else{
                        $isa_acct_name = '';
                        $isa_acct_no = '';
                        $isa_balance_amount = '';
                        $isa_bank_code = '';
                        $isa_bank_type = '';
                    }
                // End of Getting ISA Balance

                // Getting Bank List 
                    $response = Bank::instantiate()->list();
                    if($response->hasSucceeded()){
                        $bank_lists = $response->getData();
                        $bank_lists = $bank_lists ?? [];
                    }else{
                        $bank_lists = [];
                    }
                // End of Getting Bank List

                $asbdataResponse = fetchUserData('https://asbdata.com/api/user/', 'ASB_DATA_BEARER_TOKEN');
                $husmoResponse = fetchUserData('https://www.husmodata.com/api/user/', 'HUSMO_BEARER_TOKEN');

                if (!$asbdataResponse || !$husmoResponse) {
                    return abort(500, 'Please try again later!');
                }

                // Extract relevant details
                $asbdata_account_info = $asbdataResponse['user'];
                $account_info = $husmoResponse['user'];

                $total_profit = ($isa_balance_amount + $account_info['wallet_balance'] + $asbdata_account_info['wallet_balance']) - $cust_balance;

                // Additional variables for compact()
                $viewData = array_merge($viewData, [
                    'total_profit', 'isa_acct_name', 'isa_acct_no', 'isa_balance_amount', 'isa_bank_code', 'isa_bank_type', 'bank_lists',
                    'asbdata_account_info', 'asbdata_dataPlansMtnSme', 'asbdata_dataPlansGloAll', 'asbdata_dataPlansAirtelAll',
                    'asbdata_dataPlans9MobileAll', 'account_info', 'notification', 'exams', 'dataPlansMtnCorporate',
                    'dataPlansMtnSme', 'dataPlansGloAll', 'dataPlansAirtelAll', 'dataPlans9MobileAll', 'cablePlanGotv',
                    'cablePlanDstv', 'cablePlanStartime', 'rechargePinMtn', 'rechargePinGlo', 'rechargePinAirtel',
                    'rechargePin9Mobile', 'profit_made', 'cust_count', 'cust_active', 'cust_verify_account_count'
                ]);

                // Assign extracted data to variables
                extract([
                    'notification' => $husmoResponse['notification'],
                    'exams' => $husmoResponse['Exam'],
                    'asbdata_dataPlansMtnSme' => $asbdataResponse['Dataplans']['MTN_PLAN']['SME'],
                    'asbdata_dataPlansGloAll' => $asbdataResponse['Dataplans']['GLO_PLAN']['ALL'],
                    'asbdata_dataPlansAirtelAll' => $asbdataResponse['Dataplans']['AIRTEL_PLAN']['ALL'],
                    'asbdata_dataPlans9MobileAll' => $asbdataResponse['Dataplans']['9MOBILE_PLAN']['ALL'],
                    'dataPlansMtnCorporate' => $husmoResponse['Dataplans']['MTN_PLAN']['ALL'],
                    'dataPlansMtnSme' => $husmoResponse['Dataplans']['MTN_PLAN']['SME'],
                    'dataPlansGloAll' => $husmoResponse['Dataplans']['GLO_PLAN']['ALL'],
                    'dataPlansAirtelAll' => $husmoResponse['Dataplans']['AIRTEL_PLAN']['ALL'],
                    'dataPlans9MobileAll' => $husmoResponse['Dataplans']['9MOBILE_PLAN']['ALL'],
                    'cablePlanGotv' => $husmoResponse['Cableplan']['GOTVPLAN'],
                    'cablePlanDstv' => $husmoResponse['Cableplan']['DSTVPLAN'],
                    'cablePlanStartime' => $husmoResponse['Cableplan']['STARTIME'],
                    'rechargePinMtn' => $husmoResponse['recharge']['mtn_pin'],
                    'rechargePinGlo' => $husmoResponse['recharge']['glo_pin'],
                    'rechargePinAirtel' => $husmoResponse['recharge']['airtel_pin'],
                    'rechargePin9Mobile' => $husmoResponse['recharge']['9mobile_pin'],
                ]);
            }

            // Render the view with extracted data
            return view('dashboard.index', compact(...$viewData));

        }else{
            return redirect()->route('cust-account');
        }
    }

    // Data View 
    public function dataView(){
        $customer = Auth::guard('web')->user();

        // Redirect if customer is not authenticated
        if (!$customer) {
            return redirect()->route('login');
        }

        // Redirect if PIN is not set
        if (empty($customer->pin)) {
            return redirect()->route('cust-account');
        }

        // Fetch user data from API
        function fetchUserData($url, $tokenKey){
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => env($tokenKey),
                ])->get($url);

                return $response->successful() ? $response->json() : null;
            } catch (Exception $e) {
                return null;
            }
        }

        // Default variables for the view
        $viewData = [];

        $asbdataResponse = fetchUserData('https://asbdata.com/api/user/', 'ASB_DATA_BEARER_TOKEN');
        $husmoResponse = fetchUserData('https://www.husmodata.com/api/user/', 'HUSMO_BEARER_TOKEN');

        if(!$asbdataResponse || !$husmoResponse) {
            return abort(500, 'Please try again later!');
        }

        // Extract user information
        $asbdata_account_info = $asbdataResponse['user'];
        $account_info = $husmoResponse['user'];

        // Check if required data exists before accessing array keys
        $viewData = [
            'customer' => $customer,
            'asbdata_account_info' => $asbdata_account_info,
            'account_info' => $account_info,
            'notification' => $husmoResponse['notification'] ?? [],
            'exams' => $husmoResponse['Exam'] ?? [],
            'asbdata_dataPlansMtnSme' => $asbdataResponse['Dataplans']['MTN_PLAN']['SME'] ?? [],
            'asbdata_dataPlansAirtelAll' => $asbdataResponse['Dataplans']['AIRTEL_PLAN']['ALL'] ?? [],
            'asbdata_dataPlansGloAll' => $asbdataResponse['Dataplans']['GLO_PLAN']['ALL'] ?? [],
            'asbdata_dataPlans9MobileAll' => $asbdataResponse['Dataplans']['9MOBILE_PLAN']['ALL'] ?? [],
            'dataPlansMtnCorporate' => $husmoResponse['Dataplans']['MTN_PLAN']['ALL'] ?? [],
            'dataPlansMtnSme' => $husmoResponse['Dataplans']['MTN_PLAN']['SME'] ?? [],
            'dataPlansGloAll' => $husmoResponse['Dataplans']['GLO_PLAN']['ALL'] ?? [],
            'dataPlansAirtelAll' => $husmoResponse['Dataplans']['AIRTEL_PLAN']['ALL'] ?? [],
            'dataPlans9MobileAll' => $husmoResponse['Dataplans']['9MOBILE_PLAN']['ALL'] ?? [],
            'cablePlanGotv' => $husmoResponse['Cableplan']['GOTVPLAN'] ?? [],
            'cablePlanDstv' => $husmoResponse['Cableplan']['DSTVPLAN'] ?? [],
            'cablePlanStartime' => $husmoResponse['Cableplan']['STARTIME'] ?? [],
            'rechargePinMtn' => $husmoResponse['recharge']['mtn_pin'] ?? '',
            'rechargePinGlo' => $husmoResponse['recharge']['glo_pin'] ?? '',
            'rechargePinAirtel' => $husmoResponse['recharge']['airtel_pin'] ?? '',
            'rechargePin9Mobile' => $husmoResponse['recharge']['9mobile_pin'] ?? '',
        ];

        // Return view with data
        return view('dashboard.data_page', $viewData);
    }

    // Buy Data 
    public function dataPurchase(Request $request){
        $cust_verification_status = Auth::guard('web')->user()->verification_status;
        $cust_id = Auth::guard('web')->user()->username;
        $cust_pin = Auth::guard('web')->user()->pin;
        $cust_acct_balance = Auth::guard('web')->user()->acct_balance;

        $network_id = $request->network_id;
        $data_unit = $request->data_unit;
        $transaction_no = $request->transaction_no;
        $plan_id = $request->plan_type;
        $transaction_amount = $request->transaction_amount;
        $transaction_buying = $request->transaction_buying;
        $transaction_reference = $request->transaction_reference;
        $transaction_pin = $request->pin;

        $profit = $transaction_amount - $transaction_buying;

        if(empty($plan_id)){
            $plan_id = $request->plan_type_cor;
        }

        // Check if PIN is correct 
        if(Hash::check($transaction_pin, $cust_pin)){
            
            // Check Account Balance 
            if($cust_acct_balance >= $transaction_amount){
                
                $new_cust_acct_balance = $cust_acct_balance - $transaction_amount;

                $new_transaction = CustomerTransactionHistory::create([
                    'cust_id' => $cust_id,
                    'network_id' => $network_id,
                    'data_unit' => $data_unit,
                    'transaction_type' => 'Data',
                    'transaction_no' => $transaction_no,
                    'transaction_amount' => $transaction_buying,
                    'transaction_paid' => $transaction_amount,
                    'profit' => $profit,
                    'reference' => $transaction_reference,
                    'status' => 0,
                ]);

                // Update Cust Acct Balance 
                $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $new_cust_acct_balance]);
                
                // Purchase DATA Using ASBDATA API 
    
                    // JSON payload for the request
                    $payload = [
                        "network" => $network_id,
                        "mobile_number" => $transaction_no,
                        "plan" => $plan_id,
                        "Ported_number" => true
                    ];
    
                    try{
                        $apiEndpoint = 'https://asbdata.com/api/data/';
            
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => env('ASB_DATA_BEARER_TOKEN'),
                        ])->timeout(30)->post($apiEndpoint, $payload);
            
                        // Check if the request was successful
                        if($response->successful()) {
                            // Get the response body as an array
                            $data = $response->json();
            
                            // Return the response data
                            if($data['Status'] == 'successful'){
                                // Update Transaction Status 
                                $update_transaction_status = CustomerTransactionHistory::where('id', $new_transaction->id)->update(['status' => 1, 'reference' => $data['id']]);
                                
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Data sent. Mun gode sosai.',
                                ]);
                            }else{
                                // If Transaction Failed
                                if($cust_verification_status == 1){
                                    $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance]);
                                    
                                    $new_transaction = CustomerTransactionHistory::create([
                                        'cust_id' => $cust_id,
                                        'network_id' => $network_id,
                                        'data_unit' => $data_unit,
                                        'transaction_type' => 'Refund',
                                        'transaction_no' => $transaction_no,
                                        'transaction_amount' => $transaction_buying,
                                        'transaction_paid' => $transaction_amount,
                                        'profit' => 0,
                                        'reference' => 'Data-Refund-'.$transaction_reference,
                                        'status' => 1,
                                    ]);
                                } 
                                
                                return response()->json([
                                    'status' => true,
                                    'message' => $data['api_response'],
                                ]);
                            }
                        }else{
                            // If Transaction Failed 
                            if($cust_verification_status == 1){
                                $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance]);
                                
                                $new_transaction = CustomerTransactionHistory::create([
                                    'cust_id' => $cust_id,
                                    'network_id' => $network_id,
                                    'data_unit' => $data_unit,
                                    'transaction_type' => 'Refund',
                                    'transaction_no' => $transaction_no,
                                    'transaction_amount' => $transaction_buying,
                                    'transaction_paid' => $transaction_amount,
                                    'profit' => 0,
                                    'reference' => 'Data-Refund-'.$transaction_reference,
                                    'status' => 1,
                                ]);
                            }

                            // Handle unsuccessful request
                            return response()->json([
                                'status' => false,
                                'message' => 'Please try again later!: ' .$response->status(),
                            ]);
                        }
                    }catch(RequestException $e) {
                        // If Transaction Failed 
                        if($cust_verification_status == 1){
                            $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance]);
                            
                            $new_transaction = CustomerTransactionHistory::create([
                                'cust_id' => $cust_id,
                                'network_id' => $network_id,
                                'data_unit' => $data_unit,
                                'transaction_type' => 'Refund',
                                'transaction_no' => $transaction_no,
                                'transaction_amount' => $transaction_buying,
                                'transaction_paid' => $transaction_amount,
                                'profit' => 0,
                                'reference' => 'Data-Refund-'.$transaction_reference,
                                'status' => 1,
                            ]);
                        }

                        // Log the error
                        \Log::error('HTTP Request Error: ' . $e->getMessage());
            
                        // Handle HTTP request-specific errors
                        return response()->json([
                            'status' => false,
                            'message' => 'Please try again later! (' .$e->getMessage(). ')',
                        ]);
                    }
            
                // End of Purchase DATA Using ASBDATA API
            }else{
                return response()->json([
                    "status" => true, 
                    'message' => "Oops, Account Balance Low."
                ]);
            }
        }else{
            return response()->json([
                "status" => true, 
                'message' => "Incorrect Pin"
            ]);
        }

    }

    // Buy Airtime 
    public function airtimePurchase(Request $request){
        
        $cust_id = Auth::guard('web')->user()->username;
        $cust_pin = Auth::guard('web')->user()->pin;
        $cust_acct_balance = Auth::guard('web')->user()->acct_balance;

        $network_id = $request->network;
        $transaction_amount = $request->amount;
        $transaction_no = $request->mobile_number;
        $airtime_type = $request->airtime_type;
        $transaction_pin = $request->pin;
        $transaction_reference = $request->network.' - '.$request->amount;

        // Check if PIN is correct 
        if(Hash::check($transaction_pin, $cust_pin)){
         
            // Check Account Balance 
            if($cust_acct_balance >= $transaction_amount){
                $new_cust_acct_balance = $cust_acct_balance - $transaction_amount;
                
                $new_transaction = CustomerTransactionHistory::create([
                    'cust_id' => $cust_id,
                    'network_id' => $network_id,
                    'transaction_type' => 'Airtime',
                    'transaction_no' => $transaction_no,
                    'transaction_amount' => $transaction_amount ,
                    'transaction_paid' => $transaction_amount,
                    'reference' => $transaction_reference,
                    'status' => 0,
                ]);

                // Update Cust Acct Balance 
                $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $new_cust_acct_balance]);
    
                // Purchase Airtime Using Geodnatech API 
    
                    // JSON payload for the request
                    $payload = [
                        "network" => $network_id,
                        "amount" => $transaction_amount,
                        "mobile_number" => $transaction_no,
                        "Ported_number" => true,
                        "airtime_type" => $airtime_type
                    ];
    
                    try{
                        $apiEndpoint = 'https://www.husmodata.com/api/topup/';
            
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => env('HUSMO_BEARER_TOKEN'),
                        ])->post($apiEndpoint, $payload);
            
                        // Check if the request was successful
                        if($response->successful()) {
                            // Get the response body as an array
                            $data = $response->json();
                            
                            // Return the response data
                            if($data['Status'] == 'successful'){
                                $profit = $transaction_amount - $data['paid_amount'];

                                $update_transaction_status = CustomerTransactionHistory::where('id', $new_transaction->id)->update([
                                    'status' => 1, 
                                    'transaction_amount' => $data['paid_amount'],
                                    'reference' => $data['id'],
                                    'profit' => $profit
                                ]);

                                return response()->json([
                                    'status' => true,
                                    'message' => 'Airtime sent. Mun gode sosai.',
                                ]);
                            }else{
                                // If Transaction Failed 
                                // $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
                                // $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
                                // $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);
                           
                                // $new_transaction = CustomerTransactionHistory::create([
                                //     'cust_id' => $cust_id,
                                //     'network_id' => $network_id,
                                //     'data_unit' => $data_unit,
                                //     'transaction_type' => 'Refund',
                                //     'transaction_no' => $transaction_no,
                                //     'transaction_amount' => $transaction_amount,
                                //     'transaction_paid' => $transaction_amount,
                                //     'profit' => 0,
                                //     'reference' => 'Airtime-Refund-'.$transaction_reference,
                                //     'status' => 1,
                                // ]);
                                
                                return response()->json([
                                    'status' => true,
                                    'message' => $data['api_response'],
                                ]);
                            }
    
                        }else{
                            // If Transaction Failed 
                            // $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
                            // $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
                            // $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);

                            // $new_transaction = CustomerTransactionHistory::create([
                            //     'cust_id' => $cust_id,
                            //     'network_id' => $network_id,
                            //     'data_unit' => $data_unit,
                            //     'transaction_type' => 'Refund',
                            //     'transaction_no' => $transaction_no,
                            //     'transaction_amount' => $transaction_amount,
                            //     'transaction_paid' => $transaction_amount,
                            //     'profit' => 0,
                            //     'reference' => 'Airtime-Refund-'.$transaction_reference,
                            //     'status' => 1,
                            // ]);

                            // Handle unsuccessful request
                            return response()->json([
                                'status' => false,
                                'message' => 'Please try again later!: ' . $response->status(),
                            ]);
                        }
                    }catch(RequestException $e) {
                        // If Transaction Failed 
                        // $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
                        // $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
                        // $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);

                        // $new_transaction = CustomerTransactionHistory::create([
                        //     'cust_id' => $cust_id,
                        //     'network_id' => $network_id,
                        //     'data_unit' => $data_unit,
                        //     'transaction_type' => 'Refund',
                        //     'transaction_no' => $transaction_no,
                        //     'transaction_amount' => $transaction_amount,
                        //     'transaction_paid' => $transaction_amount,
                        //     'profit' => 0,
                        //     'reference' => 'Airtime-Refund-'.$transaction_reference,
                        //     'status' => 1,
                        // ]);

                        // Log the error
                        \Log::error('HTTP Request Error: ' . $e->getMessage());
            
                        // Handle HTTP request-specific errors
                        return response()->json([
                            'status' => false,
                            'message' => 'Please try again later! (' . $e->getMessage() . ')',
                        ]);
                    }
            
                // End of Purchase Airtime Using HUMSO API
            }else{
                return response()->json([
                    "status" => true, 
                    'message' => "Oops, Account Balance Low"
                ]);
            }

        }else{
            return response()->json([
                "status" => true, 
                'message' => "Incorrect Pin"
            ]);
        }
    }

    // Verify Account Number 
    public function verfiyAccountNumber(Request $request){
        
        $bank_code = $request->bank_code;
        $account_number = $request->account_number;

        // Search Account Name Using ZainPay API 
        try{
            require base_path('vendor/autoload.php');

            Engine::setMode(Engine::MODE_PRODUCTION);
            Engine::setToken(env('ZAINPAY_BEARER_TOKEN'));

            // Getting Account Name 
                $response = Bank::instantiate()->accountNameEnquiry(
                    $bank_code,   //bankCode       - required (string)
                    $account_number //accountNumber  - required (string)
                );

                // Check if the request was successful
                if($response->hasSucceeded()) {
                    // Return the response data
                    $data = $response->getData();
                    
                    return response()->json([
                        'status' => true,
                        'message' => $data['accountName'],
                    ]);
    
                }else{
                    // Handle unsuccessful request
                    return response()->json([
                        'status' => false,
                        'message' => 'Name not found. Try again',
                    ]);
                }
            // End of Getting Account Name

        }catch(RequestException $e) {
            // Log the error
            \Log::error('HTTP Request Error: ' . $e->getMessage());

            // Handle HTTP request-specific errors
            return response()->json([
                'status' => false,
                'message' => 'Please try again later! (' . $e->getMessage() . ')',
            ]);
        }
    }

    // Fund Transfer 
    public function fundTransfer(Request $request){
        
        $destinationBankCode = $request->bankCode;
        $destinationAccountNumber =  $request->accountNumber;
        $amount =  $request->amountTransfer;
        $narration =  $request->amountNarration;
        $transaction_pin =  $request->custPin;

        $cust_id = Auth::guard('web')->user()->username;
        $cust_pin = Auth::guard('web')->user()->pin;
        $cust_acct_balance = Auth::guard('web')->user()->acct_balance;

        $network_id = 001;
        $transaction_amount = $amount;
        $transaction_no = $destinationAccountNumber;
        $txnRef = $destinationBankCode.'-'.$amount.'-'.date('dmY-His');
        $sourceAccountNumber = 7966155227;
        $sourceBankCode = 000017;
        $amount_transfer = $amount * 100;
        $narration = (!empty($narration)) ? $narration : 'Payment Settlement';

        require base_path('vendor/autoload.php');

        Engine::setMode(Engine::MODE_PRODUCTION);
        Engine::setToken(env('ZAINPAY_BEARER_TOKEN'));

        // Getting ISA Balance 
            $response = VirtualAccount::instantiate()->balance(
                '7966155227' //virtualAccoutNumber - required (string)
            );

            if($response->hasSucceeded()){
                $data = $response->getData();
        
                if(!empty($data)){
                    // Handle the API response as needed
                    $isa_acct_name = $data['accountName'];
                    $isa_acct_no = $data['accountNumber'];
                    $isa_balance_amount = $data['balanceAmount'];
                    $isa_bank_code = $data['bankCode'];
                    $isa_bank_type = $data['bankType'];
                }
            }else{
                $isa_acct_name = '';
                $isa_acct_no = '';
                $isa_balance_amount = '';
                $isa_bank_code = '';
                $isa_bank_type = '';
            }
        // End of Getting ISA Balance

        // Check if PIN is correct 
        if(Hash::check($transaction_pin, $cust_pin)){
            
            // Check ISA balance is sufficient 
            if($isa_balance_amount >= $amount_transfer){
                $new_transaction = CustomerTransactionHistory::create([
                    'cust_id' => $cust_id,
                    'network_id' => 001,
                    'transaction_type' => 'Fund Transfer',
                    'transaction_no' => $destinationAccountNumber,
                    'transaction_amount' => $transaction_amount,
                    'transaction_paid' => $transaction_amount,
                    'reference' => $txnRef,
                    'status' => 0,
                ]);

                // Fund Transfer Using ZainPay API 
                    // JSON payload for the request
                        // $payload = [
                        //     "destinationAccountNumber" => $destinationAccountNumber,
                        //     "destinationBankCode" => $destinationBankCode,
                        //     "amount" => $amount_transfer,
                        //     "sourceAccountNumber" => $sourceAccountNumber,
                        //     "sourceBankCode" => $sourceBankCode,
                        //     "zainboxCode" => env('ZAINPAY_BOX'),
                        //     "txnRef" => $txnRef,
                        //     "narration" => $narration,
                        //     "callbackUrl" => "https://piccolopay.com.ng/zainbox_live"
                        // ];
                        // try {
                        //     $apiEndpoint = 'https://api.zainpay.ng/bank/transfer/v2';

                        //     $response = Http::withHeaders([
                        //         'Content-Type' => 'application/json',
                        //         'Authorization' => env('ZAINPAY_BEARER_TOKEN'),
                        //     ])->post($apiEndpoint, $payload);

                        //     // Ensure we have a valid JSON response
                        //     if(!$response->ok()){
                        //         Log::error('API Request Failed', [
                        //             'status_code' => $response->status(),
                        //             'body' => $response->body(),
                        //         ]);

                        //         return response()->json([
                        //             'status' => false,
                        //             'message' => 'An error occurred, please try again later',
                        //         ]);
                        //     }

                        //     // Get response data safely
                        //     $data = $response->json('data', []);
                        //     $description = $response->json('description', 'No description provided');
                        //     $status = $data['status'] ?? null;

                        //     // Validate required fields
                        //     if (empty($data) || !isset($data['txnRef'])) {
                        //         return response()->json([
                        //             'status' => false,
                        //             'message' => 'Invalid response format from API',
                        //         ]);
                        //     }

                        //     // Process successful transaction
                        //     if ($status === 'success') {
                        //         $update_transaction_status = CustomerTransactionHistory::where('id', $new_transaction->id)
                        //             ->update([
                        //                 'status' => 1,
                        //                 'reference' => $data['txnRef']
                        //             ]);

                        //         return response()->json([
                        //             'status' => true,
                        //             'message' => $update_transaction_status ? $description : $description . ' (Transaction status update failed)',
                        //         ]);
                        //     }

                        //     // Handle failed transactions with failure reason
                        //     return response()->json([
                        //         'status' => false,
                        //         'message' => $description . ' - Reason: ' . ($data['failureReason'] ?? 'Unknown error'),
                        //     ]);

                        // } catch (Throwable $e) {
                        //     // Log the full error details
                        //     Log::error('HTTP Request Error', [
                        //         'error' => $e->getMessage(),
                        //         'trace' => $e->getTraceAsString(),
                        //     ]);

                        //     return response()->json([
                        //         'status' => false,
                        //         'message' => 'Please try again later! (' . $e->getMessage() . ')',
                        //     ]);
                        // }
                // Fund Transfer Using ZainPay API

                // Fund Transfer Using ZainPay API 
                    try{
                        // Fund Transfer
                            $response = Bank::instantiate()->transfer(
                                $destinationAccountNumber,                           
                                $destinationBankCode,                              
                                $amount_transfer,                                            
                                $sourceAccountNumber,                          
                                $sourceBankCode,                              
                                env('ZAINPAY_BOX'),                         
                                $txnRef,                       
                                $narration,                          
                                "https://piccolopay.com.ng/zainbox_live" 
                            );
            
                            // Check if the request was successful
                            if($response->hasSucceeded()) {
                                // Return the response data
                                $data = $response->getData();
                                
                                $update_transaction_status = CustomerTransactionHistory::where('id', $new_transaction->id)
                                    ->update(
                                        [
                                        'status' => 1, 
                                            'reference' => $txnRef
                                        ]
                                    );
                                
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Funds Transfer Successful',
                                ]);
                
                            }else{
                                // Handle unsuccessful request
                                return response()->json([
                                    'status' => false,
                                    'message' => 'An Error occurred, please try again later',
                                ]);
                            } 
                        // End of Fund Transfer 
                    }catch(RequestException $e) {
                        // Log the error
                        \Log::error('HTTP Request Error: ' . $e->getMessage());
            
                        // Handle HTTP request-specific errors
                        return response()->json([
                            'status' => false,
                            'message' => 'Please try again later! (' . $e->getMessage() . ')',
                        ]);
                    }
                // Fund Transfer Using ZainPay API
            }else{
                return response()->json([
                    "status" => true, 
                    'message' => "Oops, Insufficient Balance"
                ]);
            }
        }else{
            return response()->json([
                "status" => true, 
                'message' => "Incorrect Pin"
            ]);
        }

    }

    // Search Meter 
    public function electricitySearchMeter(Request $request){
        
        $disco_name = $request->disco_id;
        $meternumber = $request->meter_number;

        // Search Meter Using Husmodata API 
        try{
            $apiEndpoint = 'https://www.husmodata.com/ajax/validate_meter_number?meternumber='.$meternumber.'&disconame='.$disco_name.'&mtype=Prepaid';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => env('HUSMO_BEARER_TOKEN'),
            ])->get($apiEndpoint);

            // Check if the request was successful
            if($response->successful()) {
                // Return the response data
                
                $data = $response->json();
                
                if($data['invalid'] == false){
                    return response()->json([
                        'status' => true,
                        'message' => $data['name'].' ('.$data['address'].')',
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => $data['name'].' ('.$data['address'].')',
                    ]);
                }
            }else{
                // Handle unsuccessful request
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later!: ' . $response->status(),
                ]);
            }
        }catch(RequestException $e) {
            // Log the error
            \Log::error('HTTP Request Error: ' . $e->getMessage());

            // Handle HTTP request-specific errors
            return response()->json([
                'status' => false,
                'message' => 'Please try again later! (' . $e->getMessage() . ')',
            ]);
        }
    }

    // Buy Electricity 
    public function electricityPurchase(Request $request){
        $disco_name = $request->discoName;
        $meter_number =  $request->meterNumber;
        $amount =  $request->tokenAmount;
        $transaction_pin =  $request->custPin;

        $cust_id = Auth::guard('web')->user()->username;
        $cust_pin = Auth::guard('web')->user()->pin;
        $cust_acct_balance = Auth::guard('web')->user()->acct_balance;

        $network_id = $disco_name;
        $transaction_amount = $amount;
        $transaction_no = $meter_number;
        $transaction_reference = $disco_name.' - '.$amount;

        return response()->json([
            "status" => true, 
            'message' => "Feature coming soon..."
        ]);

        // Check if PIN is correct 
        // if(Hash::check(2564, $cust_pin)){
         
        //     // Check Account Balance 
        //     if($cust_acct_balance >= $transaction_amount){
        //         $new_cust_acct_balance = $cust_acct_balance - $transaction_amount;
                
        //         $new_transaction = CustomerTransactionHistory::create([
        //             'cust_id' => $cust_id,
        //             'network_id' => 914,
        //             // 'network_id' => $network_id,
        //             'transaction_type' => 'Electricity',
        //             'transaction_no' => $transaction_no,
        //             'transaction_amount' => 500,
        //             // 'transaction_amount' => $transaction_amount ,
        //             // 'transaction_paid' => $transaction_amount,
        //             'transaction_paid' => 200,
        //             'reference' => $transaction_reference,
        //             'status' => 0,
        //         ]);

        //         // Update Cust Acct Balance 
        //         $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $new_cust_acct_balance]);
    
        //         // Purchase Electricity Using Geodnatech API 
    
        //             // JSON payload for the request
        //             $payload = [
        //                 // "disco_name" => $network_id,
        //                 // "amount" => $transaction_amount,
        //                 // "meter_number" => $transaction_no,
        //                 "disco_name" => 4,
        //                 "amount" => 500,
        //                 "meter_number" => 30530104279,
        //                 "meterType" => 1,
        //             ];
    
        //             try{
        //                 $apiEndpoint = 'https://www.husmodata.com/api/billpayment/';
            
        //                 $response = Http::withHeaders([
        //                     'Content-Type' => 'application/json',
        //                     'Authorization' => env('HUSMO_BEARER_TOKEN'),
        //                 ])->post($apiEndpoint, $payload);
            
        //                 $data = $response->json();
        //                 dd($response);
                        
        //                 // Check if the request was successful
        //                 if($response->successful()) {
        //                     // Get the response body as an array
        //                     $data = $response->json();
        //                     dd($data);
        //                     // Return the response data
        //                     // if($data['Status'] == 'successful'){
        //                     //     $profit = $transaction_amount - $data['paid_amount'];

        //                     //     $update_transaction_status = CustomerTransactionHistory::where('id', $new_transaction->id)->update([
        //                     //         'status' => 1, 
        //                     //         'transaction_amount' => $data['paid_amount'],
        //                     //         'reference' => $data['id'],
        //                     //         'profit' => $profit
        //                     //     ]);

        //                     //     return response()->json([
        //                     //         'status' => true,
        //                     //         'message' => 'Airtime sent. Mun gode sosai.',
        //                     //     ]);
        //                     // }else{
        //                     //     // If Transaction Failed 
        //                     //     $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
        //                     //     $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
        //                     //     $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);
                                
        //                     //     return response()->json([
        //                     //         'status' => true,
        //                     //         'message' => $data['api_response'],
        //                     //     ]);
        //                     // }
    
        //                 }else{
        //                     // If Transaction Failed 
        //                     $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
        //                     $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
        //                     $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);

        //                     // Handle unsuccessful request
        //                     return response()->json([
        //                         'status' => false,
        //                         'message' => 'Please try again later!: ' . $response->status(),
        //                     ]);
        //                 }
        //             }catch(RequestException $e) {
        //                 // If Transaction Failed 
        //                 $cust_acct_balance_current = Customer::select('acct_balance')->where('username', $cust_id)->pluck('acct_balance')->first();
        //                 $cust_acct_balance_refund = $cust_acct_balance_current + $transaction_amount;
        //                 $update_cust_acct_bal = Customer::where('username', $cust_id)->update(['acct_balance' => $cust_acct_balance_refund]);

        //                 // Log the error
        //                 \Log::error('HTTP Request Error: ' . $e->getMessage());
            
        //                 // Handle HTTP request-specific errors
        //                 return response()->json([
        //                     'status' => false,
        //                     'message' => 'Please try again later! (' . $e->getMessage() . ')',
        //                 ]);
        //             }
            
        //         // End of Purchase Electricity Using HUMSO API
        //     }else{
        //         return response()->json([
        //             "status" => true, 
        //             'message' => "Oops, Account Balance Low"
        //         ]);
        //     }

        // }else{
        //     return response()->json([
        //         "status" => true, 
        //         'message' => "Incorrect Pin"
        //     ]);
        // }
    }

    // Wallet 
    public function wallet(){
        $customer = Auth::guard('web')->user();

        $cust_banks = CustomerBankDetails::where('cust_id', $customer->id)->orderby('id', 'desc')->get();

        // If Admin Auth  
        if($customer){
            return view('dashboard.wallet', compact('customer', 'cust_banks'));
        }else{
            return redirect()->route('login');
        }
    }

    // Transactions
    public function transactions(){
        $customer = Auth::guard('web')->user();

        if($customer->cust_type == 1){
            $transactions = CustomerTransactionHistory::whereBetween('created_at', [
                Carbon::now()->subWeek(), // 7 days ago
                Carbon::now() // Today
            ])
            ->orderBy('id', 'desc')
            ->get();
        }else{
            $transactions = CustomerTransactionHistory::where('cust_id', $customer->username)->orderby('id', 'desc')->get();
        }

        // If Admin Auth  
        if($customer){
            return view('dashboard.transactions', compact('customer', 'transactions'));
        }else{
            return redirect()->route('login');
        }
    }

    // Transactions View 
    public function transactionView(Request $request){
        try{
            $transaction_id = $request->transactionId;
            
            // Getting Transaction Details from HUSMO
            try{

                $apiEndpoint = 'https://www.husmodata.com/api/data/'.$transaction_id;

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => env('HUSMO_BEARER_TOKEN'),

                ])->get($apiEndpoint);

                    // Get the response body as an array
                    $data = $response->json();
                    $data['transaction'] = CustomerTransactionHistory::where('reference', $transaction_id)->first();
                    
                    if(!empty($data)){
                        $jsondata = json_encode($data);
                        return response()->json([
                            'status' => true, 
                            'message' => $jsondata, 
                        ]);
                    }else{
                        $jsondata = json_encode('No Record Found!');
                        return response()->json([
                            'status' => true, 
                            'message' => $jsondata, 
                        ]);
                    }

            }catch(Exception $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later! ('.$e.')'
                ]);
            } 
            // Getting Transaction Details from HUSMO
            
        }catch(Expection $e){
            return response()->json([
                'status' => false,
                'message' => 'Please try again later! ('.$e.')'
            ]);
        }
    }

    // Customer View 
    public function customerView(Request $request){
        try{
            $cust_id = $request->custId;
            
            // Getting Customer Details
            try{
                $data = Customer::where('id', $cust_id)->first();
                    
                    if(!empty($data)){
                        $jsondata = json_encode($data);
                        return response()->json([
                            'status' => true, 
                            'message' => $jsondata, 
                        ]);
                    }else{
                        $jsondata = json_encode('No Customer Found!');
                        return response()->json([
                            'status' => true, 
                            'message' => $jsondata, 
                        ]);
                    }    

            }catch(Exception $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later! ('.$e.')'
                ]);
            } 
            // Getting Customer Details
            
        }catch(Expection $e){
            return response()->json([
                'status' => false,
                'message' => 'Please try again later! ('.$e.')'
            ]);
        }
    }

    // Customer Fund Wallet 
    public function customerFundWallet(Request $request){

        $admin = Auth::guard('web')->user();
        $cust_password = Auth::guard('web')->user()->password;

        $cust_id_to_fund = $request->cust_id;
        $amount_to_fund = $request->amount;
        $transaction_pin = $request->transaction_pin;
        $transaction_reference = $request->narration;

        if($admin->cust_type == 1){
            // Check if PIN is correct 
            if(Hash::check($transaction_pin, $cust_password)){
             
                // Update Cust Acct Balance
                $cust_to_fund = Customer::where('id', $cust_id_to_fund)->first();
                $new_cust_acct_balance = $cust_to_fund->acct_balance + $amount_to_fund; 
                $update_cust_acct_bal = Customer::where('id', $cust_id_to_fund)->update(['acct_balance' => $new_cust_acct_balance]);
        
                $new_transaction = CustomerTransactionHistory::create([
                    'cust_id' => $cust_to_fund->username,
                    'network_id' => '555',
                    'transaction_type' => 'Manual-Funding',
                    'transaction_no' => $cust_to_fund->phone,
                    'transaction_amount' => $amount_to_fund ,
                    'transaction_paid' => $amount_to_fund,
                    'reference' => $transaction_reference,
                    'status' => 1,
                ]);
            
                return response()->json([
                    "status" => true, 
                    'message' => "Wallet Funded Successfully"
                ]);
    
            }else{
                return response()->json([
                    "status" => true, 
                    'message' => "Incorrect Pin"
                ]);
            }
        }else{
            return response()->json([
                "status" => true, 
                'message' => "Please Try again later..."
            ]);
        }
    }

    // Customers
    public function customers(){
        $customer = Auth::guard('web')->user();

        $customers_list = Customer::where('cust_status', 1)->orderby('id', 'desc')->get();

        // If Admin Auth  
        if($customer->cust_type == 1){
            return view('dashboard.customers', compact('customer', 'customers_list'));
        }else{
            return redirect()->route('login');
        }
    }

    // Account 
    public function account(){
        $customer = Auth::guard('web')->user();

        $cust = Customer::where('id', $customer->id)->first();

        // If Admin Auth  
        if($customer){
            return view('dashboard.account', compact('cust', 'customer'));
        }else{
            return redirect()->route('login');
        }
    }

    // Delete Account 
    public function accountDelete(){
        $customer = Auth::guard('web')->user();

        $cust = Customer::where('id', $customer->id)->first();

        // If Admin Auth  
        if($customer){
            return view('dashboard.delete_account', compact('cust', 'customer'));
        }else{
            return redirect()->route('login');
        }
    }

    // Delete Account Confirmed
    public function accountDeleteConfirmed(Request $request, $id){
        $cust = Auth::guard('web')->user();

        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            $password = $request->password;

            if(!empty($password)){
                if(Hash::check($password, $cust->password)){
                    $input['cust_status'] = 0;
                    $cust->update($input);

                    return response()->json([
                        "status" => true, 
                        'message' => "Account Deleted Successfully",
                        'redirect' => url('/logout')
                    ]);
                }else{
                    return response()->json([
                        "status" => false, 
                        'message' => "Incorrect password!",
                        'redirect' => url('/logout')
                    ]);   
                }
            }else{
                return response()->json([
                    "status" => false, 
                    'message' => "Password field empty!",
                    'redirect' => url('/logout')
                ]);
            }
        }        
    }

    // Change Password 
    public function accountPassword(Request $request){
        $customer = Auth::guard('web')->user();
        
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;

            if(!empty($old_password)){
                if(Hash::check($old_password, $customer->password)){
                    if($new_password == $confirm_password){
                        
                        $input['password'] = Hash::make($confirm_password);
                        $customer->update($input);

                        return response()->json([
                            "status" => true, 
                            'message' => "Password changed successfully"
                        ]);

                    }else{
                        return response()->json([
                            "status" => false, 
                            'message' => "Password not matched!"
                        ]);     
                    }
                }else{
                    return response()->json([
                        "status" => false, 
                        'message' => "Incorrect password!"
                    ]);   
                }
            }else{
                return response()->json([
                    "status" => false, 
                    'message' => "Password field empty!"
                ]);
            }
        }
    }

    // Change Pin 
    public function accountPin(Request $request){
        $customer = Auth::guard('web')->user();

        if(!empty($customer->pin)){
            $validator = Validator::make($request->all(), [
                'old_pin' => 'required',
                'new_pin' => 'required',
                'confirm_pin' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'new_pin' => 'required',
                'confirm_pin' => 'required',
            ]);

        }

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{
            $old_pin = $request->old_pin;
            $new_pin = $request->new_pin;
            $confirm_pin = $request->confirm_pin;
            
            // If Pin is Set 
            if(!empty($customer->pin)){
    
                if(!empty($old_pin)){
                    if(Hash::check($old_pin, $customer->pin)){
                        if($new_pin == $confirm_pin){
                            
                            $input['pin'] = Hash::make($confirm_pin);
                            $customer->update($input);
    
                            return response()->json([
                                "status" => true, 
                                'message' => "Pin changed successfully"
                            ]);
    
                        }else{
                            return response()->json([
                                "status" => false, 
                                'message' => "Pin not matched!"
                            ]);     
                        }
                    }else{
                        return response()->json([
                            "status" => false, 
                            'message' => "Incorrect pin!"
                        ]);   
                    }
                }else{
                    return response()->json([
                        "status" => false, 
                        'message' => "Pin field empty!"
                    ]);
                }
            }else{
                if($new_pin == $confirm_pin){
                    
                    $input['pin'] = Hash::make($confirm_pin);
                    $customer->update($input);

                    return response()->json([
                        "status" => true, 
                        'message' => "Pin configured successfully"
                    ]);

                }else{
                    return response()->json([
                        "status" => false, 
                        'message' => "Pin not matched!"
                    ]);     
                }
            }
        }
    }

    // Support 
    public function support(){
        $customer = Auth::guard('web')->user();

        // If Admin Auth  
        if($customer){
            return view('dashboard.support', compact('customer'));
        }else{
            return redirect()->route('login');
        }
    }
}
