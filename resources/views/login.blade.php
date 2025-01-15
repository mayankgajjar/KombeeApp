<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .error {
        color: red;
        margin-top: 5px;
    }
  </style>
</head>
<body>
<div class="container mt-3">
  <h2>Login form</h2>
  <form id="loginForm" method="POST">
    <div id="ValidationMsg"></div>
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <button type="button" class="btn btn-primary" id="SubmitBtn" onclick="Login()">Submit</button>
  </form>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

<script>

  var siteUrl = "<?= getenv("APP_URL") ?>"
 
  $(document).ready(function () {

    // Apply validation rules
    $("#loginForm").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        pswd: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        email: {
          required: "Please enter your email address",
          email: "Please enter a valid email address"
        },
        pswd: {
          required: "Please enter your password",
          minlength: "Your password must be at least 6 characters long"
        }
      },
      submitHandler: function (form) {
        // Submit the form via AJAX or other means
        Login();
      }
    });
  });

  function Login() {
    
    $("#ValidationMsg").html(" ");

    if ($("#loginForm").valid()) {
      // Example AJAX call (replace with actual backend URL and logic)
      $.ajax({
        url: siteUrl + "api/login", // Replace with your backend URL
        method: "POST",
        data: $("#loginForm").serialize(),
        success: function (response) {
            if(!response.success){
                if(response.data.error){
                  var msg = response.data.error;
                } else {
                  var msg = response.data;
                }
                $("#ValidationMsg").html('<span class="error-message text-danger">' + msg + '</span>');
            } else {
                location.href = response.redirectUrl;
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

                // Clear existing errors
                $(".error-message").remove();

                // Display new errors
                if (errors.email) {
                    $("#ValidationMsg").html('<span class="error-message text-danger">' + errors.email.join(", ") + '</span>');
                }
                if (errors.password) {
                    $("#ValidationMsg").html('<span class="error-message text-danger">' + errors.password.join(", ") + '</span>');
                }
            } else {
                alert("An unexpected error occurred.");
            }
        },
      });
    }
  }
</script>
</body>
</html>
