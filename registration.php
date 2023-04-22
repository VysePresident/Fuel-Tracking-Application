<?php include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <?php
      ini_set("display_errors", "1");
      ini_set("display_startup_errors", "1");
      error_reporting(E_ALL);
      
    ?>

    <!--TEMPORARY TEST FEATURE FOR SESSION-->
    <?php
      /*require_once 'src/Client.php';
      require_once 'src/HCUser.php';
      require_once 'server/clientsList.php';
      require_once 'server/loginManager.php';
      $myLoginManager = new LoginManager('tom@example.com', 'password1');
      $myLoginManager->isLoginValid();
      header("Location: ")*/
    ?>

    <link rel="stylesheet" href="styles/registration.css">
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
      <div class="nav-bar" id="nav-bar">
        <?php //include_once 'components/nav-bar.php'; ?>
        <!--<object type="text/html" data="components/nav-bar.php"></object>-->
      </div>
      <div class="nav-bar" id="nav-bar"></div>
      <div class="registration" id="registration"></div>
      <div class="footer" id="footer"></div>
      <script src="components/registration.js"></script>
      <script src="components/states.js"></script>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
  </body>
</html>



<!-- 
<!DOCTYPE html>
<html>
  <head>
    <title>Profile Management</title>
    <link rel="stylesheet" href="styles/registration.css">
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
      <div class="nav-bar" id="nav-bar"></div>
      <div class="registration" id="registration"></div>
      <div class="footer" id="footer"></div>
      <script src="components/registration.js"></script>
      <script src="components/states.js"></script>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
  </body>
</html> -->