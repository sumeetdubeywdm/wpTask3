jQuery(document).ready(function ($) {
  $("#my-subscription-form").on("submit", function (e) {
    e.preventDefault();
    var email = $('input[name="email"]').val();

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert("Invalid email address.");
      $('#my-subscription-form input[name="email"]').val(""); // Clear the email input
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
        $('#my-subscription-form button[type="submit"]').prop("disabled", true)
          .addClass("disabled");
      },
      success: function (response) {
        if (response.success) {
          alert("You have been subscribed successfully.");
          $('#my-subscription-form input[name="email"]').val(""); // Clear the email input field
        } else {
          alert("An error occurred while sending the email.");
          $('#my-subscription-form input[name="email"]').val("");
        }
      },
      error: function () {
        alert("An error occurred while sending the email.");
        $('#my-subscription-form input[name="email"]').val("");
      },
      complete: function () {
        // Re-enable the button after the AJAX request is complete (success or error)
        $('#my-subscription-form button[type="submit"]')
          .prop("disabled", false)
          .removeClass("disabled");
      },
    });
  });
});
