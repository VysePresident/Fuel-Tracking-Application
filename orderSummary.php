<?php 
    include_once 'components/nav-bar.php'; 
    require_once __DIR__ . '/server/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/orderSummary.css">

    <title>Order Summary</title>

    <script src="components/nav-bar.js" defer></script>
    <script src="components/footer.js" defer></script>
    <script src="components/orderSummary.js" defer></script>

    
</head>

<body>
    <form class="orderSummary" action="newRow.php" method="POST">
    <div class="nav-bar" id="nav-bar">
        <?php //include_once 'components/nav-bar.php'; 
            include("server/connection.php");
            ini_set("display_errors", "1");
            ini_set("display_startup_errors", "1");
            error_reporting(E_ALL);
            $client = $_SESSION['client'];

            // Fuel Pricing Module
            include 'src/fuelPricing.php';

            $client = $_SESSION['client'];
            $email = $client->getEmail();
            $query = "SELECT * FROM clientinformation WHERE email = \"".$email."\";";

            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            $company_name = $row['companyName'];
            $state = $row['companyState'];
            $truck = new Truck(80,50,60);
            $city = $row['companyCity'];
            $street = $row['companyStreet'];

            $query2 = "SELECT * FROM states WHERE stateName = '".$state."';";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_assoc($result2);

            $companyState = new State($row['companyState'], floatval($row2['avgShippingCost']));

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Get the values submitted in the form
                $fuelType = $_POST["fuelType"];
                $gallonsRequested = $_POST["gallonsRequested"];
                $deliveryDate = $_POST["deliveryDate"];
                $paymentType = $_POST["paymentType"];

                // Access fuelType
                $query3 = "SELECT * FROM fueltype WHERE fueltype = '".$fuelType."';";
                $result3 = mysqli_query($con, $query3);
                $row3 = mysqli_fetch_assoc($result3);

                $fuel = new FuelType($fuelType, floatval($row3['baseCost']), 0.1);

                // Calculate pricing
                
                /*$priceCalc = new Price($fuel,$companyState,$truck,$gallonsRequested);
                $pricePerGallon = $fuel->get_price_per_gallon();
                $totalPrice = $priceCalc->calculate_total_sale_price();
                $numTrucksUsed = $priceCalc->calculate_num_trucks();
                $status = "Transit";
                $expectedProfits = $priceCalc->calculate_profit_percentage();

                $sendQuery = "INSERT INTO FuelQuote (email, gallonsPurchased, fueltype, dateOfPurchase, numTrucksUsed, paymentType, totalBill, expectedProfits, status) VALUES ('".$email."', ".$gallonsRequested.", '".$fuelType."', '".$deliveryDate."', ".$numTrucksUsed.", '".$paymentType."', ".$totalPrice.", ".$expectedProfits.", 'Transit');";
                $result = mysqli_query($con, $sendQuery);*/


                // Constants

                require_once __DIR__ . "/orderSummaryPricing.php";
                $_SESSION['gallonsPurchased'] = $gallonsRequested;
                $_SESSION['fuelType'] = $fuelType;
                $_SESSION['date'] = $deliveryDate;

                $trucks = 1;
                $_SESSION['trucks'] = $trucks;
                $_SESSION['paymentType'] = $paymentType;
                $_SESSION['total'] = $totalAmountDue;
                $_SESSION['profit'] = $margin;
            }
    ?>
        <!--<object type="text/html" data="components/nav-bar.php"></object> -->
    </div>
        <section name="summarySection">
            <h1><u>ORDER SUMMARY</u></h1>
            <p>Confirm your order:</p>
                <?php echo "<p>Ship to $company_name at: $street $city, $state</p>" ?>
                <?php echo "<p>$gallonsRequested gallons of $fuelType</p>" ?>
                <?php echo "<p>Deliver By: $deliveryDate</p>" ?>
        </section>
            <div class="priceEstimate" name="priceEstimate", id="priceEstimate">
                <ul class="priceEstimate">
                    <li class="priceEstimate"><?php echo "<p>Price/Gallon: $suggestedPricePerGallon</p>" ?></li> <!--$pricePerGallon-->
                    <li class="priceEstimate"><?php echo "<p>Total Price: $totalAmountDue</p>" ?></li> <!--$totalPrice-->
                </ul>
            </div>
        </section>
        <section class="buttons">
            <!--<input type="hidden" name="send_query" value=<?php //echo "'".$sendQuery."'"?>>-->
            <input type="submit" value="Confirm" class="confirmButton" id="confirmButton" onclick="confirmOrder()">
            <input type="submit" formaction="index.php" value="Cancel" class="cancelButton" id="cancelButton" onclick="goHome()">
        </section>
    </form>
</body>

<footer>
    <section>
        <div class="footer" id="footer"></div>
    </section>
</footer>
</html>