<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Process</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css'); ?>">
</head>

<style>
    body {
      background-color: #f8f9fa;
    }
    .login-form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      background-color: #ffffff;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }
    .error{
        color:red;
    }
    a{
        padding-left:20%;
        color:blue;
        text-decoration:none;
    }
  h2{
    text-align:center;
  }
  span{
    color:red;
  }
  p{
    color:#000;
  }
  
</style>
<body>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="login-form">
        <h2 class="mb-4">Sign Up</h2>
                <?php if(isset($success_message)) { ?>
            <div id="success-message" class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } elseif(isset($error_message)) { ?>
            <div id="error-message" class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>
        <form action="<?php echo base_url('index.php/userloginpage/save'); ?>" method="post" id="form_submit" autocomplete="off">
          <div class="form-group">
            <!-- username -->
            <label for="username">Username<span>*</span></label>
            <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="Enter Your Name">
          </div>
          <!-- email address  --> 
          <div class="form-group">
            <label for="email">Email Address<span>*</span></label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="yourmail@gmail.com">
            <div id="email-error" style="color:red;"></div>
    </div>
          <!-- password -->
          <div class="form-group">
            <label for="Password">Password<span>*</span></label>
            <input type="Password" class="form-control" name="password" id="pass" required placeholder="Enter Your Password">
          </div>
          <!-- confirm password -->
          <div class="form-group">
            <label for="cpassword">Confirm Password<span>*</span></label>
            <input type="Password" class="form-control" id="cpassword" name="cpassword" required placeholder="Enter Your Confirm Password">
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
          <div>
         <div id="save"></div>
          </div>
          <span><p>Already have an account?<a title="Click to login page" href="<?php echo base_url('index.php/crud_controller/backtoLogin'); ?>">Login Page</a></p></span>

        </form>

      </div>
    </div>
  </div>
</div>
</body>
</html>
<!--jquery -->
<script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
<!--jquery form validation-->
<script src="<?php echo base_url('assets/jqueryformvalidation.js')?>"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url('assets/bootstrap.min.js'); ?>"></script>
<script>
    // Check if the success message exists and hide it after 3 seconds
    if (document.getElementById('success-message')) {
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
    }

</script>

<script>
    $(document).ready(function(){
            $('#form_submit').validate({
                rules:{
                    username:{
                        required:true,
                    },
                    email:{
                        required:true,
                    },
                    password:{
                        required:true,
                    },
                    cpassword:{
                        required:true,
                        equalTo: '#pass',
                    },

                },
                messages:{
                    username:{
                        required:"Enter Your Name",
                    },
                    email:{
                        required:"Enter Your Email Id",
                    },
                    password:{
                        required:"Enter Your Password",
                    },
                    cpassword:{
                        required: "Enter Your Confirm Password",
                      
                    },
                },
            });
        });
        
</script>
<script>
   $(document).ready(function() {
        $('#email').blur(function() {
            var email = $(this).val();
            $.ajax({
                url: '<?php echo base_url('index.php/userloginpage/check_email_exists'); ?>',
                type: 'POST',
                data: { email: email },
                success: function(response) {
                    if (response == "false") {
                        $('#email-error').text('Email already exists');
                    } else {
                        $('#email-error').text('');
                    }
                }
            });
        });
    });
</script>
