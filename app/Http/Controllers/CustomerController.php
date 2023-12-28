<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
                        "zainboxCode" => 'picco_soh1NzjlrnwaOdJi9OOy'
                    ];

                    // Make a POST request to the API endpoint with the headers and payload
                    try{
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => env('BEARER_TOKEN'),
    
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

    public function dashboard(){
        $customer = Auth::guard('web')->user();

        // If Admin Auth  
        if($customer){
            return view('dashboard.index', compact('customer'));
        }else{
            return redirect()->route('login');
        }
    }

    public function monnify(Request $request){

        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint URL
        $apiEndpoint = 'https://api.zainpay.ng/virtual-account/create/request';

        // JSON payload for the request
        $payload = [
            "bankType" => "wemaBank",
            "firstName" => "Bello",
            "surname"  => "Samuel Sunday",
            "email" => "bellosamuelsunday@gmail.com",
            "mobileNumber" => "0810000000",
            "dob" => "12-08-1980",
            "gender" => "M",
            "address" => "Gidado street Kano",
            "title" => "Mr",
            "state" => "Kano",
            "zainboxCode" => "picco_soh1NzjlrnwaOdJi9OOy"
        ];

        // Make a POST request to the API endpoint with the headers and payload
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3phaW5wYXkubmciLCJpYXQiOjE2NzQxNjI1ODEsImlkIjo5MDAxOWM5Ny1lZjhiLTQyYWEtOGNmMC02ZGQ2NWQ0MWE2NzMsIm5hbWUiOmthYmlyeXVzdWZiYXNoaXJAZ21haWwuY29tLCJyb2xlIjprYWJpcnl1c3VmYmFzaGlyQGdtYWlsLmNvbSwic2VjcmV0S2V5Ijo0akhoQllXTzRrVzRXUHpmbkJZWXRxVFo2Vmw2OFBNSHlobWdQUHNqYXpyemF9.NGRKAgLdlR_J-2TaqP52xKrkZnrF3mw3V5GEdacJdlI',

        ])->post($apiEndpoint, $payload);

        // Get the response body as an array
        $data = $response->json();

        // Handle the API response as needed
        // For example, you can return it as a JSON response in your Laravel application
        return response()->json($data);
    }

}
