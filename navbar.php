<!-- NAVBAR -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="https://2euros.net">2euros.net</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="https://2euros.net">Home</a></li>
        <li><a href="https://2euros.net/browse.php">Browse</a></li>
          
        <?php
        if(isset($_SESSION['username'])) {
          echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Coins<span class="caret"></span></a>';
          echo '<ul class="dropdown-menu">';
          echo '<li><a href="https://2euros.net/collection.php">Collection</a></li>';
          echo '<li><a href="https://2euros.net/manage.php">Manage</a></li>';
          echo '</ul>';
          echo '</li>';
          echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Progress<span class="caret"></span></a>';
          echo '<ul class="dropdown-menu">';
          echo '<li><a href="https://2euros.net/progress.php">By Year</a></li>';
          echo '<li><a href="https://2euros.net/progress.php">By Country</a></li>';
          echo '</ul>';
          echo '</li>';
          }
        ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <?php
          if(isset($_SESSION['username'])) {
            echo '<li><a href="https://2euros.net/account.php"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION["username"] . '</a></li>';
            echo '<li><a href="https://2euros.net/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
          } else {
            echo '<li><a href="https://2euros.net/signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>';
            echo '<li><a href="https://2euros.net/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          }
        ?>
        
      </ul>
    </div>
  </div>
</nav>