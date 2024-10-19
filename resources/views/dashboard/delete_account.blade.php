@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - Delete Account</title>        
@endsection

@section('pageContents')
    <!-- Account Details  -->
    <div  class="lg:mx-1 mx-3 font-bold text-xl py-1 px-2 text-center">
        Delete Account 
    </div>

    <div class="bg-white rounded-xl mb-4 my-4 p-6 lg:text-sm text-xs lg:w-1/3 w-full lg:mx-auto">
        <div>
            <form class="" action="{{ route('account-delete-confirmed', $cust->id) }}" method="POST" id="deleteAccountConfirmed">
                @csrf
                @method('PATCH')
                <!-- Loading -->
                <div class="loader hidden">
                    @include('includes.loader')
                </div>
                                            
                <!-- Feedback Container  -->
                <div id="feedbackContainer" class="my-2">@include('includes.messages')</div>

                <div class="py-2">
                    Are you sure you want to delete your account?
                </div>
                <div>
                    <div class="py-2">
                        <input required class="input_box my-2 w-full px-4" type="password" name="password" placeholder="Confirm Your Password">
                    </div>
                    <div class="my-2 flex justify-center">
                        <input class="text-xs bg-green-600 p-3 text-white rounded-lg" type="submit" value="Delete Account" name="submit">
                    </div>
                </div>
            </form>
        </div>
        <script>
            // Delete Account 
                $(document).on('submit', '#deleteAccountConfirmed', function() {
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
                                
                                $("#feedbackContainer").append(`<div class="alert alert-success text-xs text-center">${data.message}</div>`)
                                // Redirect 
                                setTimeout(function(){
                                    window.location = data.redirect
                                }, 2000)
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
                                        $("#feedbackContainer").append(`<div class="alert alert-danger text-xs">${data.message}</div>`);
                                        // Redirect 
                                        setTimeout(function(){
                                            window.location = data.redirect
                                        }, 2000)
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
            // End of SignUp
        </script>
    </div>
@endsection

