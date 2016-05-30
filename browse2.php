<!-- SESSION -->
<?php 
  session_start(); 
?>

<!-- HEADER -->
<html lang="en">
<head>
  <title>2euros.net | Browse</title>
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
  <h2>Browse</h2>
  <br>
  
    <?php

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

      $year = $row['year'];
      $sql_all_coins = "SELECT * FROM Coins 
      WHERE Coins.year = '$year' 
      ORDER BY Coins.country, Coins.event";
      $result_all_coins = mysql_query($sql_all_coins);
      $all_coins = mysql_fetch_array($result_all_coins);

      // #--HTML--#
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading"><b>'. $row['year'] .'</b></div>';

      echo '<div class="panel-body">';

      echo '<table>';
      echo '<tr>';
      while ($row = mysql_fetch_array($result_all_coins)) {   
        echo '<td>' . $row['year'] . '</td>';
        echo '<td><img src=resources/coins/' . $row['pic_url'] . ' width=50 height=50 class=img-circle></a></td>';
        echo '<td>' . $row['country'] . '</td>';
        echo '<td>' . $row['coinage'] . '</td>';
        echo '<td>' . $row['event'] . '</td>';
      }
      echo "</tr>";
      echo '</table>';

      echo '</div>';

      echo '</div>';
      echo '<br>'; 
      // #--HTML--#

    }

    // Close MySQL connection
    $conn->close();

    ?>

</div>

</body>

</html>
