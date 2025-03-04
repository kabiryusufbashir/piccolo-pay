// Purchase DATA Using HUMSO API 
    // JSON payload for the request
    $payload = [
        "network" => $network_id,
        "mobile_number" => $transaction_no,
        "plan" => $plan_id,
        "Ported_number" => true
    ];

    try{
        $apiEndpoint = 'https://www.husmodata.com/api/data/';

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

// End of Purchase DATA Using HUMSO API
<!-- Modal  -->
    <!-- Fund Transfer Modal  -->
    <div id="bankTransferModalContents" class="yus_modal">
        <div class="yus_modal-content text-xs lg:text-sm">
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Fund Transfer
                    </div>
                    <div>
                        <div id="closebankTransferModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Validate Account Number  -->
            <form action="{{ route('fund-transfer-verify-account') }}" id="verfiyAccountNumber" method="POST">
                @csrf
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="bank_code">Select Bank</label><br>
                        <select id="bankCode" class="plan_input_box" name="bank_code">
                            <option value=""></option>
                            @foreach($bank_lists as $bank)
                                <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3 w-full">
                        <label for="account_number">Account No</label><br>
                        <input id="accountNumber" type="number" required class="plan_input_box" name="account_number">
                    </div>
                    <div class="my-3 w-full hidden" id="accountName">
                        <label for="account_name">Account Name</label><br>
                        <input id="accountNameBox" type="text" class="plan_input_box" disabled name="account_name">
                    </div>
                    <div id="searchAccountBtn" class="my-3">
                        <br>
                        <input style="background-color: #05976A;" class="px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="SEARCH ACCOUNT" name="submit">
                    </div>
                </div>
            </form>
            <form action="{{ route('fund-transfer-confirm') }}" id="transferFunds" method="POST">
                @csrf 
                
                <!-- Amount  -->
                <div id="fundTransferAmount" class="hidden">
                    <div class="px-10 pb-2 lg:flex justify-between">
                        <div class="my-3 w-full">
                            <label for="amount">Amount</label><br>
                            <input id="amountTransfer" type="number" required class="plan_input_box" name="amount" placeholder="500">
                        </div>
                        <div class="my-3 w-full">
                            <label for="narration">Narration</label><br>
                            <input id="amountNarration" type="text" required class="plan_input_box" name="Narration" placeholder="School Fees">
                        </div>
                        <div class="my-3 w-full">
                            <label for="pin">Transaction PIN</label><br>
                            <input id="fundTransferCustPin" type="password" required class="plan_input_box" name="pin">
                        </div>
                    </div>
                </div>
                <div id="fundTransferSend" class="px-10 pb-5 hidden">
                    <div class="my-2 flex justify-center">
                        <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="CONFIRM" name="submit">
                    </div>
                </div>

                <!-- Loading -->
                <div class="loader hidden">
                    @include('includes.loader')
                </div>
                                            
                <!-- Feedback Container  -->
                <div id="feedbackContainerFundTransfer" class="my-2">@include('includes.messages')</div>
            </form>
        </div>
    </div>

    <!-- MTN Modal  -->
    <div id="mtnModalContent" class="yus_modal">
        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataMtn" method="POST" class="yus_modal-content text-xs lg:text-sm">
            @csrf 
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        MTN Data Plans
                    </div>
                    <div>
                        <div id="closeMtnModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 pb-2 lg:flex justify-between">
                <div class="my-3 w-full">
                    <label for="data_type">Data Type</label><br>
                    <select id="planTypeSme" class="plan_input_box" name="plan_type">
                        <option value=""></option>
                            @php
                                $specialIds = [60, 99];
                                $corporate_data = [99, 100, 101, 226, 116, 146, 149, 60, 51, 50, 230, 44, 150];
                                
                                $corporate_data_map = array_flip($corporate_data);
                                
                                $filteredDataPlans = array_filter($dataPlansMtnCorporate, function($data) use ($corporate_data_map) {
                                    return isset($corporate_data_map[$data['dataplan_id']]);
                                });
                                
                                usort($filteredDataPlans, function($a, $b) use ($corporate_data_map) {
                                    return $corporate_data_map[$a['dataplan_id']] <=> $corporate_data_map[$b['dataplan_id']];
                                });
                            @endphp

                            @foreach($filteredDataPlans as $data)
                                @if(in_array($data['dataplan_id'], $specialIds))
                                    <option value="{{ $data['dataplan_id'] }}"
                                            data-unit="{{ $data['plan'] }}"
                                            data-plan="{{ $data['dataplan_id'] }}"
                                            data-buying="{{ $data['plan_amount'] }}"
                                            data-amount="{{ $data['plan_amount'] + 10 }}"
                                            data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">
                                        {{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + 10 }})
                                    </option>
                                @else
                                    @php
                                        $parts = explode('.', $data['plan']);
                                        $beforeDecimal = $parts[0];
                                        $charges = $beforeDecimal * 10;
                                    @endphp
                                    <option value="{{ $data['dataplan_id'] }}"
                                            data-unit="{{ $data['plan'] }}"
                                            data-plan="{{ $data['dataplan_id'] }}"
                                            data-buying="{{ $data['plan_amount'] }}"
                                            data-amount="{{ $data['plan_amount'] + $charges }}"
                                            data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">
                                        {{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + $charges }})
                                    </option>
                                @endif 
                            @endforeach

                    </select>
                </div>
            </div>
            <!-- Amount  -->
            <div id="dataAmount" class="hidden">
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="amount">Amount</label><br>
                        <input class="plan_input_box" name="network_id" value="1" hidden>
                        <input id="dataUnit" class="plan_input_box" name="data_unit" hidden>
                        <input id="transactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                        <input id="transactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                        <input id="transactionReference" class="plan_input_box" name="transaction_reference" hidden>
                        <input id="planAmount" class="plan_input_box" name="amount" disabled>
                    </div>
                    <div class="my-3 w-full">
                        <label for="transaction_no">Mobile Phone</label><br>
                        <input type="number" required class="plan_input_box" name="transaction_no">
                    </div>
                    <div class="my-3 w-full">
                        <label for="pin">Transaction PIN</label><br>
                        <input id="custPin" type="password" required class="plan_input_box" name="pin">
                    </div>
                </div>
            </div>
            <div id="dataBuy" class="px-10 pb-5 hidden">
                <div class="my-2 flex justify-center">
                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                </div>
            </div>

            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                        
            <!-- Feedback Container  -->
            <div id="feedbackContainerMtn" class="my-2">@include('includes.messages')</div>
        </form>
    </div>

    <!-- GLO Modal  -->
    <div id="gloModalContent" class="yus_modal">
        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataGlo" method="POST" class="yus_modal-content text-xs lg:text-sm">
            @csrf 
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        GLO Data Plans
                    </div>
                    <div>
                        <div id="closeGloModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 pb-2 lg:flex justify-between">
                <div class="my-3 w-full">
                    <label for="data_type">Data Type</label><br>
                    <select id="gloDataType" class="plan_input_box" name="plan_type">
                        <option value=""></option>
                        @php
                            $specialIds = [250, 296, 258, 251, 252];
                        @endphp
                        @foreach($dataPlansGloAll as $data)
                            @if(in_array($data['dataplan_id'], $specialIds))
                                <option value="{{ $data['dataplan_id'] }}" data-unit="{{ $data['plan'] }}" data-plan="{{ $data['dataplan_id'] }}" data-buying="{{ $data['plan_amount'] }}" data-amount="{{ $data['plan_amount'] + 10 }}" data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + 10 }})</option>
                            @else
                            @php
                                $parts = explode('.', $data['plan']);
                                $beforeDecimal = $parts[0];
                                $charges = $beforeDecimal * 10;
                            @endphp
                                <option value="{{ $data['dataplan_id'] }}" data-unit="{{ $data['plan'] }}" data-plan="{{ $data['dataplan_id'] }}" data-buying="{{ $data['plan_amount'] }}" data-amount="{{ $data['plan_amount'] + $charges }}" data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + $charges }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Amount  -->
            <div id="gloDataAmount" class="hidden">
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="amount">Amount</label><br>
                        <input class="plan_input_box" name="network_id" value="2" hidden>
                        <input id="gloDataUnit" class="plan_input_box" name="data_unit" hidden>
                        <input id="gloTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                        <input id="gloTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                        <input id="gloTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                        <input id="gloPlanAmount" class="plan_input_box" name="amount" disabled>
                    </div>
                    <div class="my-3 w-full">
                        <label for="transaction_no">Mobile Phone</label><br>
                        <input type="number" required class="plan_input_box" name="transaction_no">
                    </div>
                    <div class="my-3 w-full">
                        <label for="pin">Transaction PIN</label><br>
                        <input id="gloCustPin" type="password" required class="plan_input_box" name="pin">
                    </div>
                </div>
            </div>
            <div id="gloDataBuy" class="px-10 pb-5 hidden">
                <div class="my-2 flex justify-center">
                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                </div>
            </div>

            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                        
            <!-- Feedback Container  -->
            <div id="feedbackContainerGlo" class="my-2">@include('includes.messages')</div>

        </form>
    </div>

    <!-- AIRTEL Modal  -->
    <div id="airtelModalContent" class="yus_modal">
        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataAirtel" method="POST" class="yus_modal-content text-xs lg:text-sm">
            @csrf 
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Airtel Data Plans
                    </div>
                    <div>
                        <div id="closeAirtelModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 pb-2 lg:flex justify-between">
                <div class="my-3 w-full">
                    <label for="data_type">Data Type</label><br>
                    <select id="airtelDataType" class="plan_input_box" name="plan_type">
                        <option value=""></option>
                        @php
                            $specialIds = [216, 217, 212, 130];
                            $corporate_data = [212, 213, 214, 215, 216, 217, 231, 232, 233];
                        @endphp
                        
                        @foreach($dataPlansAirtelAll as $data)
                            @if(in_array($data['dataplan_id'], $corporate_data))
                                @if(in_array($data['dataplan_id'], $specialIds))
                                    <option value="{{ $data['dataplan_id'] }}"
                                            data-unit="{{ $data['plan'] }}"
                                            data-plan="{{ $data['dataplan_id'] }}"
                                            data-buying="{{ $data['plan_amount'] }}"
                                            data-amount="{{ $data['plan_amount'] + 10 }}"
                                            data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">
                                        {{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + 10 }})
                                    </option>
                                @else
                                    @php
                                        $parts = explode('.', $data['plan']);
                                        $beforeDecimal = $parts[0];
                                        $charges = $beforeDecimal * 10;
                                    @endphp
                                    <option value="{{ $data['dataplan_id'] }}"
                                            data-unit="{{ $data['plan'] }}"
                                            data-plan="{{ $data['dataplan_id'] }}"
                                            data-buying="{{ $data['plan_amount'] }}"
                                            data-amount="{{ $data['plan_amount'] + $charges }}"
                                            data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">
                                        {{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + $charges }})
                                    </option>
                                @endif
                            @endif
                        @endforeach

                    </select>
                </div>
            </div>
            <!-- Amount  -->
            <div id="airtelDataAmount" class="hidden">
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="amount">Amount</label><br>
                        <input class="plan_input_box" name="network_id" value="4" hidden>
                        <input id="airtelDataUnit" class="plan_input_box" name="data_unit" hidden>
                        <input id="airtelTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                        <input id="airtelTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                        <input id="airtelTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                        <input id="airtelPlanAmount" class="plan_input_box" name="amount" disabled>
                    </div>
                    <div class="my-3 w-full">
                        <label for="transaction_no">Mobile Phone</label><br>
                        <input type="number" required class="plan_input_box" name="transaction_no">
                    </div>
                    <div class="my-3 w-full">
                        <label for="pin">Transaction PIN</label><br>
                        <input id="airtelCustPin" type="password" required class="plan_input_box" name="pin">
                    </div>
                </div>
            </div>
            <div id="airtelDataBuy" class="px-10 pb-5 hidden">
                <div class="my-2 flex justify-center">
                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                </div>
            </div>

            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                        
            <!-- Feedback Container  -->
            <div id="feedbackContainerAirtel" class="my-2">@include('includes.messages')</div>
        </form>
    </div>

    <!-- 9Mobile Modal  -->
    <div id="n9mobileModalContent" class="yus_modal">
        <form action="{{ route('cust-data-purchase') }}" id="purchaseData9Mobile" method="POST" class="yus_modal-content text-xs lg:text-sm">
            @csrf 
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        9mobile Data Plans
                    </div>
                    <div>
                        <div id="closen9mobileModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 pb-2 lg:flex justify-between">
                <div class="my-3 w-full">
                    <label for="data_type">Data Type</label><br>
                    <select id="n9mobileDataType" class="plan_input_box" name="plan_type">
                        <option value=""></option>
                        @php
                            $specialIds = [117, 275, 118, 122, 119, 123];
                        @endphp
                        @foreach($dataPlans9MobileAll as $data)
                            @if(in_array($data['dataplan_id'], $specialIds))
                                <option value="{{ $data['dataplan_id'] }}" data-unit="{{ $data['plan'] }}" data-plan="{{ $data['dataplan_id'] }}" data-buying="{{ $data['plan_amount'] }}" data-amount="{{ $data['plan_amount'] + 10 }}" data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + 10 }})</option>
                            @else
                            @php
                                $parts = explode('.', $data['plan']);
                                $beforeDecimal = $parts[0];
                                $charges = $beforeDecimal * 10;
                            @endphp
                                <option value="{{ $data['dataplan_id'] }}" data-unit="{{ $data['plan'] }}" data-plan="{{ $data['dataplan_id'] }}" data-buying="{{ $data['plan_amount'] }}" data-amount="{{ $data['plan_amount'] + $charges }}" data-refer="{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }}">{{ $data['plan_network'] }} {{ $data['plan_type'] }} - {{ $data['plan'] }} (₦{{ $data['plan_amount'] + $charges }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Amount  -->
            <div id="n9mobileDataAmount" class="hidden">
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="amount">Amount</label><br>
                        <input class="plan_input_box" name="network_id" value="3" hidden>
                        <input id="n9mobileDataUnit" class="plan_input_box" name="data_unit" hidden>
                        <input id="n9mobileTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                        <input id="n9mobileTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                        <input id="n9mobileTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                        <input id="n9mobilePlanAmount" class="plan_input_box" name="amount" disabled>
                    </div>
                    <div class="my-3 w-full">
                        <label for="transaction_no">Mobile Phone</label><br>
                        <input type="number" required class="plan_input_box" name="transaction_no">
                    </div>
                    <div class="my-3 w-full">
                        <label for="pin">Transaction PIN</label><br>
                        <input id="n9mobileCustPin" type="password" required class="plan_input_box" name="pin">
                    </div>
                </div>
            </div>
            <div id="n9mobileDataBuy" class="px-10 pb-5 hidden">
                <div class="my-2 flex justify-center">
                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                </div>
            </div>

            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                        
            <!-- Feedback Container  -->
            <div id="feedbackContainer9Mobile" class="my-2">@include('includes.messages')</div>
        </form>
    </div>

    <!-- Airtime Modal  -->
    <div id="airtimeModalContent" class="yus_modal">
        <form action="{{ route('cust-airtime-purchase') }}" id="purchaseAirtime" method="POST" class="yus_modal-content text-xs lg:text-sm">
            @csrf 

            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Airtime Purchase
                    </div>
                    <div>
                        <div id="closeAirtimeModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-10 pb-2 lg:flex justify-between">
                <div class="my-3 w-full">
                    <label for="network_id">Network</label><br>
                    <select id="networkId" class="plan_input_box" name="network">
                        <option value=""></option>
                        <option value="1">MTN</option>
                        <option value="2">GLO</option>
                        <option value="3">9Mobile</option>
                        <option value="4">Airtel</option>
                    </select>
                </div>
            </div>
            <!-- Amount  -->
            <div id="airtimeAmount" class="hidden">
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="amount">Amount</label><br>
                        <input type="number" required class="plan_input_box" name="amount">
                    </div>
                    <div class="my-3 w-full">
                        <label for="mobile_number">Mobile Phone</label><br>
                        <input type="number" required class="plan_input_box" name="mobile_number">
                        <input type="text" value="VTU" class="plan_input_box hidden" name="airtime_type">
                    </div>
                    <div class="my-3 w-full">
                        <label for="pin">Transaction PIN</label><br>
                        <input id="airtimeCustPin" type="password" required class="plan_input_box" name="pin">
                    </div>
                </div>
            </div>
            <div id="airtimeBuy" class="px-10 pb-5 hidden">
                <div class="my-2 flex justify-center">
                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                </div>
            </div>

            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                        
            <!-- Feedback Container  -->
            <div id="feedbackContainerAirtime" class="my-2">@include('includes.messages')</div>
        </form>
    </div>

    <!-- Electricity Modal  -->
    <div id="electricityModalContent" class="yus_modal">
        <div class="yus_modal-content text-xs lg:text-sm">
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Electricity Purchase
                    </div>
                    <div>
                        <div id="closeElectricityModal" class="cursor-pointer">
                            <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_73_1706)">
                                    <circle cx="45" cy="45" r="29" fill="white"/>
                                </g>
                                <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                        <feOffset/>
                                        <feGaussianBlur stdDeviation="7"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Validate Meter  -->
            <form action="{{ route('cust-electricity-search-meter') }}" id="searchMeterElectricity" method="POST">
                @csrf
                <div class="px-10 pb-2 lg:flex justify-between">
                    <div class="my-3 w-full">
                        <label for="disco_id">Disco</label><br>
                        <select id="discoName" class="plan_input_box" name="disco_id">
                            <option value=""></option>
                            <option value="Ikeja Electric">Ikeja Electricity</option>
                            <option value="Eko Electric">Eko Electricity</option>
                            <option value="Abuja Electric">Abuja Electricity</option>
                            <option value="Kano Electric">Kano Electricity</option>
                            <option value="Enugu Electric">Enugu Electricity</option>
                            <option value="Port Harcourt Electric">Port-harcourt Electricity</option>
                            <option value="Ibadan Electric">Ibadan Electricity</option>
                            <option value="Kaduna Electric">Kaduna Electricity</option>
                            <option value="Jos Electric">Jos Electricity</option>
                            <option value="Yola Electric">Yola Electricity</option>
                            <option value="Benin Electric">Benin Electricity</option>
                        </select>
                    </div>
                    <div class="my-3 w-full">
                        <label for="meter_number">Meter No</label><br>
                        <input id="meterNumber" type="number" required class="plan_input_box" name="meter_number">
                    </div>
                    <div class="my-3 w-full hidden" id="meterName">
                        <label for="meter_name">Meter Name</label><br>
                        <input id="meterNameBox" type="text" class="plan_input_box" disabled name="meter_name">
                    </div>
                    <div id="searchMeterBtn" class="my-2 submit_box">
                        <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="SEARCH METER" name="submit">
                    </div>
                </div>
            </form>
            <form action="{{ route('cust-electricity-purchase') }}" id="purchaseElectricity" method="POST">
                @csrf 
                
                <!-- Amount  -->
                <div id="electricityAmount" class="hidden">
                    <div class="px-10 pb-2 lg:flex justify-between">
                        <div class="my-3 w-full">
                            <label for="amount">Amount</label><br>
                            <input id="tokenAmount" type="number" required class="plan_input_box" name="amount" placeholder="Min:₦500">
                        </div>
                        <div class="my-3 w-full">
                            <label for="pin">Transaction PIN</label><br>
                            <input id="electricityCustPin" type="password" required class="plan_input_box" name="pin">
                        </div>
                    </div>
                </div>
                <div id="electricityBuy" class="px-10 pb-5 hidden">
                    <div class="my-2 flex justify-center">
                        <input style="background-color: #05976A;" class="bg-green-600 px-6 py-3 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
                    </div>
                </div>

                <!-- Loading -->
                <div class="loader hidden">
                    @include('includes.loader')
                </div>
                                            
                <!-- Feedback Container  -->
                <div id="feedbackContainerElectricity" class="my-2">@include('includes.messages')</div>
            </form>
        </div>
    </div>

<!-- End of Modal  -->

<!-- Script  -->
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            
            // Fund Transfer Modal
            $(document).on('click', '#bankTransferModal', function(){
                $('#bankTransferModalContents').toggle();
            })

            // Close Fund Transfer Modal 
            $(document).on('click', '#closebankTransferModal', function() {
                $('#bankTransferModalContents').toggle();
            })

            // Verfiy Account Number
            $(document).on('submit', '#verfiyAccountNumber', function() {
                var e = this
                let searchAccountBtn = $('#searchAccountBtn')
                let accountName = $('#accountName')
                let accountNameBox = $('#accountNameBox')
                let container = $('#feedbackContainerFundTransfer')

                // display Loader 
                $('.loader').show()
                searchAccountBtn.hide()

                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        if(data.status === true) {
                            // Loader Hide 
                            $('.loader').hide()
                            accountName.show()

                            // Add Value to Meter Box 
                            accountNameBox.val(data.message)

                            // Show Amount Container 
                            $('#fundTransferAmount').show()    

                        }else{
                            $(".alert").remove();
                            
                            // Loader Hide 
                            $('.loader').hide()

                            // Display Search Btn Back 
                            searchAccountBtn.show()
                            
                            if(data.status === false) {
                                // Check if the errors property is a string
                                if(typeof data.errors === 'string') {
                                    container.append('<div class="alert alert-danger text-xs text-center">' + data.errors + '</div>');
                                }else if(typeof data.errors === 'object') {
                                    // If errors is an object (possibly from server validation)
                                    $.each(data.errors, function (key, val) {
                                        container.append('<div class="alert alert-danger text-xs text-center">' +val+ '</div>');
                                    });
                                }else{
                                    // Handle other cases or provide a default message
                                    container.append('<div class="alert alert-danger text-xs text-center">'+data.message+'</div>');
                                }
                            }
                        }
                    
                    }
                });

                return false;
            })

            // Transfer Funds
            $(document).on('submit', '#transferFunds', function() {
                var e = this
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let container = $('#feedbackContainerFundTransfer')
                let bankCode = $('#bankCode').val()
                let accountNumber = $('#accountNumber').val()
                let amountTransfer = $('#amountTransfer').val()
                let amountNarration = $('#amountNarration').val()
                let custPin = $('#fundTransferCustPin').val()

                // display Loader 
                $('.loader').show()

                $('#electricityBuy').hide()

                $.ajax({
                    url: $(this).attr('action'),
                    data: {
                        _token: csrfToken,
                        bankCode: bankCode,
                        accountNumber: accountNumber,
                        amountTransfer: amountTransfer,
                        amountNarration: amountNarration,
                        custPin: custPin,
                    },
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        if(data.status) {
                            // Loader Hide 
                            $('.loader').hide()
                            
                            container.fadeIn().delay(5000).fadeOut()
                            
                            container.append('<div class="alert alert-success text-xs text-center">'+data.message+'</div>')
                            
                            // Redirect 
                            setTimeout(function(){
                                location.reload()
                            }, 5000)

                        }else{
                            $(".alert").remove();
                            
                            // Loader Hide 
                            $('.loader').hide()

                            if(data.status === false) {
                                // Check if the errors property is a string
                                if(typeof data.errors === 'string') {
                                    container.append('<div class="alert alert-danger text-xs text-center">' + data.errors + '</div>');
                                }else if(typeof data.errors === 'object') {
                                    // If errors is an object (possibly from server validation)
                                    $.each(data.errors, function (key, val) {
                                        container.append('<div class="alert alert-danger text-xs text-center">' + val + '</div>');
                                    });
                                }else{
                                    // Handle other cases or provide a default message
                                    container.append('<div class="alert alert-danger text-xs text-center">'+data.message+'</div>');
                                }
                            }

                            // Redirect 
                            setTimeout(function(){
                                location.reload()
                            }, 5000)

                        }
                    
                    }
                });

                return false;
            })

            // Fund Transfer Cust PIN 
            $(document).on('keyup', '#fundTransferCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#fundTransferSend').show()
                }else{
                    $('#fundTransferSend').hide()
                }
            })

            // Close MTN Modal 
            $(document).on('click', '#closeMtnModal', function() {
                $('#mtnModalContent').toggle();
            })

            // MTN Modal
            $(document).on('click', '#mtnModal', function(){
                $('#mtnModalContent').toggle();
            })

            // Close GLO Modal 
            $(document).on('click', '#closeGloModal', function() {
                $('#gloModalContent').toggle();
            })

            // GLO Modal
            $(document).on('click', '#gloModal', function(){
                $('#gloModalContent').toggle();
            })
            
            // Close AIRTEL Modal 
            $(document).on('click', '#closeAirtelModal', function() {
                $('#airtelModalContent').toggle();
            })

            // AIRTEL Modal
            $(document).on('click', '#airtelModal', function(){
                $('#airtelModalContent').toggle();
            })
            
            // Close 9mobile Modal 
            $(document).on('click', '#closen9mobileModal', function() {
                $('#n9mobileModalContent').toggle();
            })

            // 9mobile Modal
            $(document).on('click', '#n9mobileModal', function(){
                $('#n9mobileModalContent').toggle();
            })

            // On Change data Type (MTN )
            $(document).on('change', '#dataType', function(){
                let dataType = $(this).val()
                
                if(dataType == 'SME'){
                    $('#dataPlanSme').show()
                    $('#dataPlanCor').hide()
                }else{
                    $('#dataPlanCor').show()
                    $('#dataPlanSme').hide()
                }

                $('#dataAmount').hide()
            })

            // MTN SME 
            $(document).on('change', '#planTypeSme', function(){
                let dataId = $(this).val()
                let dataUnit = $(this).find(':selected').data('unit')
                let dataPlanId = $(this).find(':selected').data('plan')
                let dataAmount = $(this).find(':selected').data('amount')
                let dataBuying = $(this).find(':selected').data('buying')
                let transactionReference = $(this).find(':selected').data('refer')

                if(dataId !== ''){
                    $('#dataAmount').toggle(dataAmount !== 0); // Show/hide based on dataAmount value

                    let planAmountTotal = parseInt(dataAmount)
                    let planBuyingTotal = parseInt(dataBuying)

                    $('#planTypeSme').val(dataPlanId)
                    $('#planTypeCor').val(null)
                    $('#dataUnit').val(dataUnit)
                    $('#planAmount').val(planAmountTotal)
                    $('#transactionBuying').val(planBuyingTotal)
                    $('#transactionAmount').val(planAmountTotal)
                    $('#transactionReference').val(transactionReference)
                    
                }else{
                    $('#dataAmount').toggle()
                }
            })

            // MTN Corporate 
            $(document).on('change', '#planTypeCor', function(){
                let dataId = $(this).val()
                let dataUnit = $(this).find(':selected').data('unit')
                let dataAmount = $(this).find(':selected').data('amount')
                let dataPlanId = $(this).find(':selected').data('plan')
                let dataBuying = $(this).find(':selected').data('buying')
                let transactionReference = $(this).find(':selected').data('refer')

                if(dataId !== ''){
                    $('#dataAmount').toggle(dataAmount !== 0); // Show/hide based on dataAmount value

                    let planAmountTotal = parseInt(dataAmount)
                    let planBuyingTotal = parseInt(dataBuying)

                    $('#planTypeCor').val(dataPlanId)
                    $('#planTypeSme').val(null)
                    $('#dataUnit').val(dataUnit)
                    $('#planAmount').val(planAmountTotal)
                    $('#transactionBuying').val(planBuyingTotal)
                    $('#transactionAmount').val(planAmountTotal)
                    $('#transactionReference').val(transactionReference)
                    
                }else{
                    $('#dataAmount').toggle()
                }
            })

            // MTN Cust PIN 
            $(document).on('keyup', '#custPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#dataBuy').show()
                }else{
                    $('#dataBuy').hide()
                }

            })

            // GLO 
            $(document).on('change', '#gloDataType', function(){
                let dataId = $(this).val()
                let dataUnit = $(this).find(':selected').data('unit')
                let dataAmount = $(this).find(':selected').data('amount')
                let dataBuying = $(this).find(':selected').data('buying')
                let transactionReference = $(this).find(':selected').data('refer')

                if(dataId !== ''){
                    $('#gloDataAmount').toggle(dataAmount !== 0); // Show/hide based on dataAmount value

                    let planAmountTotal = parseInt(dataAmount)
                    let planBuyingTotal = parseInt(dataBuying)

                    $('#gloDataUnit').val(dataUnit)
                    $('#gloPlanAmount').val(planAmountTotal)
                    $('#gloTransactionAmount').val(planAmountTotal)
                    $('#gloTransactionBuying').val(planBuyingTotal)
                    $('#gloTransactionReference').val(transactionReference)
                    
                }else{
                    $('#gloDataAmount').toggle()
                }
            })

            // GLO Cust PIN 
            $(document).on('keyup', '#gloCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#gloDataBuy').show()
                }else{
                    $('#gloDataBuy').hide()
                }

            })

            // AIRTEL 
            $(document).on('change', '#airtelDataType', function(){
                let dataId = $(this).val()
                let dataUnit = $(this).find(':selected').data('unit')
                let dataAmount = $(this).find(':selected').data('amount')
                let dataBuying = $(this).find(':selected').data('buying')
                let transactionReference = $(this).find(':selected').data('refer')

                if(dataId !== ''){
                    $('#airtelDataAmount').toggle(dataAmount !== 0); // Show/hide based on dataAmount value

                    let planAmountTotal = parseInt(dataAmount)
                    let planBuyingTotal = parseInt(dataBuying)

                    $('#airtelDataUnit').val(dataUnit)
                    $('#airtelPlanAmount').val(planAmountTotal)
                    $('#airtelTransactionAmount').val(planAmountTotal)
                    $('#airtelTransactionBuying').val(planBuyingTotal)
                    $('#airtelTransactionReference').val(transactionReference)
                    
                }else{
                    $('#airtelDataAmount').toggle()
                }
            })

            // AIRTEL Cust PIN 
            $(document).on('keyup', '#airtelCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#airtelDataBuy').show()
                }else{
                    $('#airtelDataBuy').hide()
                }

            })

            // 9mobile 
            $(document).on('change', '#n9mobileDataType', function(){
                let dataId = $(this).val()
                let dataUnit = $(this).find(':selected').data('unit')
                let dataAmount = $(this).find(':selected').data('amount')
                let dataBuying = $(this).find(':selected').data('buying')
                let transactionReference = $(this).find(':selected').data('refer')

                if(dataId !== ''){
                    $('#n9mobileDataAmount').toggle(dataAmount !== 0); // Show/hide based on dataAmount value

                    let planAmountTotal = parseInt(dataAmount)
                    let planBuyingTotal = parseInt(dataBuying)

                    $('#n9mobileDataUnit').val(dataUnit)
                    $('#n9mobilePlanAmount').val(planAmountTotal)
                    $('#n9mobileTransactionAmount').val(planAmountTotal)
                    $('#n9mobileTransactionBuying').val(planBuyingTotal)
                    $('#n9mobileTransactionReference').val(transactionReference)
                    
                }else{
                    $('#n9mobileDataAmount').toggle()
                }
            })

            // 9mobile Cust PIN 
            $(document).on('keyup', '#n9mobileCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#n9mobileDataBuy').show()
                }else{
                    $('#n9mobileDataBuy').hide()
                }

            })

            // Airtime Modal
            $(document).on('click', '#airtimeModal', function(){
                $('#airtimeModalContent').toggle();
            })

            // Close Airtime Modal 
            $(document).on('click', '#closeAirtimeModal', function() {
                $('#airtimeModalContent').toggle();
            })

            // Airtime 
            $(document).on('change', '#networkId', function(){
                let dataId = $(this).val()

                if(dataId !== ''){
                    $('#airtimeAmount').show()    
                }else{
                    $('#airtimeAmount').hide()
                }
            })

            // Airtime Cust PIN 
            $(document).on('keyup', '#airtimeCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#airtimeBuy').show()
                }else{
                    $('#airtimeBuy').hide()
                }

            })

            // Electricity Modal
            $(document).on('click', '#electricityModal', function(){
                $('#electricityModalContent').toggle();
            })

            // Close Electricity Modal 
            $(document).on('click', '#closeElectricityModal', function() {
                $('#electricityModalContent').toggle();
            })

            // Electricity Cust PIN 
            $(document).on('keyup', '#electricityCustPin', function(){
                let custPin = $(this).val()

                if(custPin.length > 3){
                    $('#electricityBuy').show()
                }else{
                    $('#electricityBuy').hide()
                }

            })

        });
    </script>
<!-- End of Script  -->