<?php include_once 'components/nav-bar.php'; ?>

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
      <?php
        //include_once 'components/nav-bar.php';
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);
      ?>
    </head>
  <?php
    $client = $_SESSION['client'];
    $email = $client->getEmail();
  ?>
    <table id="orderHistoryTable" style="padding-top: 20px;">
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

          include("server/connection.php");
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
    <!--This keeps the table below the nav bar-->
    <style>
      .dataTables_length {
        margin-top: 120px;
      }
      .dataTables_filter {
        margin-top: 120px;
      }
    </style>
    <script>
      $(document).ready(function() {
        $('#orderHistoryTable').DataTable({
          "order": [[2, "asc"]]
        });
      });

    </script>
</body>
<footer>
    <div id="footerWrapper">
      <div class="footer" id="footer"></div>
    </div>
</footer>
</html>
