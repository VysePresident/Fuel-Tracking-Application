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
        <nav id="nav-bar">
          <?php //include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
        </nav>
      </header>
      <section id="page">
        <section id="confirmation-message">
          <h1 id="confirmhead">CAREER OPPORTUNITIES: </h1>
          <p class="confirmtext">
            Our sincerest apologies, but we are not currently hiring at this time.
          </p>
          <p class="confirmtext">Please check again soon!</p>
        </section>
    </section>
      
      <div class="footer" id="footer"></div>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
