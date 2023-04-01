
<?php
  require_once dirname(__DIR__) . '/src/client.php';
  //require_once '../src/client.php';
  session_start();
?>

<link rel="stylesheet" href="./styles/nav-bar.css">
  <header>
    <a href="./index.php"><img src="img/logo.png"></a>
    <nav>
      <i class="fa fa-bars" onclick="showMenu()"></i>
      <div class="nav-links" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()"></i>
        <ul>
          <li><a href="../contact.php">CONTACT US</a></li>
          <li><a href="../about.php">ABOUT</a></li>
          <?php 
            if(isset($_SESSION['client']))
            {
              echo '<li><a href="../editUserProfile.php">PROFILE</a></li>';
              echo '<li><a href="/server/logout.php">LOGOUT</a></li>';
              echo "HI " . $_SESSION['client']->getEmail() . "!";
            }
            else
            {
              echo '<li><a href="../registration.html">REGISTER</a></li>';
              echo '<li><a href="../Login_Page.php">SIGN IN</a></li>';
            }

          ?>
          <?php
            //$X = 3;
            //echo '<li><a href="../Login_Page.html">' . $X . '</a></li>';
          ?>
        </ul>
      </div>
    </nav>
  </header>