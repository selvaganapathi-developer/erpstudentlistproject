<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.min.css'); ?>">
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
    h2{
        text-align:center;
    }
    a{
        padding-left:30%;
        color:blue;
        text-decoration:none;
    }
    .alert{
        color:red;
    }
  </style>
</head>
<body>
  
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="login-form">
        <h2 class="mb-4">Login</h2>
          <?php if(isset($error_message)) { ?>
      <div id="error-message" class="alert alert-danger"><?php echo $error_message; ?></div>
      <?php } elseif(isset($no_account_message)) { ?>
      <div id="error-message" class="alert alert-danger"><?php echo $no_account_message; ?></div>
      <?php } ?>
        <form action="<?php echo base_url('index.php/userloginpage/login_user'); ?>" method="post">
          <div class="form-group">
            <label for="username">Email</label>
            <input type="text" class="form-control" title="Enter your username to login" id="email" name="email" required autofocus placeholder="Enter Your email address">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" title="Enter your correct password to login" name="password" required placeholder="Enter Your password">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
          <span><p>Don't have an account?<a title="Click to signup page" href="<?php echo base_url('index.php/userloginpage/'); ?>">Signup</a></p></span> 
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>


<script>
      // Check if the success message exists and hide it after 3 seconds
      if (document.getElementById('error-message')) {
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
    }
</script>
