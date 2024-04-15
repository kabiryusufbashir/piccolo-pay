<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;


class PSBController extends Controller
{
    public function authenticate(){

        // JSON payload for the request
        $payload = [
            "username" => "piccolo",
            "password" => "QY7dmZS8y5otEzxVC7qcE1L2aqhHS99q7NgzHg1uVswUBhZIaT",
            "clientId " => "waas",
            "clientSecret" => "cRAwnWElcNMUZpALdnlve6PubUkCPOQR"
        ];

        try{
            $apiEndpoint = 'http://102.216.128.75:9090/bank9ja/api/v2/k1/authenticate';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($apiEndpoint, $payload);

            // Check if the request was successful
            if($response->successful()) {
                // Get the response body as an array
                $data = $response->json();
                
                dd($data);
                // Return the response data
                // if($data['Status'] == 'successful'){
            
                //     return response()->json([
                //         'status' => true,
                //         'message' => 'Airtime sent. Mun gode sosai.',
                //     ]);
                // }else{
                    
                //     return response()->json([
                //         'status' => true,
                //         'message' => $data['api_response'],
                //     ]);
                // }

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
}
