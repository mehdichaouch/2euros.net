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
  <title>2euros.net | Collection</title>
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

<h2>Collection</h2>
<p>This is your collection </p>
<table class="table table-hover table-striped">
    <thead>
      <tr>
        <th><span class="glyphicon glyphicon-calendar"></span></th>
        <th><span class="glyphicon glyphicon-picture"></span></th>
        <th><span class="glyphicon glyphicon-globe"></span></th>
        <th><span class="glyphicon glyphicon-stats"></th>
        <th><span class="glyphicon glyphicon-education"></th>
        <th><span class="glyphicon glyphicon-star"></th>
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

    $username = $_SESSION["username"];

    $sql = "SELECT Users.login, Collections.id_coins, Coins.pic_url, Coins.year, Coins.country, Coins.coinage, Coins.event,  Collections.coin_state
        FROM Users, Collections, Coins
        WHERE Collections.id_users = Users.id
        AND Collections.id_coins = Coins.id AND Users.login like '$username'
        ORDER BY Coins.year, Coins.country, Coins.event";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<tr style=height:50px; vertical-align:middle;>";
            echo "<td>" . $row["year"]. "</td>";
            echo "<td><img src=resources/coins/" . $row["pic_url"]. " width=50 height=50 class=img-circle></a><br></td>";
            echo "<td>" . $row["country"]. "</td>";
            echo "<td>" . $row["coinage"]. "</td>";
            echo "<td>" . $row["event"]. "</td>";
            echo "<td>" . $row["coin_state"]. "</td>";
            echo "</tr>";
        }

    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();

    ?>

    </tbody>
</table>
</div>

</body>

</html>
