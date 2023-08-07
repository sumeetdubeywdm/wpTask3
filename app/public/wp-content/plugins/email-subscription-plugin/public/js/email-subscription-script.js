jQuery(document).ready(function ($) {
  

    $("#email-subscription-form").on("submit", function (e) {
      e.preventDefault();
      var email = $('input[name="email"]').val();
      var spinner = '<div class="email-sub-plugin-spinner" role="status" style:"padding-left:20px"></div><span class="email-sub-text">Please wait...</span>';
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Invalid email address.");
        $('#email-subscription-form input[name="email"]').val(""); // Clear the email input
        return;
      }
  
      $.ajax({
        url: my_subscription_ajax_object.ajaxurl,
        method: "POST",
        data: {
          action: "my_subscription_ajax",
          email: email,
        },
        beforeSend: function () {
          // Disable the button before sending the AJAX request
          $('#email-subscription-form button[type="submit"]').prop("disabled", true)
            .addClass("disabled").html(spinner);
            
        },
        success: function (response) {
          if (response.success) {
            alert("You have been subscribed successfully.");
            $('#email-subscription-form input[name="email"]').val(""); // Clear the email input field
          } else {
            alert("An error occurred while sending the email.");
            $('#email-subscription-form input[name="email"]').val("");
          }
        },
        error: function () {
          alert("An error occurred while sending the email.");
          $('#email-subscription-form input[name="email"]').val("");
        },
        complete: function () {
          // Re-enable the button after the AJAX request is complete (success or error)
          $('#email-subscription-form button[type="submit"]')
            .prop("disabled", false)
            .removeClass("disabled").text("Subscribe Me");
        },
      });
    });
  });