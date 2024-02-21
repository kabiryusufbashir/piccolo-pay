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
        <hr>
        @if(count($transactions) > 0)
            @foreach($transactions as $record)
                <div class="flex justify-between py-3 items-center text-xs lg:text-sm">
                    <!-- Transaction Type and Info  -->
                    <div class="flex">
                        <!-- Transaction Type  -->
                        @if($record->transaction_type == 'Deposit')
                            <div>
                                <span>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="18.5" cy="18.5" r="18.5" fill="#239E21"/>
                                        <path d="M18.1043 9.79199L10.5835 13.7503V15.3337H25.6252V13.7503M21.6668 16.917V22.4587H24.0418V16.917M10.5835 26.417H25.6252V24.042H10.5835M16.9168 16.917V22.4587H19.2918V16.917M12.1668 16.917V22.4587H14.5418V16.917H12.1668Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>Deposit</b></span> <br>
                                <span class="gray-text">{{ $record->transactionDate($record->created_at) }}</span><br>
                                @if($customer->cust_type == 1)
                                    <span class="gray-text">{{ $record->cust_id }}</span><br>
                                @endif
                            </div>
                        @elseif($record->transaction_type == 'Data')
                            <div>
                                <span>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="18.5" cy="18.5" r="18.5" fill="#FFB800"/>
                                        <path d="M26.2263 16.1626L19.3201 24.4919C19.2202 24.6125 19.0949 24.7094 18.9531 24.7757C18.8112 24.8419 18.6565 24.8759 18.4999 24.8751C18.3439 24.8755 18.1896 24.8413 18.0483 24.7751C17.907 24.7088 17.782 24.6121 17.6825 24.4919L10.7736 16.1626C10.6826 16.054 10.6149 15.9279 10.5745 15.7921C10.534 15.6563 10.5218 15.5137 10.5385 15.373C10.5551 15.232 10.6 15.0957 10.6703 14.9724C10.7407 14.8491 10.8352 14.7412 10.9482 14.6552C13.1186 13.0041 15.7729 12.1148 18.4999 12.1251C21.227 12.1148 23.8812 13.0041 26.0517 14.6552C26.1646 14.7412 26.2591 14.8491 26.3295 14.9724C26.3999 15.0957 26.4448 15.232 26.4614 15.373C26.4781 15.5137 26.4659 15.6563 26.4254 15.7921C26.385 15.9279 26.3172 16.054 26.2263 16.1626Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>Data Purchase</b></span><br>
                                <span class="gray-text">{{ $record->transactionDate($record->created_at) }} - {{ $record->transaction_no }}</span><br>
                                @if($customer->cust_type == 1)
                                    <span class="gray-text">{{ $record->cust_id }}</span><br>
                                @endif
                            </div>
                        @elseif($record->transaction_type == 'Airtime')
                            <div>
                                <span>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="18.5" cy="18.5" r="18.5" fill="#FF0C37"/>
                                        <path d="M17.1778 17.4627L18.3189 16.4172C18.6309 16.1307 18.8502 15.7576 18.9487 15.3456C19.0471 14.9337 19.0202 14.5017 18.8714 14.1052L18.3848 12.8057C18.203 12.3206 17.8431 11.923 17.3783 11.6941C16.9136 11.4651 16.3791 11.4218 15.8837 11.5732C14.0604 12.131 12.659 13.8257 13.0903 15.8381C13.374 17.162 13.917 18.8237 14.9455 20.5917C15.9761 22.364 17.1533 23.673 18.1627 24.5931C19.6863 25.9797 21.8645 25.6333 23.2659 24.3264C23.6416 23.9761 23.8695 23.4958 23.9033 22.9833C23.937 22.4708 23.7741 21.9647 23.4476 21.5682L22.5551 20.4844C22.2859 20.1567 21.9248 19.917 21.5183 19.7962C21.1118 19.6754 20.6784 19.679 20.2739 19.8065L18.7991 20.2708C18.4183 19.8778 18.0845 19.4417 17.8047 18.9714C17.5345 18.4958 17.3239 17.9887 17.1778 17.4616V17.4627Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>Airtime Purchase</b></span> <br>
                                <span class="gray-text">{{ $record->transactionDate($record->created_at) }} - {{ $record->transaction_no }}</span><br>
                                @if($customer->cust_type == 1)
                                    <span class="gray-text">{{ $record->cust_id }}</span><br>
                                @endif
                            </div>
                        @elseif($record->transaction_type == 'Cable')
                            <div>
                                <span>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="18.5" cy="18.5" r="18.5" fill="#6F00FF"/>
                                        <path d="M11.4165 14.5153C11.4165 14.0691 11.5937 13.6412 11.9092 13.3257C12.2247 13.0102 12.6526 12.833 13.0988 12.833H23.9009C24.347 12.833 24.7749 13.0102 25.0904 13.3257C25.4059 13.6412 25.5832 14.0691 25.5832 14.5153V21.0674C25.5832 21.5136 25.4059 21.9415 25.0904 22.2569C24.7749 22.5724 24.347 22.7497 23.9009 22.7497H13.0988C12.6526 22.7497 12.2247 22.5724 11.9092 22.2569C11.5937 21.9415 11.4165 21.5136 11.4165 21.0674V14.5153ZM13.9842 23.9893C13.8668 23.9893 13.7542 24.0359 13.6712 24.1189C13.5881 24.2019 13.5415 24.3146 13.5415 24.432C13.5415 24.5494 13.5881 24.662 13.6712 24.745C13.7542 24.828 13.8668 24.8747 13.9842 24.8747H23.0155C23.1329 24.8747 23.2455 24.828 23.3285 24.745C23.4115 24.662 23.4582 24.5494 23.4582 24.432C23.4582 24.3146 23.4115 24.2019 23.3285 24.1189C23.2455 24.0359 23.1329 23.9893 23.0155 23.9893H13.9842Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>Cable Subscription</b></span><br>
                                <span class="text-gray">{{ $record->transactionDate($record->created_at) }}</span><br>
                                @if($customer->cust_type == 1)
                                    <span class="gray-text">{{ $record->cust_id }}</span><br>
                                @endif
                            </div>
                        @elseif($record->transaction_type == 'Electricity')
                            <div>
                                <span>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="18.5" cy="18.5" r="18.5" fill="#FF5C00"/>
                                        <path d="M18.1457 24.166L21.5882 17.2739H19.2082V12.8327L15.6665 19.7248H18.1457V24.166ZM18.4998 11.416C20.4478 11.416 22.1123 12.1243 23.4936 13.5056C24.8748 14.8868 25.5832 16.5514 25.5832 18.4993C25.5832 20.4473 24.8748 22.1118 23.4936 23.4931C22.1123 24.8743 20.4478 25.5827 18.4998 25.5827C16.5519 25.5827 14.8873 24.8743 13.5061 23.4931C12.1248 22.1118 11.4165 20.4473 11.4165 18.4993C11.4165 16.5514 12.1248 14.8868 13.5061 13.5056C14.8873 12.1243 16.5519 11.416 18.4998 11.416Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>Electricity Purchase</b></span><br>
                                <span class="text-gray">{{ $record->transactionDate($record->created_at) }} - {{ $record->transaction_no }}</span><br>
                                @if($customer->cust_type == 1)
                                    <span class="gray-text">{{ $record->cust_id }}</span><br>
                                @endif
                            </div>
                        @endif
                    </div>
                    <!-- Transaction Amount  -->
                    <div>
                        <b>{{ $record->amountReadable($record->transaction_paid) }}</b>
                        <br>
                        {!! $record->transactionStatus($record->status) !!}
                    </div>
                </div>
                
            @endforeach
        @else
            <div class="lg:mx-1 mx-3 yus-text-red text-sm px-2 lg:text-sm text-xs">
                No Transaction Found
            </div>
        @endif
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