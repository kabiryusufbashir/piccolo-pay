@extends('layout.dashboard')

@section('pageTitle')
    <title>Data Page - Piccolo Pay</title>        
@endsection

@section('pageContents')
    <div class="grid grid-cols-1">
        <!-- Services  -->
            <div class="mx-3 my-4">
                <!-- Data  -->
                <div class="py-1 mt-12 lg:mt-0 mb-2 bg-white rounded-xl lg:w-1/2 w-full">
                    <div class="grid grid-cols-4 gap-4 px-10 pt-4">
                        <!-- MTN  -->
                        <div id="mtnModal" data-toggle="modal" data-target="#mtnModalContainer" class="flex items-center flex-col cursor-pointer min-w-[20px]">
                            <div>                            
                                <img class="w-5" src="{{ asset('images/mtn_2.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                MTN
                            </div>
                        </div>

                        <!-- Airtel -->
                        <div id="airtelModal" data-toggle="modal" data-target="#airtelModalContainer" class="flex items-center flex-col cursor-pointer min-w-[20px]">
                            <div>
                                <img class="w-5" src="{{ asset('images/airtel.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                Airtel
                            </div>
                        </div>

                        <!-- Glo  -->
                        <div id="gloModal" data-toggle="modal" data-target="#gloModalContainer" class="flex items-center flex-col cursor-pointer min-w-[20px]">
                            <div>
                                <img class="w-5" src="{{ asset('images/glo_2.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                Glo
                            </div>
                        </div>

                        <!-- 9mobile  -->
                        <div id="n9mobileModal" data-toggle="modal" data-target="#n9mobileModalContainer" class="flex items-center flex-col cursor-pointer min-w-[20px]">
                            <div>
                                <img class="w-5" src="{{ asset('images/9mobile.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                9mobile
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Container  -->
                <div class="bg-white rounded-xl p-2 lg:w-1/2 w-full">
                    <!-- MTN Modal  -->
                    <div id="mtnModalContainer" data-modal style="display: block;">
                        <div class="px-4 pt-2 border-b">
                            <div>                            
                                <img class="w-5" src="{{ asset('images/mtn_2.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                MTN
                            </div>
                        </div>
                        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataMtn" method="POST" class="text-xs lg:text-sm">
                            @csrf 
                            <div class="px-2 pb-2 lg:flex justify-between">
                                <div class="mt-3 w-full">
                                    <label for="data_type">Data Type</label><br>
                                    <select id="planTypeSme" class="plan_input_box" name="plan_type">
                                        <option value=""></option>
                                            @php
                                                $specialIds = [333];   
                                            @endphp

                                            @foreach($asbdata_dataPlansMtnSme as $data)
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
                                <div class="px-2 pb-2 lg:flex justify-between">
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="amount">Amount</label><br>
                                        <input class="plan_input_box" name="network_id" value="1" hidden>
                                        <input id="dataUnit" class="plan_input_box" name="data_unit" hidden>
                                        <input id="transactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                                        <input id="transactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                                        <input id="transactionReference" class="plan_input_box" name="transaction_reference" hidden>
                                        <input id="planAmount" class="plan_input_box" name="amount" disabled>
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="transaction_no">Mobile Phone</label><br>
                                        <input type="number" required class="plan_input_box" name="transaction_no">
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="pin">Transaction PIN</label><br>
                                        <input id="custPin" type="password" required class="plan_input_box" name="pin">
                                    </div>
                                </div>
                            </div>
                            <div id="dataBuy" class="px-2 pb-3 hidden">
                                <div class="my-1 flex justify-center">
                                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-2 text-white rounded-md text-xs w-full" type="submit" value="BUY" name="submit">
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
                    <!-- Airtel Modal  -->
                    <div id="airtelModalContainer" data-modal style="display: none;">
                        <div class="px-4 pt-2 border-b">
                            <div>                            
                                <img class="w-5" src="{{ asset('images/airtel.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                Airtel 
                            </div>
                        </div>
                        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataAirtel" method="POST" class="text-xs lg:text-sm">
                            @csrf 
                            <div class="px-2 pb-2 lg:flex justify-between">
                                <div class="mt-3 w-full">
                                    <label for="data_type">Data Type</label><br>
                                    <select id="airtelDataType" class="plan_input_box" name="plan_type">
                                        <option value=""></option>
                                        @php
                                            $specialIds = [230, 231, 226];
                                            $corporate_data = [230, 231, 226, 227, 228, 229, 232, 275, 276];
                                        @endphp
                                        
                                        @foreach($asbdata_dataPlansAirtelAll as $data)
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
                                <div class="px-2 pb-2 lg:flex justify-between">
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="amount">Amount</label><br>
                                        <input class="plan_input_box" name="network_id" value="4" hidden>
                                        <input id="airtelDataUnit" class="plan_input_box" name="data_unit" hidden>
                                        <input id="airtelTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                                        <input id="airtelTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                                        <input id="airtelTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                                        <input id="airtelPlanAmount" class="plan_input_box" name="amount" disabled>
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="transaction_no">Mobile Phone</label><br>
                                        <input type="number" required class="plan_input_box" name="transaction_no">
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="pin">Transaction PIN</label><br>
                                        <input id="airtelCustPin" type="password" required class="plan_input_box" name="pin">
                                    </div>
                                </div>
                            </div>
                            <div id="airtelDataBuy" class="px-2 pb-3 hidden">
                                <div class="my-2 flex justify-center">
                                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-2 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
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
                    <!-- Glo Modal  -->
                    <div id="gloModalContainer" data-modal style="display: none;">
                        <div class="px-4 pt-2 border-b">
                            <div>                            
                                <img class="w-5" src="{{ asset('images/glo_2.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                Glo 
                            </div>
                        </div>
                        <form action="{{ route('cust-data-purchase') }}" id="purchaseDataGlo" method="POST" class="text-xs lg:text-sm">
                            @csrf 
                            <div class="px-2 pb-2 lg:flex justify-between">
                                <div class="mt-3 w-full">
                                    <label for="data_type">Data Type</label><br>
                                    <select id="gloDataType" class="plan_input_box" name="plan_type">
                                        <option value=""></option>
                                        @php
                                            $specialIds = [233, 234];
                                            $corporate_data = [233, 234, 239, 238, 237, 236, 235];
                                
                                            $corporate_data_map = array_flip($corporate_data);
                                            
                                            $filteredDataPlans = array_filter($asbdata_dataPlansGloAll, function($data) use ($corporate_data_map) {
                                                return isset($corporate_data_map[$data['dataplan_id']]);
                                            });
                                            
                                            usort($filteredDataPlans, function($a, $b) use ($corporate_data_map) {
                                                return $corporate_data_map[$a['dataplan_id']] <=> $corporate_data_map[$b['dataplan_id']];
                                            });
                                        @endphp
                                        @foreach($filteredDataPlans as $data)
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
                                <div class="px-2 pb-2 lg:flex justify-between">
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="amount">Amount</label><br>
                                        <input class="plan_input_box" name="network_id" value="2" hidden>
                                        <input id="gloDataUnit" class="plan_input_box" name="data_unit" hidden>
                                        <input id="gloTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                                        <input id="gloTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                                        <input id="gloTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                                        <input id="gloPlanAmount" class="plan_input_box" name="amount" disabled>
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="transaction_no">Mobile Phone</label><br>
                                        <input type="number" required class="plan_input_box" name="transaction_no">
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="pin">Transaction PIN</label><br>
                                        <input id="gloCustPin" type="password" required class="plan_input_box" name="pin">
                                    </div>
                                </div>
                            </div>
                            <div id="gloDataBuy" class="px-2 pb-3 hidden">
                                <div class="my-2 flex justify-center">
                                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-2 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
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
                    <!-- 9 Mobile  -->
                    <div id="n9mobileModalContainer" data-modal style="display: none;">
                        <div class="px-4 pt-2 border-b">
                            <div>                            
                                <img class="w-5" src="{{ asset('images/9mobile.png') }}" alt="">
                            </div>
                            <div class="lg:text-xs text-xs lg:py-4 py-2">
                                9Mobile  
                            </div>
                        </div>
                        <form action="{{ route('cust-data-purchase') }}" id="purchaseData9Mobile" method="POST" class="text-xs lg:text-sm">
                            @csrf 
                            <div class="px-2 pb-2 lg:flex justify-between">
                                <div class="mt-3 w-full">
                                    <label for="data_type">Data Type</label><br>
                                    <select id="n9mobileDataType" class="plan_input_box" name="plan_type">
                                        <option value=""></option>
                                        @php
                                            $specialIds = [240, 241];
                                            $corporate_data = [240, 241, 242, 243, 244, 245, 248, 246, 249];
                                
                                            $corporate_data_map = array_flip($corporate_data);
                                            
                                            $filteredDataPlans = array_filter($asbdata_dataPlans9MobileAll, function($data) use ($corporate_data_map) {
                                                return isset($corporate_data_map[$data['dataplan_id']]);
                                            });
                                            
                                            usort($filteredDataPlans, function($a, $b) use ($corporate_data_map) {
                                                return $corporate_data_map[$a['dataplan_id']] <=> $corporate_data_map[$b['dataplan_id']];
                                            });
                                        @endphp
                                        @foreach($asbdata_dataPlans9MobileAll as $data)
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
                                <div class="px-2 pb-2 lg:flex justify-between">
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="amount">Amount</label><br>
                                        <input class="plan_input_box" name="network_id" value="3" hidden>
                                        <input id="n9mobileDataUnit" class="plan_input_box" name="data_unit" hidden>
                                        <input id="n9mobileTransactionAmount" class="plan_input_box" name="transaction_amount" hidden>
                                        <input id="n9mobileTransactionBuying" class="plan_input_box" name="transaction_buying" hidden>
                                        <input id="n9mobileTransactionReference" class="plan_input_box" name="transaction_reference" hidden>
                                        <input id="n9mobilePlanAmount" class="plan_input_box" name="amount" disabled>
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="transaction_no">Mobile Phone</label><br>
                                        <input type="number" required class="plan_input_box" name="transaction_no">
                                    </div>
                                    <div class="lg:my-3 my-1 w-full">
                                        <label for="pin">Transaction PIN</label><br>
                                        <input id="n9mobileCustPin" type="password" required class="plan_input_box" name="pin">
                                    </div>
                                </div>
                            </div>
                            <div id="n9mobileDataBuy" class="px-2 pb-3 hidden">
                                <div class="my-2 flex justify-center">
                                    <input style="background-color: #05976A;" class="bg-green-600 px-6 py-2 text-white rounded-md text-sm w-full" type="submit" value="BUY" name="submit">
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
                </div>
            </div>
        <!-- End of Services  -->
        <script>
            // ISP Modal 
            $(document).on('click', '[data-toggle="modal"]', function () {
                let targetModal = $(this).data('target');

                // Hide all modal containers first
                $('[data-modal]').hide();

                // Show only the clicked modal
                $(targetModal).show();
            });

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
        </script>
    </div>
@endsection