@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - Customers</title>        
@endsection

@section('pageContents')
    <!-- Banks Details  -->
    <div  class="lg:mx-1 mx-3 font-bold text-xl py-1 px-2">
        Customers 
    </div>

    <div class="bg-white rounded-xl mb-24 lg:mb-2 mt-12 lg:mt-0 p-6 lg:mx-1 mx-3 lg:text-sm">
        <div class="my-2 lg:flex justify-between items-center py-2">
            <div class="my-1 font-bold">
                Customers 
            </div>
            <div class="my-1">
                <input id="searchInput" style="width:250px;" class="input_box" type="text" placeholder="Search Customer" name="search_customer">
            </div>
        </div>
        <!-- Customer Table  -->
        <div class="table-container">
            <!-- Fetch Data  -->
            @if(count($customers_list) > 0)
                @foreach($customers_list as $record)
                    <div class="flex justify-between py-3 items-center text-xs lg:text-sm border-t transaction-record">
                        <!-- Transaction Type and Info  -->
                        <div class="flex">
                            <div>
                                <span>
                                    <svg width="47" height="46" viewBox="0 0 47 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 19.75C3 18.5565 3.47411 17.4119 4.31802 16.568C5.16193 15.7241 6.30653 15.25 7.5 15.25H16.5C17.6935 15.25 18.8381 15.7241 19.682 16.568C20.5259 17.4119 21 18.5565 21 19.75C21 20.3467 20.7629 20.919 20.341 21.341C19.919 21.7629 19.3467 22 18.75 22H5.25C4.65326 22 4.08097 21.7629 3.65901 21.341C3.23705 20.919 3 20.3467 3 19.75Z" stroke="#239E21" stroke-width="1.5" stroke-linejoin="round"/>
                                        <path d="M12 10.75C13.864 10.75 15.375 9.23896 15.375 7.375C15.375 5.51104 13.864 4 12 4C10.136 4 8.625 5.51104 8.625 7.375C8.625 9.23896 10.136 10.75 12 10.75Z" stroke="#239E21" stroke-width="1.5"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>{{ $record->fullname }}</b></span> <br>
                            </div>
                        </div>
                        <!-- Transaction Amount  -->
                        <div class="text-right">
                            <span><b>₦{{ number_format($record->acct_balance, 2, '.', ',') }}</b></span><br>
                            <a class="cursor-pointer hover:text-black" id="viewCustomer" data-id="{{ $record->id }}">
                                <span class="text-lg"><i class="fa-regular fa-eye"></i></span><br>
                            </a>
                            
                            <div id="fundWalletModal"  data-id="{{ $record->id }}" class="cursor-pointer text-lg"><i class="fa-solid fa-money-bill"></i></div><br>
                        </div>
                    </div>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center py-3">
                        <div class="lg:mx-1 mx-3 yus-text-red px-2 lg:text-sm text-xs">
                            No Customer Found
                        </div>
                    </td>
                </tr>
            @endif
            <div class="lg:mx-1 mx-3 yus-text-red px-2 lg:text-sm text-xs text-center py-2" id="notFoundMessage" style="display: none;">No Customer Found</div>
        </div>
    </div>
    
    <!-- View Transaction  -->
    <div id="viewCustomerModal" class="yus_modal">
        <div class="yus_modal-content text-xs lg:text-sm">
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                    
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Customer Information
                    </div>
                    <div>
                        <div id="closeCustomerModal" class="cursor-pointer">
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
                <div class="border rounded-xl mb-4 my-4 p-6 lg:mx-1 mx-3 lg:text-sm text-xs">
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Customer Name
                        </div>
                        <div id="customerName"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Username
                        </div>
                        <div id="customerUsername"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Mobile Number
                        </div>
                        <div id="customerNumber"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Customer Email
                        </div>
                        <div id="customerEmail"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Account Balance
                        </div>
                        <div id="customerAccount"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Date Joined
                        </div>
                        <div id="customerDateJoined"></div>
                    </div>
                    <div class="lg:flex justify-between py-3">
                        <div>
                            Status
                        </div>
                        <div id="customerStatus"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- fundWallet  -->
        <div id="fundWalletContent" class="yus_modal">
            <form action="{{ route('cust-fund-wallet') }}" id="fundWalletForm" method="POST" class="yus_modal-content text-xs lg:text-sm">
                @csrf 

                <div class="px-4 font-bold pt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            Fund Customer Wallet
                        </div>
                        <div>
                            <div id="closefundWalletModal" class="cursor-pointer">
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
                <!-- Amount  -->
                
                <div class="my-3 w-full">
                    <label for="amount">Amount</label><br>
                    <input class="plan_input_box" id="fundCustId" name="cust_id" placeholder="Customer ID" hidden>
                    <input required placeholder="Amount" class="plan_input_box" name="amount">
                </div>
                <div class="my-3 w-full">
                    <label for="narration">Narration</label><br>
                    <input required type="text" class="plan_input_box" name="narration" placeholder="Narration">
                </div>
                <div class="my-3 w-full">
                    <label for="pin">Transaction PIN</label><br>
                    <input required type="password" class="plan_input_box" name="transaction_pin" placeholder="PIN">
                </div>
                <div class="px-10 pb-5">
                    <div class="my-2 submit_box">
                        <input class="" type="submit" value="Fund" name="submit">
                    </div>
                </div>

                <!-- Loading -->
                <div class="loader hidden">
                    @include('includes.loader')
                </div>
                                            
                <!-- Feedback Container  -->
                <div id="feedbackContainerFundWallet" class="my-2">@include('includes.messages')</div>

            </form>
        </div>

    <script>
        // Get the input field, "Not Found" message, and listen for input events
        const searchInput = document.getElementById('searchInput');
        const notFoundMessage = document.getElementById('notFoundMessage');
    
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase().trim(); // Get the search text and convert to lowercase
    
            // Loop through each record and hide/show based on the search text
            const records = document.querySelectorAll('.transaction-record');
            let found = false;
            records.forEach(record => {
                const textContent = record.textContent.toLowerCase(); // Get the text content of the record
                if (textContent.includes(searchText)) {
                    record.style.display = ''; // Show the record if it matches the search text
                    found = true; // Set found to true if at least one record is found
                } else {
                    record.style.display = 'none'; // Hide the record if it doesn't match
                }
            });
    
            // Show/hide "Not Found" message based on search results
            if (found) {
                notFoundMessage.style.display = 'none'; // Hide message if records are found
            } else {
                notFoundMessage.style.display = ''; // Show message if no records are found
            }
        });
    </script>
@endsection