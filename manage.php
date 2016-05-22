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
  <p>You can manage your coins collection on this page</p>

  <form role="form" action="./manage.php">
      
    <!-- DEBUG -->
    <!--
    <?php
      echo '<pre>';
      var_dump($_GET);
      echo '</pre>';
      echo '<hr>';
    ?>
    -->

    <div class="form-group">

      <!-- DROPDOWN 1 -->
      <label for="sel1">Year</label>
      <select class="form-control" id="sel1" name="year">
      
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
          echo '<option value="' . $row['year'] .'"'  . $selected . '>'. $row['year'] . '</option>';
        }

        // Close MySQL connection
        $conn->close();

      ?>

      </select>
      <br>

      <!-- DROPDOWN 2 -->
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
        $sql = "SELECT DISTINCT country FROM Coins WHERE year = '$selectedYear' ORDER by country;";
        $result = mysql_query($sql);

        $selectedCountry = $_GET['country'];
        while ($row = mysql_fetch_array($result)) {
          $selected = '';
          if ($row['country'] === $selectedCountry) {
            $selected = ' selected';
          }
          echo '<option value="' . $row['country'] .'"'  . $selected . '>'. $row['country'] . '</option>';
        }

        // Close MySQL connection
        $conn->close();

      ?>

      </select>
      <br>

      <!-- DROPDOWN 3 -->
      <?php if ($_GET['country']) { ?>
      <label for="sel3">Event</label>
      <select class="form-control" id="sel3" name="event">

      <?php

        // Create & check connection
        $conn = new mysqli($serverip, $user, $pass, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Create connection
        mysql_connect($serverip, $user, $pass, $dbname);
        mysql_select_db('2euros');
        $sql = "SELECT event FROM Coins WHERE year = '$selectedYear' AND country = '$selectedCountry' ORDER by event;";
        $result = mysql_query($sql);

        $selectedEvent = $_GET['event'];
        while ($row = mysql_fetch_array($result)) {
          $selected = '';
          if ($row['event'] === $selectedEvent) {
            $selected = ' selected';
          } 
          echo '<option value="' . $row['event'] .'"'  . $selected . '>'. $row['event'] . '</option>';
        }

        // Close MySQL connection
        $conn->close();

      ?>

      </select>
      <br>

      <!-- DROPDOWN 4 -->
      <?php if ($_GET['event']) { ?>

      <?php
        // Create & check connection
        $conn = new mysqli($serverip, $user, $pass, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Create connection
        mysql_connect($serverip, $user, $pass, $dbname);
        mysql_select_db('2euros');
        
        $sql = "SELECT pic_url
        FROM Coins 
        WHERE year = '$selectedYear' 
        AND country = '$selectedCountry' AND event = '$selectedEvent'
        ORDER BY pic_url;";

        $result = mysql_query($sql);

        echo '<label for="sel5">Preview</label><br>';

        while ($row = mysql_fetch_array($result)) {
          echo '<div class="panel panel-default">';
          echo '<div class="panel-body"><img src=resources/coins/' . $row['pic_url'] . ' width=50 height=50 class=img-circle></a><br></div>';
          echo '</div>';
        }

        // Close MySQL connection
        $conn->close();

        echo '<br>';
      ?>

      <label for="sel4">State</label>
      <select class="form-control" id="sel4" name="state">

        <?php
        // Create & check connection
        $conn = new mysqli($serverip, $user, $pass, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Create connection
        mysql_connect($serverip, $user, $pass, $dbname);
        mysql_select_db('2euros');
        $sql = "SELECT DISTINCT coin_state FROM Collections;";
        $result = mysql_query($sql);

        $selectedState = $_GET['state'];
        while ($row = mysql_fetch_array($result)) {
          $selected = '';
          if ($row['coin_state'] === $selectedState) {
            $selected = ' selected';
          } 

          echo '<option value="' . $row['coin_state'] .'"'  . $selected . '>'. $row['coin_state'] . '</option>';
        }

        // Close MySQL connection
        $conn->close();

        ?>

      </select>
      <br>

      <?php } ?>

      <?php } ?>

      <?php } ?>

      <?php
        if(isset($_GET['state'])) {
          echo '<a href="./manage.php" class="btn btn-default" role="button">Cancel</a> ';
          echo '<button type="submit" class="btn btn-default">Refresh</button> ';

          // verify if the coin is owned

          // Create & check connection
          $conn = new mysqli($serverip, $user, $pass, $dbname);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Create connection
          $username = $_SESSION["username"];
          mysql_connect($serverip, $user, $pass, $dbname);
          mysql_select_db('2euros');
          $sql = "SELECT COUNT(*) FROM Users, Collections, Coins
            WHERE Collections.id_users = Users.id
            AND Collections.id_coins = Coins.id AND Users.login like '$username'
            AND Coins.year = '$selectedYear'
            AND Coins.country = '$selectedCountry'
            AND Coins.event = '$selectedEvent'";

          $result = mysql_query($sql);
          $data = mysql_fetch_array($result);

          if ($data[0] === '0') {
            if(isset($_GET['validate'])){
              echo '<button type="submit" class="btn btn-success disabled" name="validate" value="true">Add</button> ';
            } else {
              echo '<button type="submit" class="btn btn-success" name="validate" value="true">Add</button> ';
            }
            echo '<br>';
          } else {
            
            if(isset($_GET['delete'])){
              echo '<button type="submit" class="btn btn-warning disabled" name="update" value="true">Update</button> ';
              echo '<button type="submit" class="btn btn-danger disabled" name="delete" value="true">Remove</button> ';
            } else {
              echo '<button type="submit" class="btn btn-warning" name="update" value="true">Update</button> ';
              echo '<button type="submit" class="btn btn-danger" name="delete" value="true">Remove</button> ';
            }
            echo '<br>';
          }

          // Close MySQL connection
          $conn->close();

        } else {
          echo '<button type="submit" class="btn btn-default">Next</button>'; 
        }


        //Actions
        if(isset($_GET['validate'])){

          // Create connection
          $username = $_SESSION["username"];
          mysql_connect($serverip, $user, $pass, $dbname);
          mysql_select_db('2euros');

          $sql = "SELECT Users.id FROM Users WHERE Users.login = '$username';";
          $result = mysql_query($sql);
          $username = mysql_fetch_array($result);
          $username_id = $username[0];

          $sql = "SELECT Coins.id FROM Coins 
          WHERE Coins.year = '$selectedYear'
          AND Coins.country = '$selectedCountry'
          AND Coins.event = '$selectedEvent';";
          $result = mysql_query($sql);
          $coin = mysql_fetch_array($result);
          $coin_id = $coin[0];

          // Create connection
          $conn = new mysqli($serverip, $user, $pass, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } 

          $sql = "INSERT INTO Collections (id, id_users, id_coins, coin_state)
          VALUES ('NULL', '$username_id', '$coin_id', '$selectedState');";

          if ($conn->query($sql) === TRUE) {
            echo '<br>';
            echo '<div class="alert alert-success fade in">';
            echo '<a href="./manage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>SUCCESS</strong>';
            echo '<br>';
            echo 'coin <strong>' . $selectedYear . ' - ' . $selectedCountry . ' - ' . $selectedEvent . '<strong>';
            echo '<br>';
            echo 'status <strong>ADDED</strong> to your collection';
            echo '</div>';
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $conn->close();

        }

        if(isset($_GET['update'])){

          // Create connection
          $username = $_SESSION["username"];
          mysql_connect($serverip, $user, $pass, $dbname);
          mysql_select_db('2euros');

          $sql = "SELECT Users.id FROM Users WHERE Users.login = '$username';";
          $result = mysql_query($sql);
          $coin_owner = mysql_fetch_array($result);
          $coin_owner_id = $coin_owner[0];

          $sql = "SELECT Coins.id FROM Coins 
          WHERE Coins.year = '$selectedYear'
          AND Coins.country = '$selectedCountry'
          AND Coins.event = '$selectedEvent';";
          $result = mysql_query($sql);
          $coin = mysql_fetch_array($result);
          $coin_id = $coin[0];

          $sql = "SELECT Collections.id FROM Users, Collections
          WHERE Collections.id_users = Users.id
          AND Collections.id_coins = '$coin_id'
          AND Users.login like '$username'";
          $result = mysql_query($sql);
          $collection = mysql_fetch_array($result);
          $collection_id = $collection[0];

          // Create connection
          $conn = new mysqli($serverip, $user, $pass, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } 

          $sql = "DELETE FROM Collections WHERE Collections.id='$collection_id'";

          $sql = "UPDATE Collections SET Collections.coin_state='$selectedState'
          WHERE Collections.id='$collection_id'";

          if ($conn->query($sql) === TRUE) {
            echo '<br>';
            echo '<div class="alert alert-success fade in">';
            echo '<a href="./manage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>SUCCESS</strong>';
            echo '<br>';
            echo 'coin <strong>' . $selectedYear . ' - ' . $selectedCountry . ' - ' . $selectedEvent . '</strong>';
            echo '<br>';
            echo 'status <strong>UPDATED</strong> to <strong>' . $selectedState . '</strong> within your collection';
            echo '</div>';
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $conn->close();

        }

        if(isset($_GET['delete'])){

          // Create connection
          $username = $_SESSION["username"];
          mysql_connect($serverip, $user, $pass, $dbname);
          mysql_select_db('2euros');

          $sql = "SELECT Users.id FROM Users WHERE Users.login = '$username';";
          $result = mysql_query($sql);
          $coin_owner = mysql_fetch_array($result);
          $coin_owner_id = $coin_owner[0];

          $sql = "SELECT Coins.id FROM Coins 
          WHERE Coins.year = '$selectedYear'
          AND Coins.country = '$selectedCountry'
          AND Coins.event = '$selectedEvent';";
          $result = mysql_query($sql);
          $coin = mysql_fetch_array($result);
          $coin_id = $coin[0];

          $sql = "SELECT Collections.id FROM Users, Collections
          WHERE Collections.id_users = Users.id
          AND Collections.id_coins = '$coin_id'
          AND Users.login like '$username'";
          $result = mysql_query($sql);
          $collection = mysql_fetch_array($result);
          $collection_id = $collection[0];

          // Create connection
          $conn = new mysqli($serverip, $user, $pass, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } 

          $sql = "DELETE FROM Collections WHERE Collections.id='$collection_id'";

          if ($conn->query($sql) === TRUE) {
            echo '<br>';
            echo '<div class="alert alert-success fade in">';
            echo '<a href="./manage.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>SUCCESS</strong>';
            echo '<br>';
            echo 'coin <strong>' . $selectedYear . ' - ' . $selectedCountry . ' - ' . $selectedEvent . '</strong>';
            echo '<br>';
            echo 'status <strong>REMOVED</strong> from your collection';
            echo '</div>';
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $conn->close();

        }

      ?>

    </div>
  
  </form>

  </div>

</body>

</html>
