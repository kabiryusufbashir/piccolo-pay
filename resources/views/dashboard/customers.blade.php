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
            <table class="w-full text-xs">
                <tr class="my-4 text-xs gray-bg">
                    <th class="text-center py-3 border">Customer</th>    
                    <th class="text-center py-3 border">Username</th>    
                    <th class="text-center py-3 border">Email</th>    
                    <th class="text-center py-3 border">Balance</th>    
                    <th class="text-center py-3 border">Phone</th>     
                    <th class="text-center py-3 border">More</th>    
                </tr>
                <!-- Fetch Data  -->
                @if(count($customers_list) > 0)
                    @foreach($customers_list as $record)
                    <tr class="border text-xs transaction-record">
                        <td class="text-center py-3 border">{{ $record->fullname }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->username }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->email }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">₦{{ number_format($record->acct_balance, 2, '.', ',') }}</td>
                        <td class="text-center py-3 whitespace-nowrap border">{{ $record->phone }}</td>
                        <td class="text-center py-3 whitespace-nowrap cursor-pointer border"><a id="viewCustomer" data-id="{{ $record->id }}"><span class="green-bg p-2 text-white rounded-lg text-xs">View</span></a></td>
                    </tr>    
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
            </table>
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