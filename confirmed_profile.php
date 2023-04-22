<?php include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>GAS CO.</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/confirmed.css">
    <script>
      setTimeout(function() {
        window.location.href = "index.php";
      }, 4000); // 4000 milliseconds = 4 seconds
    </script>
  </head>
  <body>
      <header>
        <nav id="nav-bar">
          <?php //include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
        </nav>
      </header>
      <body id="page">
        <section id="confirmation-message">
          <h1 id="confirmhead">PROFILE CHANGES SUCCESSFUL!</h1>
          <p id="confirmtext">You will now be redirected to the home page.</p>
        </section>
      </body>
      
      <div class="footer" id="footer"></div>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
