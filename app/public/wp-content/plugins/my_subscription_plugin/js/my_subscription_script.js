jQuery(document).ready(function($) {
    $('#my-subscription-form').on('submit', function(e) {
        e.preventDefault();
        var email = $('input[name="email"]').val();

        
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            
            $('#subscription-message').text('Invalid email address.');
            $('#my-subscription-form input[name="email"]').val(''); // Clear the email input
            return;
        }

       
        $.ajax({
            url: my_subscription_ajax_object.ajaxurl,
            method: 'POST',
            data: {
                action: 'my_subscription_ajax',
                email: email
            },
            success: function(response) {
                if (response.success) {
                    
                    $('#subscription-message').text('You have been subscribed successfully.');
                    $('#my-subscription-form input[name="email"]').val(''); // Clear the email input field
                } else {
                   
                    $('#subscription-message').text('An error occurred while sending the email.');
                }
            },
            error: function() {
               
                $('#subscription-message').text('An error occurred while sending the email.');
            }
        });
    });
});
