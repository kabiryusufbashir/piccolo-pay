@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - Customers</title>        
@endsection

@section('pageContents')
    <!-- Banks Details  -->
    <div  class="lg:mx-1 mx-3 font-bold text-xl py-1 px-2">
        Customers 
    </div>

    <div class="bg-white rounded-xl mb-4 my-4 p-6 lg:mx-1 mx-3 lg:text-sm">
        <div class="my-4 lg:flex justify-between items-center py-2">
            <div class="my-4 font-bold">
                Customer's List
            </div>
            <div class="my-4">
                <input id="searchInput" style="width:250px;" class="input_box" type="text" placeholder="Search Customer" name="search_customer">
            </div>
        </div>
        <!-- Customer Table  -->
        <div class="table-container">
            <!-- Fetch Data  -->
            @if(count($customers_list) > 0)
                @foreach($customers_list as $record)
                <a class="cursor-pointer hover:text-black transaction-record" id="viewCustomer" data-id="{{ $record->id }}">
                    <div class="flex justify-between py-3 items-center text-xs lg:text-sm border-t">
                        <!-- Transaction Type and Info  -->
                        <div class="flex">
                            <div>
                                <span>
                                    <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 19.75C3 18.5565 3.47411 17.4119 4.31802 16.568C5.16193 15.7241 6.30653 15.25 7.5 15.25H16.5C17.6935 15.25 18.8381 15.7241 19.682 16.568C20.5259 17.4119 21 18.5565 21 19.75C21 20.3467 20.7629 20.919 20.341 21.341C19.919 21.7629 19.3467 22 18.75 22H5.25C4.65326 22 4.08097 21.7629 3.65901 21.341C3.23705 20.919 3 20.3467 3 19.75Z" stroke="#239E21" stroke-width="1.5" stroke-linejoin="round"/>
                                        <path d="M12 10.75C13.864 10.75 15.375 9.23896 15.375 7.375C15.375 5.51104 13.864 4 12 4C10.136 4 8.625 5.51104 8.625 7.375C8.625 9.23896 10.136 10.75 12 10.75Z" stroke="#239E21" stroke-width="1.5"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="px-2 lg:px-4">
                                <span><b>{{ $record->fullname }}</b></span> <br>
                                <span class="gray-text">{{ $record->email }}</span><br>
                                <span class="gray-text">{{ $record->username }}</span><br>
                            </div>
                        </div>
                        <!-- Transaction Amount  -->
                        <div class="text-right">
                            <span><b>₦{{ number_format($record->acct_balance, 2, '.', ',') }}</b></span><br>
                            <span class="gray-text">{{ $record->phone }}</span><br>
                            <span class="gray-text">{!! $record->customerStatus($record->cust_status) !!}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center py-3">
                        <div class="lg:mx-1 mx-3 yus-text-red text-sm px-2 lg:text-sm text-xs">
                            No Customer Found
                        </div>
                    </td>
                </tr>
            @endif
            <div class="lg:mx-1 mx-3 yus-text-red text-sm px-2 lg:text-sm text-xs text-center py-2" id="notFoundMessage" style="display: none;">No Customer Found</div>
        </div>
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