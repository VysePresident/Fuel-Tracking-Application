<?php //include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/about.css">

    <title>ORDER SUCCESSFUL CONFIRMATION.</title>

    <!--<script src="components/orderConfirmation.js"></script>-->

  </head>
  <body>
      <header>
        <nav id="nav-bar">
          <?php include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
        </nav>
      </header>
      <section id="page">
        <section id="confirmation-message">
          <h1 id="confirmhead">ABOUT US: </h1>
          <p class="confirmtext">
            We offer a wide range of fuel products, including gasoline, diesel,
            and propane, to meet the needs of our customers. Our products are
            sourced from reputable suppliers and tested for quality and compliance
            with industry standards.
          </p>
          <p class="confirmtext">We are proud to have served the fueling needs of the country for 50 years now.</p>
        </section>
    </section>
      
      <div class="footer" id="footer"></div>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
