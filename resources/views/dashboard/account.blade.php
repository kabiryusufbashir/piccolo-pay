@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - Account</title>        
@endsection

@section('pageContents')
    <!-- Account Details  -->
    <div  class="lg:mx-1 mx-3 font-bold text-xl py-1 px-2">
        Account Settings 
    </div>

    <div class="bg-white rounded-xl mb-4 my-4 p-6 lg:mx-1 mx-3 lg:text-sm text-xs">
        <!-- Personal data  -->
        <div class="my-4">
            <div class="my-4 font-bold">
                Personal Data
            </div>
            <div class="px-8 py-6 rounded-2xl border lg:flex justify-between">
                <div class="lg:my-4 my-2 lg:py-4 py-2">
                    <div>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 9.5C13.933 9.5 15.5 7.933 15.5 6C15.5 4.067 13.933 2.5 12 2.5C10.067 2.5 8.5 4.067 8.5 6C8.5 7.933 10.067 9.5 12 9.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 21C2 16.5815 6.0295 13 11 13M15.5 21.5L20.5 16.5L18.5 14.5L13.5 19.5V21.5H15.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold">Full Name</div>
                        <div>
                            {{ $cust->fullname }}
                        </div>
                    </div>
                </div>
                <div class="lg:my-4 my-2 lg:py-4 py-2">
                    <div>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.875 5H4.125C3.08947 5 2.25 5.83947 2.25 6.875V18.125C2.25 19.1605 3.08947 20 4.125 20H19.875C20.9105 20 21.75 19.1605 21.75 18.125V6.875C21.75 5.83947 20.9105 5 19.875 5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.25 8L12 13.25L18.75 8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold">Email</div>
                        <div>
                            {{ $cust->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security  -->
        <div class="my-4">
            <div class="my-4 font-bold">
                Security Settings
            </div>
            <!-- Loading -->
            <div class="loader hidden">
                @include('includes.loader')
            </div>
            <div class="px-8 py-6 rounded-2xl border lg:grid grid-cols-2 gap-4">
                <div class="lg:my-4 my-2 lg:py-4 py-2">
                    <div>
                        <svg width="32" height="34" viewBox="0 0 32 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.3333 28C15.9627 28 14.6502 27.7378 13.396 27.2135C12.1427 26.6892 11.0138 25.9558 10.0093 25.0135L10.9867 24.0331C11.8658 24.8462 12.8311 25.4815 13.8827 25.9389C14.9333 26.3963 16.0836 26.625 17.3333 26.625C19.9289 26.625 22.1333 25.69 23.9467 23.82C25.76 21.95 26.6667 19.6767 26.6667 17C26.6667 14.3417 25.7556 12.0729 23.9333 10.1938C22.1111 8.31458 19.9111 7.375 17.3333 7.375C14.7556 7.375 12.5556 8.31458 10.7333 10.1938C8.91112 12.0729 8.00001 14.3417 8.00001 17V18.9071L10.8693 15.9481L11.82 16.8941L7.33335 21.521L2.84668 16.8941L3.79735 15.9481L6.66668 18.9415V17C6.66668 15.4756 6.9449 14.0465 7.50135 12.7127C8.05779 11.379 8.81913 10.2135 9.78535 9.21613C10.7525 8.21971 11.8827 7.43458 13.176 6.86075C14.4693 6.28692 15.8551 6 17.3333 6C18.8116 6 20.1973 6.28692 21.4907 6.86075C22.784 7.43458 23.9142 8.21971 24.8813 9.21613C25.8476 10.2135 26.6089 11.379 27.1653 12.7127C27.7218 14.0465 28 15.4756 28 17C28 20.0498 26.9613 22.6453 24.884 24.7866C22.8076 26.9289 20.2907 28 17.3333 28ZM13.4867 22.1838V15.625H14.82V14.0919C14.82 13.3705 15.0645 12.7581 15.5533 12.2549C16.0396 11.7516 16.6329 11.5 17.3333 11.5C18.0329 11.5 18.6267 11.7516 19.1147 12.2549C19.6027 12.759 19.8467 13.3714 19.8467 14.0919V15.625H21.18V22.1838H13.4867ZM15.8467 15.625H18.82V14.0919C18.82 13.6665 18.6751 13.3045 18.3853 13.0056C18.0956 12.7068 17.7449 12.5578 17.3333 12.5588C16.9218 12.5588 16.5707 12.7082 16.28 13.007C15.9911 13.3058 15.8467 13.6679 15.8467 14.0932V15.625Z" fill="#1A1A1A"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <div class="font-bold">Password</div>
                        <div>
                            <form action="{{ route('cust-account-password') }}" method="POST" id="custPasswordForm">
                                @csrf              
                                <!-- Feedback Container  -->
                                <div id="feedbackContainer" class="my-2">@include('includes.messages')</div>

                                <div>
                                    <input class="input_box my-2 w-full px-4" type="password" placeholder="Old Password" name="old_password" required>
                                </div>
                                <div>
                                    <input class="input_box my-2 w-full px-4" type="password" placeholder="New Password" name="new_password" required>
                                </div>
                                <div>
                                    <input class="input_box my-2 w-full px-4" type="password" placeholder="Confirm Password" name="confirm_password" required>
                                </div>
                                <div class="my-2 submit_box">
                                    <input class="text-xs" type="submit" value="Change Password" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="lg:my-4 my-2 lg:py-4 py-2">
                    <div>
                        <svg width="32" height="34" viewBox="0 0 32 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.3333 28C15.9627 28 14.6502 27.7378 13.396 27.2135C12.1427 26.6892 11.0138 25.9558 10.0093 25.0135L10.9867 24.0331C11.8658 24.8462 12.8311 25.4815 13.8827 25.9389C14.9333 26.3963 16.0836 26.625 17.3333 26.625C19.9289 26.625 22.1333 25.69 23.9467 23.82C25.76 21.95 26.6667 19.6767 26.6667 17C26.6667 14.3417 25.7556 12.0729 23.9333 10.1938C22.1111 8.31458 19.9111 7.375 17.3333 7.375C14.7556 7.375 12.5556 8.31458 10.7333 10.1938C8.91112 12.0729 8.00001 14.3417 8.00001 17V18.9071L10.8693 15.9481L11.82 16.8941L7.33335 21.521L2.84668 16.8941L3.79735 15.9481L6.66668 18.9415V17C6.66668 15.4756 6.9449 14.0465 7.50135 12.7127C8.05779 11.379 8.81913 10.2135 9.78535 9.21613C10.7525 8.21971 11.8827 7.43458 13.176 6.86075C14.4693 6.28692 15.8551 6 17.3333 6C18.8116 6 20.1973 6.28692 21.4907 6.86075C22.784 7.43458 23.9142 8.21971 24.8813 9.21613C25.8476 10.2135 26.6089 11.379 27.1653 12.7127C27.7218 14.0465 28 15.4756 28 17C28 20.0498 26.9613 22.6453 24.884 24.7866C22.8076 26.9289 20.2907 28 17.3333 28ZM13.4867 22.1838V15.625H14.82V14.0919C14.82 13.3705 15.0645 12.7581 15.5533 12.2549C16.0396 11.7516 16.6329 11.5 17.3333 11.5C18.0329 11.5 18.6267 11.7516 19.1147 12.2549C19.6027 12.759 19.8467 13.3714 19.8467 14.0919V15.625H21.18V22.1838H13.4867ZM15.8467 15.625H18.82V14.0919C18.82 13.6665 18.6751 13.3045 18.3853 13.0056C18.0956 12.7068 17.7449 12.5578 17.3333 12.5588C16.9218 12.5588 16.5707 12.7082 16.28 13.007C15.9911 13.3058 15.8467 13.6679 15.8467 14.0932V15.625Z" fill="#1A1A1A"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <div class="font-bold">Transaction PIN</div>
                        <div>
                            <form class="" action="{{ route('cust-account-pin') }}" method="POST" id="custPinForm">
                                @csrf
                                <!-- Feedback Container  -->
                                <div id="feedbackContainerPin" class="my-2">@include('includes.messages')</div>
                                @if(!empty($cust->pin))
                                    <div>
                                        <input class="input_box my-2 w-full px-4" type="number" placeholder="Old PIN" name="old_pin" required>
                                    </div>
                                @endif 
                                <div>
                                    <input class="input_box my-2 w-full px-4" type="number" placeholder="New PIN" name="new_pin" required>
                                </div>
                                <div>
                                    <input class="input_box my-2 w-full px-4" type="number" placeholder="Confirm PIN" name="confirm_pin" required>
                                </div>
                                <div class="my-2 submit_box">
                                    <input class="text-xs" type="submit" value="Change PIN" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Change Password 
            $(document).on('submit', '#custPasswordForm', function() {
                var e = this

                // display Loader 
                $('.loader').show()

                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        
                        if(data.status) {
                            // Loader Hide 
                            $('.loader').hide()
                            
                            $('#feedbackContainer').fadeIn().delay(5000).fadeOut()
                            
                            $("#feedbackContainer").append('<div class="alert alert-success text-xs">' + data.message + '</div>')
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
                                    $("#feedbackContainer").append('<div class="alert alert-danger text-xs">' + data.errors + '</div>');
                                }else if(typeof data.errors === 'object') {
                                    // If errors is an object (possibly from server validation)
                                    $.each(data.errors, function (key, val) {
                                        $("#feedbackContainer").append('<div class="alert alert-danger text-xs">' + val + '</div>');
                                    });
                                }else{
                                    // Handle other cases or provide a default message
                                    $("#feedbackContainer").append('<div class="alert alert-danger text-xs">' + data.message + '</div>');
                                }
                            }

                            // Redirect 
                            setTimeout(function(){
                                location.reload()
                            }, 7000)

                        }
                    
                    }
                });

                return false;
            });
        // End of Change Password

        // Change Pin
            $(document).on('submit', '#custPinForm', function() {
                var e = this

                // display Loader 
                $('.loader').show()

                $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        
                        if(data.status) {
                            // Loader Hide 
                            $('.loader').hide()
                            
                            $('#feedbackContainerPin').fadeIn().delay(5000).fadeOut()
                            
                            $("#feedbackContainerPin").append('<div class="alert alert-success text-xs">' + data.message + '</div>')
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
                                    $("#feedbackContainerPin").append('<div class="alert alert-danger text-xs">' + data.errors + '</div>');
                                }else if(typeof data.errors === 'object') {
                                    // If errors is an object (possibly from server validation)
                                    $.each(data.errors, function (key, val) {
                                        $("#feedbackContainerPin").append('<div class="alert alert-danger text-xs">' + val + '</div>');
                                    });
                                }else{
                                    // Handle other cases or provide a default message
                                    $("#feedbackContainerPin").append('<div class="alert alert-danger text-xs">' + data.message + '</div>');
                                }
                            }

                            // Redirect 
                            setTimeout(function(){
                                location.reload()
                            }, 7000)

                        }
                    
                    }
                });

                return false;
            });
        // End of Change Pin
    </script>
@endsection

