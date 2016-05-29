<!-- SESSION -->
<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
?>

<!-- HEADER -->
<html lang="en">
  <head>
    <title>2euros.net | Progress</title>
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
  <div class="btn-group btn-group-justified">
    <a href="#" class="btn btn-primary">By Year</a>
    <a href="#" class="btn btn-primary">By Countries</a>
    <a href="#" class="btn btn-primary">All</a>
  </div>


  <!-- 
  <div class="container">
    <h2>Progress</h2>
    <p>Track your progress here (results may vary due to DB modifications overtime)</p>   

    <div class="progress">
      <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
        60% Complete
      </div>
    </div>

  </div>
  -->

  </body>
</html>
