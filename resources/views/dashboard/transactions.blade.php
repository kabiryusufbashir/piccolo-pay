@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - Transactions</title>        
@endsection

@section('pageContents')
    <!-- Banks Details  -->
    <div  class="lg:mx-1 mx-3 font-bold text-xl py-1 px-2">
        Transactions 
    </div>

    <div class="bg-white rounded-xl mb-4 my-4 p-6 lg:mx-1 mx-3 lg:text-sm">
        <div class="my-4 lg:flex justify-between items-center py-2">
            <div class="my-4 font-bold">
                History
            </div>
            <div class="my-4">
                <input style="width:250px;" class="input_box" type="text" placeholder="Search Transaction" name="search_transaction">
            </div>
        </div>
        <!-- Transaction Table  -->
        <div class="table-container">
            <table class="w-full text-xs">
                <tr class="my-4 text-xs gray-bg">
                    <th class="text-center py-3 border">Type</th>    
                    <th class="text-center py-3 border">Date</th>    
                    <th class="text-center py-3 border">Phone</th>    
                    <th class="text-center py-3 border">Amount</th>    
                    <th class="text-center py-3 border">Reference</th>    
                    <th class="text-center py-3 border">Status</th>    
                    <th class="text-center py-3 border">More</th>    
                </tr>
                <!-- Fetch Data  -->
                @if(count($transactions) > 0)
                    @foreach($transactions as $record)
                    <tr class="border text-xs">
                        <td class="text-center py-3 border">{{ $record->transaction_type }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->transactionDate($record->created_at) }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->transaction_no }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->transaction_paid }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->reference }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{!! $record->transactionStatus($record->status) !!}</td>
                        <td class="text-center py-3 whitespace-nowrap cursor-pointer border"><a id="viewTransaction" data-id="{{ $record->reference }}"><span class="green-bg p-2 text-white rounded-lg text-xs">Details</span></a></td>
                    </tr>    
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center py-3">
                            <div class="lg:mx-1 mx-3 yus-text-red text-sm px-2 lg:text-sm text-xs">
                                No Transaction Found
                            </div>
                        </td>
                    </tr>
                @endif
            </table>
        </div>


    </div>

    <!-- View Transaction  -->
    <div id="viewTransactionModal" class="yus_modal">
        <div class="yus_modal-content text-xs lg:text-sm">
            <div class="loader hidden">
                @include('includes.loader')
            </div>
                                    
            <div class="px-4 font-bold pt-4">
                <div class="flex justify-between items-center">
                    <div>
                        Transaction Receipt
                    </div>
                    <div>
                        <div id="closeTransactionModal" class="cursor-pointer">
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
                            Transaction Type
                        </div>
                        <div id="transactionType"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Transaction Ref
                        </div>
                        <div id="transactionRef"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Mobile Number
                        </div>
                        <div id="mobileNumber"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Network Provider
                        </div>
                        <div id="networkProvider"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Amount
                        </div>
                        <div id="transactionAmount"></div>
                    </div>
                    <div class="lg:flex justify-between border-b py-3">
                        <div>
                            Date
                        </div>
                        <div id="transactionDate"></div>
                    </div>
                    <div class="lg:flex justify-between py-3">
                        <div>
                            Status
                        </div>
                        <div id="transactionStatus"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection