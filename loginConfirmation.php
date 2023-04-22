<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    
    <!--<link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/orderConfirmation.css">-->

    <title>LOGIN PROCESSING</title>

    <script src="components/loginConfirmation.js"></script>
    <?php
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);
        require_once 'server/loginStart.php';
    ?>
  </head>
  <body>
      <header>
        <!--<nav id="nav-bar">
          <object type="text/html" data="components/nav-bar.php"></object> 
        </nav>-->
      </header>
      <section id="page">
        <section id="confirmation-message">
          <h1 id="confirmhead">LOGIN PROCESSING</h1>
          <p class="confirmtext">You will be redirected to the index page shortly</p>
        </section>
    </section>
      
      <!--<div class="footer" id="footer"></div>-->
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
