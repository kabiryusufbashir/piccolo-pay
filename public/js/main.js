// Data MTN 
$(document).on('submit', '#purchaseDataMtn', function() {
    var e = this
    let container = $('#feedbackContainerMtn')

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
                        container.append('<div class="alert alert-danger text-xs text-center">An error occurred.</div>');
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

// Data GLO 
$(document).on('submit', '#purchaseDataGlo', function() {
    var e = this
    let container = $('#feedbackContainerGlo')

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
                        container.append('<div class="alert alert-danger text-xs text-center">An error occurred.</div>');
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

// Data Airtel
$(document).on('submit', '#purchaseDataAirtel', function() {
    var e = this
    let container = $('#feedbackContainerAirtel')

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
                        container.append('<div class="alert alert-danger text-xs text-center">An error occurred.</div>');
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

// Data 9Mobile
$(document).on('submit', '#purchaseData9Mobile', function() {
    var e = this
    let container = $('#feedbackContainer9Mobile')

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
                        container.append('<div class="alert alert-danger text-xs text-center">An error occurred.</div>');
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

// Purchase Airtime
$(document).on('submit', '#purchaseAirtime', function() {
    var e = this
    let container = $('#feedbackContainerAirtime')

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
                        container.append('<div class="alert alert-danger text-xs text-center">An error occurred.</div>');
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

// Close Transaction Modal 
$(document).on('click', '#closeTransactionModal', function() {
    $('#viewTransactionModal').toggle();
})

// Transaction Modal
$(document).on('click', '#viewTransaction', function(){
    $('.loader').show()
    $('#viewTransactionModal').toggle();
    let transactionId = $(this).data('id')
    
    var csrfToken = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        url: `/dashboard/transaction/view/`,
        method: 'GET',
        data: {
            transactionId:transactionId,
            _token:csrfToken
        },
        dataType: 'json',
        success: function(data){

            // Loader Hide
            $('.loader').hide()

            if(data.status) {
                let dataArray = JSON.parse(data.message)

                let transactionType = dataArray.transaction.transaction_type
                let transactionRef = dataArray.transaction.reference
                let mobileNumber = dataArray.transaction.transaction_no
                let networkProvider = dataArray.transaction.network_id
                let transactionDate = dataArray.transaction.created_at
                let transactionAmount = dataArray.transaction.transaction_paid
                
                if(transactionType == 'Data'){
                    transactionStatus = dataArray.Status
                }else{
                    transactionStatus = 'Successful'
                }

                if(networkProvider == 1){
                    networkProvider = 'MTN'
                }else if(networkProvider == 2){
                    networkProvider = 'GLO'
                }else if(networkProvider == 3){
                    networkProvider = '9Mobile'
                }else if(networkProvider == 4){
                    networkProvider = 'Airtel'
                }else if(networkProvider == 5){
                    networkProvider = 'Smile'
                }else{
                    networkProvider = 'Wallet Top-up'
                }

                $('#transactionType').html(`<b>${ transactionType }</b>`)
                $('#transactionRef').html(`<b>${ transactionRef }</b>`)
                $('#mobileNumber').html(`<b>${ mobileNumber }</b>`)
                $('#networkProvider').html(`<b>${ networkProvider }</b>`)
                $('#transactionAmount').html(`<b>₦${ transactionAmount }</b>`)
                $('#transactionDate').html(`<b>${ new Date(transactionDate).toUTCString() }</b>`)
                $('#transactionStatus').html(`<b>${ transactionStatus }</b>`)

            }
        }
    })
})