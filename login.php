<!-- SESSION -->
<?php 
  session_start(); 
?>

<!-- HEADER -->
<html lang="en">
<head>
  <title>2euros.net | Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="touch-icon-iphone.png">
  <link rel="apple-touch-icon" href="touch-icon-iphone.png">
  <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
  <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
  <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
</head>

<body>

<!-- NAVBAR -->
<?php
  include 'navbar.php';
?>

<!-- CONTENT -->
<div class="container">
  <h2>Thanks for logging in !</h2>
  <form role="form" name="form1" method="post" action="checklogin.php">
    <div class="form-group">
      <label for="myusername">Login:</label>
      <input name="myusername" type="text" class="form-control" id="myusername" placeholder="Enter login">
    </div>
    <div class="form-group">
      <label for="mypassword">Password:</label>
      <input name="mypassword" type="password" class="form-control" id="mypassword" placeholder="Enter password">
    </div>
    <button type="submit" class="btn btn-default" name="Submit" value="Login">Submit</button>
  </form>
</div>

</body>

</html>
