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

class CustomerController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function signUpPage(){
        return view('signup');
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

            try{
                // Add Customer 
                $new_customer = Customer::create([
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => $password,
                ]);

                // Create Customer Virtual Wallet Using ZainPay API 
                    
                    // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint URL
                    $apiEndpoint = 'https://api.zainpay.ng/virtual-account/create/request';

                    // JSON payload for the request
                    $payload = [
                        "bankType" => 'wemaBank',
                        "firstName" => '-PiccoloPay',
                        "surname"  => $username,
                        "email" => $email,
                        "mobileNumber" => $phone,
                        "dob" => "27-07-1993",
                        "gender" => "M",
                        "address" => "Farawa Layout Kano",
                        "title" => "Mr",
                        "state" => "Kano",
                        "zainboxCode" => env('ZAINPAY_BOX')
                    ];

                    // Make a POST request to the API endpoint with the headers and payload
                    try{
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => env('ZAINPAY_BEARER_TOKEN'),
    
                        ])->post($apiEndpoint, $payload);
    
                        // Get the response body as an array
                        $data = $response->json();
    
                        // Handle the API response as needed
                        $acct_no = $data['data']['accountNumber'];
                        $acct_name = $data['data']['accountName'];
                        $bank_name = $data['data']['bankName'];
                        $cust_id = $new_customer->id;

                        if(!empty($acct_no)){
                            // Store Customer Bank Details
                            try{
                                $cust_bank_details = CustomerBankDetails::create([
                                    'cust_id' => $cust_id,
                                    'bank_name' => $bank_name,
                                    'acct_name' => $acct_name,
                                    'acct_no' => $acct_no,
                                ]);
                                
                                if(Auth::guard('web')->attempt($request->only(["email", "password"]))) {
                                    try{
                                        $cust_status = Customer::where('email', $request->email)->where('cust_status', '1')->count();
                                            if($cust_status == 1){
                                                $request->session()->regenerate();
                                                return response()->json([
                                                    "status" => true, 
                                                    "redirect" => url('/dashboard/index')
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
                                
                            }catch(Exception $e){
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Error: Can\'t add bank details. Please try again! ('.$e.')'
                                ]);
                            }
                        }else{
                            // If the Customer Acct No is not generated 
                            $delete_cust = Customer::where('id', $cust_id)->delete();
                            
                            return response()->json([
                                'status' => false,
                                'message' => 'Error: Please try again! ('.$e.')'
                            ]);
                        }
                    }catch(Exception $e){
                        return response()->json([
                            'status' => false,
                            'message' => 'Please try again later! ('.$e.')'
                        ]);
                    }
                
                // End of Create Customer Virtual Wallet Using ZainPay API

            }catch(Expection $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Please try again later! ('.$e.')'
                ]);
            }
        }
    }

    public function loginPage(){
        return view('login');
    }

    public function loginForm(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }else{

            $email = $request->email;
            $password = $request->password;

            try{
                if(Auth::guard('web')->attempt($request->only(["email", "password"]))) {
                    try{
                        $cust_status = Customer::where('email', $request->email)->where('cust_status', '1')->count();
                            if($cust_status == 1){
                                $request->session()->regenerate();
                                return response()->json([
                                    "status" => true, 
                                    "redirect" => url('/dashboard/index')
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
    //End of Logout

    // Dashboard 
    public function dashboard(){
        $customer = Auth::guard('web')->user();
        $cust_account = CustomerBankDetails::select('acct_no')->where('cust_id', $customer->id)->pluck('acct_no')->first();
        $transaction_count = CustomerTransactionHistory::where('cust_id', $customer->id)->count();
        $amount_spent = CustomerTransactionHistory::where('cust_id', $customer->id)->sum('transaction_paid');
        
        if(!empty($customer->pin)){
            // Get Customer Account Balance 
                        
                $apiEndpoint = 'https://api.zainpay.ng/virtual-account/wallet/balance/'.$cust_account;
    
                try{
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Authorization' => env('ZAINPAY_BEARER_TOKEN'),
                    ])->get($apiEndpoint);
    
                    if($response->successful()) {
                        // Request was successful
                        $data = $response->json();
                        $cust_acct_balance = ($data['data']['balanceAmount'] / 100);
                        
                        // If Admin Auth  
                        if($customer){
                            return view('dashboard.index', compact('customer', 'cust_acct_balance', 'transaction_count', 'amount_spent'));
                        }else{
                            return redirect()->route('login');
                        }
                    }else{
                        // Request failed
                        Log::error('API Request Failed: ' . $response->status());
    
                        return response()->json([
                            'status' => false,
                            'message' => 'API Request Failed: ' . $response->status(),
                        ]);
                    }
                }catch(RequestException $e) {
                    // Log the error
                    Log::error('HTTP Request Error: ' . $e->getMessage());
    
                    // Handle HTTP request-specific errors
                    return response()->json([
                        'status' => false,
                        'message' => 'Please try again later! (' . $e->getMessage() . ')',
                    ]);
                }
            
            // End of Get Customer Account Balance
        }else{
            return redirect()->route('cust-account');
        }
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
