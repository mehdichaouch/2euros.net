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
  <div class="container">
    <h2>Progress</h2>
    <p>Track your progress here (results may vary due to DB modifications overtime)</p> 
    
      <?php
      $username = $_SESSION["username"];

      //Database Credentials
      include 'conf/db.php';

      // Create & check connection
      $conn = new mysqli($serverip, $user, $pass, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Create connection
      mysql_connect($serverip, $user, $pass, $dbname);
      mysql_select_db('2euros');

      $sql = "SELECT DISTINCT year FROM Coins";
      $result = mysql_query($sql);

      while ($row = mysql_fetch_array($result)) {
        echo '<br>';    

        $sql_years = "SELECT COUNT(*) FROM Coins
        WHERE Coins.year = " . $row['year'] . "";
        $result_years = mysql_query($sql_years);
        $total_years = mysql_fetch_array($result_years);

        $username = $_SESSION["username"];
        $sql_user_years = "SELECT COUNT(*) FROM Users, Collections, Coins
        WHERE Collections.id_users = Users.id
        AND Collections.id_coins = Coins.id
        AND Users.login like '$username'
        AND Coins.year = " . $row['year'] . "";
        $result_user_years = mysql_query($sql_user_years);
        $total_user_years = mysql_fetch_array($result_user_years);

        $value_years = (int)$total_years[0];
        $percentage = 100/$value_years;
        $user_perc = round((int)$total_user_years[0]*$percentage);


        // #--HTML--#

        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading"><b>'. $row['year'] .'</b></div>';
        echo '<div class="panel-body">';
        echo '<div class="progress">';

        if ($user_perc >= 100) {
          echo '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="' . $user_perc . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $user_perc . '%">';
        } elseif ($user_perc <= 5) {
          echo '<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="' . $user_perc . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $user_perc . '%">';
        } else {
          echo '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="' . $user_perc . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $user_perc . '%">';
        }

        $money = round((int)$total_user_years[0]*2);

        echo '' . $user_perc . ' %';
        echo '</div>';
        echo '</div>';
        echo 'Total: <b>' . $money . '</b> euros';
        echo '</div>';
        echo '</div>';
        // #--HTML--#

      }

      // Close MySQL connection
      $conn->close();

      ?>
  
  </div>

  </body>
</html>
