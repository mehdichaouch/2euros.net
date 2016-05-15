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
  <title>2euros.net | Manage</title>
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

    <h2>Manage</h2>
    <p>Add Coin</p>

    <form role="form" action="./manage.php">
      <?php
      echo '<pre>';
      var_dump($_GET);
      echo '</pre>';
      echo '<hr>';
      ?>

      <div class="form-group">

        <label for="sel1">Year</label>
        <select class="form-control" id="sel1" name="year">

          <!-- DROPDOWN 1 -->
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

          $selectedYear = $_GET['year'];
          while ($row = mysql_fetch_array($result)) {
            $selected = '';
            if ($row['year'] === $selectedYear) {
              $selected = ' selected';
            }

            //echo "<option value=\"$row['year']\" $selected>$row['year']</option>";
            echo '<option value="' . $row['year'] .'"'  . $selected . '>'. $row['year'] . '</option>';
          }

        // Close MySQL connection
          $conn->close();

          ?>

        </select>
        <br>

        <?php if ($_GET['year']) { ?>

          <label for="sel2">Country</label>
          <select class="form-control" id="sel2" name="country">

          <?php
          // Create & check connection
          $conn = new mysqli($serverip, $user, $pass, $dbname);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Create connection
          mysql_connect($serverip, $user, $pass, $dbname);
          mysql_select_db('2euros');
          $sql = "SELECT DISTINCT country FROM Coins WHERE year = $selectedYear ORDER by country;";
          $result = mysql_query($sql);

          echo '<option value="' . $row['year'] .'"'  . $selected . '>'. $row['year'] . '</option>';

          // Close MySQL connection
          $conn->close();

          ?>


          </select>
          <br>

          <label for="sel3">Event</label>
          <select class="form-control" id="sel3" name="event">
            <option>xxx</option>
          </select>
          <br>

          <label for="sel4">State</label>
          <select class="form-control" id="sel4" name="state">
            <option>MINT</option>
            <option>GOOD</option>
            <option>BAD</option>
          </select>
          <br>

          <?php } ?>

          <button type="submit" class="btn btn-default">Submit</button>

        </div>
      </form>

    </div>

  </body>

  </html>
