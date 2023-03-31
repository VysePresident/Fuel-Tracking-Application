<!DOCTYPE html>
<html>
    <head>
        <title>Order History</title>
        <!--Linking the page that allows one to put restrictions on the email input fields-->
        <script src="email.validation.js"></script>
        <!--Linking the page that allows one to put restrictions on the password input fields-->
        <script src="password.validation.js"></script>
        <!--This is section of the code is primarily for the top of the page. 
        For ex the image, the nav bar, and the links.-->
        <meta charset = "UTF-8" />
        <meta name = "viewport" content  = "width=device-width, initial-scale = 1.0" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel = "stylesheet" href = "Customer_history_page.css">
      <header>
        <a href="./index.html"><img src="logo.png"></a>
        <link rel="stylesheet" href="nav-bar.css">
        <nav>
            <i class="fa fa-bars" onclick="showMenu()"></i >
            <div class="nav-links" id="navLinks">
              <i class="fa fa-times" onclick="hideMenu()"></i>
              <ul>
                <li><a href="contact.html">CONTACT US</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="register.html">REGISTER</a></li>
                <li><a href="Login_Page.html">SIGN IN</a></li>
                <li><a></a></li>
              </ul>
            </div>
        </nav>
    </header>
    </head>
  <?php
    $email = "tom@example.com";
  ?>
    <table id="orderHistoryTable">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Delivery Date</th>
          <th>Gallons requested</th>
          <th>Total amount Due</th>

        </tr>
      </thead>
      <tbody>
        <?php
          ini_set("display_errors", "1");
          ini_set("display_startup_errors", "1");
          error_reporting(E_ALL);
          include("src/connection.php");

          
          $query = "SELECT * FROM FuelQuote WHERE email = \"".$email."\";";
          $result = mysqli_query($con, $query);
          $num_rows = mysqli_num_rows($result);

          for ($i = 0; $i < $num_rows; $i++) {
            $row = mysqli_fetch_assoc($result);

            echo "<tr>
            <td>".$row['orderID']."</td>
            <td>".$row['dateOfPurchase']."</td>
            <td>".$row['dateOfPurchase']."</td>
            <td>".$row['gallonsPurchased']."</td>
            <td>".$row['totalBill']."</td>
  
            </tr>";
          }
        ?>
      </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#orderHistoryTable').DataTable({
          "order": [[2, "asc"]]
        });
      });

    </script>
    <footer>
		<!--This is where the footer of the page will be-->
		<section>
			<div class="footer" id="footer"></div>
		</section>
		<link rel="stylesheet" href="footer.css">
		<div class="footer" id="footer"></div>
		<script src="nav-bar.js"></script>
		<script src="footer.js"></script>
    </footer>
  </body>
</html>
