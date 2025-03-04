// Data MTN 
$(document).on('submit', '#purchaseDataMtn', function() {
    var e = this
    let container = $('#feedbackContainerMtn')

    // display Loader 
    $('.loader').show()

    $('#dataBuy').hide()

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
                setTimeout(function() {
                    window.location.href = '/dashboard/transactions/';
                }, 5000);                

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
    $('#gloDataBuy').hide()

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
    $('#airtelDataBuy').hide()

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
    $('#n9mobileDataBuy').hide()

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
    $('#airtimeBuy').hide()

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

// Search Meter Electricity
$(document).on('submit', '#searchMeterElectricity', function() {
    var e = this
    let searchMeterBtn = $('#searchMeterBtn')
    let meterName = $('#meterName')
    let meterNameBox = $('#meterNameBox')
    let container = $('#feedbackContainerElectricity')

    // display Loader 
    $('.loader').show()
    searchMeterBtn.hide()

    $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: "POST",
        dataType: 'json',
        success: function(data) {

            if(data.status === true) {
                // Loader Hide 
                $('.loader').hide()
                meterName.show()

                // Add Value to Meter Box 
                meterNameBox.val(data.message)

                // Show Amount Container 
                $('#electricityAmount').show()    

            }else{
                $(".alert").remove();
                
                // Loader Hide 
                $('.loader').hide()

                // Display Search Btn Back 
                searchMeterBtn.show()
                
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

                // Redirect 
                // setTimeout(function(){
                //     location.reload()
                // }, 5000)

            }
        
        }
    });

    return false;
})

// Purchase Electricity
$(document).on('submit', '#purchaseElectricity', function() {
    var e = this
    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    let container = $('#feedbackContainerElectricity')
    let discoName = $('#discoName').val()
    let meterNumber = $('#meterNumber').val()
    let tokenAmount = $('#tokenAmount').val()
    let custPin = $('#electricityCustPin').val()

    // display Loader 
    $('.loader').show()

    $('#electricityBuy').hide()

    $.ajax({
        url: $(this).attr('action'),
        data: {
            _token: csrfToken,
            discoName: discoName,
            meterNumber: meterNumber,
            tokenAmount: tokenAmount,
            custPin: custPin,
        },
        // data: $(this).serialize(),
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

// Close Transaction Modal 
$(document).on('click', '#closeTransactionModal', function() {
    $('#viewTransactionModal').toggle();
})

// Close Customer Modal 
$(document).on('click', '#closeCustomerModal', function() {
    $('#viewCustomerModal').toggle();
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

                if(transactionType == 'Deposit'){
                    transactionAmount = dataArray.transaction.transaction_amount
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

// Customer Modal
$(document).on('click', '#viewCustomer', function(){
    $('.loader').show()
    $('#viewCustomerModal').toggle();
    let custId = $(this).data('id')
    
    var csrfToken = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        url: `/dashboard/customer/view/`,
        method: 'GET',
        data: {
            custId:custId,
            _token:csrfToken
        },
        dataType: 'json',
        success: function(data){

            // Loader Hide
            $('.loader').hide()

            if(data.status) {
                let dataArray = JSON.parse(data.message)

                let customerName = dataArray.fullname
                let customerUsername = dataArray.username
                let customerNumber = dataArray.phone
                let customerEmail = dataArray.email
                let customerAccount = dataArray.acct_balance
                let customerDateJoined = dataArray.created_at
                let customerStatus = dataArray.cust_status
                
                if(customerStatus == 1){
                    customerStatus = 'Active'
                }else{
                    customerStatus = 'Not-Active'
                }

                $('#customerName').html(`<b>${ customerName }</b>`)
                $('#customerUsername').html(`<b>${ customerUsername }</b>`)
                $('#customerNumber').html(`<b>${ customerNumber }</b>`)
                $('#customerEmail').html(`<b>${ customerEmail }</b>`)
                $('#customerAccount').html(`<b>₦${ customerAccount }</b>`)
                $('#customerDateJoined').html(`<b>${ new Date(customerDateJoined).toUTCString() }</b>`)
                $('#customerStatus').html(`<b>${ customerStatus }</b>`)

            }
        }
    })
})

// fundWallet Modal 
$(document).on('click', '#closefundWalletModal', function() {
    $('#fundWalletContent').toggle();
})

// fundWallet Modal
$(document).on('click', '#fundWalletModal', function(){
    $('#fundWalletContent').toggle();

    // Getting Customer ID 
    let cust_id = $(this).data('id');
    $('#fundCustId').val(cust_id);
})

// Fund Wallet Submit
$(document).on('submit', '#fundWalletForm', function() {
    var e = this
    let container = $('#feedbackContainerFundWallet')

    // display Loader 
    $('.loader').show()
    $('#airtimeBuy').hide()

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