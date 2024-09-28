<?php //to show an session value using key ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome<?php $this->sesssion->userdata('entername'); ?></h1>
    <form action="<?php  echo base_url('index.php/Welcome/save');  ?>"  method="POST">
      <input type="text" name="username" placeholder="Enter Your Name" required>
      <input type="submit" value="Save">
    </form>
</body>
</html>