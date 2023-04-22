<?php include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/orderConfirmation.css">

    <title>ORDER SUCCESSFUL CONFIRMATION.</title>

    <script src="components/orderConfirmation.js"></script>

  </head>
  <body>
      <header>
        
      <div class="nav-bar" id="nav-bar">
      </div>
      
      <!--<nav id="nav-bar">-->
          <?php //include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
        <!--</nav>-->

      </header>
      <section id="page">
        <section id="confirmation-message">
          <h1 id="confirmhead">ORDER SUCCESSFULLY PLACED!</h1>
          <p class="confirmtext">Your shipment will be delivered shortly!</p>
          <p class="confirmtext">You will now be redirected to the home page.</p>
        </section>
    </section>
      
      <div class="footer" id="footer"></div>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
