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

  <div class="container">
  <h2>Browse</h2>
  <div class="panel panel-default">
    <div class="panel-heading">Browse</div>
    <div class="panel-body">

    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th><span class="glyphicon glyphicon-calendar"></span></th>
          <th><span class="glyphicon glyphicon-picture"></span></th>
          <th><span class="glyphicon glyphicon-globe"></span></th>
          <th><span class="glyphicon glyphicon-stats"></th>
          <th><span class="glyphicon glyphicon-education"></th>
        </tr>
      </thead>
      <tbody>

      <?php
      //Database Credentials
      include 'conf/db.php';
      // Create connection
      $conn = new mysqli($serverip, $user, $pass, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      // DB request
      $sql = "SELECT * FROM `Coins`
              ORDER BY Coins.year";
      $result = $conn->query($sql);
      // Results
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              //echo "<img src=" . $row["pic_url"]. " width=50 height=50></a> | " . $row["year"]. " | " . $row["country"]. " | " . $row["event"]. "<br>";
              echo "<tr>";
              echo "<td>" . $row["year"]. "</td>";
              echo "<td><img src=resources/coins/" . $row["pic_url"]. " width=50 height=50 class=img-circle></a></td>";
              echo "<td>" . $row["country"]. "</td>";
              echo "<td>" . $row["coinage"]. "</td>";
              echo "<td>" . $row["event"]. "</td>";
              echo "</tr>";
          }
      // No Results
      } else {
          echo "0 results";
      }
      // Close connection
      $conn->close();
      ?>

      </tbody>
    </table>

    </div>
  </div>
  </div>



</div>

</body>

</html>
