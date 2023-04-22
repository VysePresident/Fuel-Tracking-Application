<?php include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>GAS CO.</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/contact-form.css">
  </head>
  <body>
      <div class="nav-bar" id="nav-bar">
      <?//php include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
      </div>
      <body id="page">
        <section id="contact-form">
          <h1 id="head">Contact Form</h1>
          <form>
            <br><label for="name">Full Name</label>
            <input type="text" id="name" name="name" required placeholder="First Last"><br>
            <label for="address">Email Address</label>
            <input type="email" id="address" name="address" required placeholder="myemail@emailsite.whatever"><br>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required placeholder="1-###-###-####"><br>
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" cols="40" required placeholder="insert text here"></textarea><br>
            
            <input type="submit" value="SUBMIT">
          </form>
        </section>
      </body>
      <div class="footer" id="footer"></div>
      <script src="components/nav-bar.js"></script>
      <script src="components/footer.js"></script>
      <script src="components/home.js"></script>
  </body>
</html>
