<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>processing...</title>

    <script src="components/orderSummary.js" defer></script>

    
    <header>
        <nav id="nav-bar">
          <?php include_once 'components/nav-bar.php'; ?>
          <!--<object type="text/html" data="components/nav-bar.php"></object>-->
        </nav>
      </header>
</head>
<?php
    ini_set("display_errors", "1");
    ini_set("display_startup_errors", "1");
    error_reporting(E_ALL);
    require_once("../server/connection.php");
    function my_php_function($con) {
        // Perform some PHP operations
        $query = "INSERT INTO FuelQuote (email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status) VALUES ('bob1@gmail.com', 5, 'Diesel', '1111-11-11', 5, 'Debit', 34.34, 43.43, 'Transit');";
        mysqli_query($con, $query);
    }

    my_php_function($con);

    header("Location: ../orderConfirmation.php"); // redirect to orderConfirmation.php
    exit(); // make sure no more code is executed after the header() function
?>