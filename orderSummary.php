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
    <form class="orderSummary" action="orderConfirmation.php">
    <div class="nav-bar" id="nav-bar">
        <?php include_once 'components/nav-bar.php'; 
        
        ?>
        <?php
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

        // Fuel Pricing Module
        include 'src/fuelPricing.php';

        // Dummy variables to fill in for future backend requirements:
        $companyName = $_SESSION['companyName'];
        $state = new State($_SESSION['companyState'],15.00);
        $statename = $_SESSION['companyState'];
        $truck = new Truck(80,50,60);
        $city = $_SESSION['companyCity'];
        $street = $_SESSION['companyStreet'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Get the values submitted in the form
            $fuelType = $_POST["fuelType"];
            $gallonsRequested = $_POST["gallonsRequested"];
            $deliveryDate = $_POST["deliveryDate"];
            $paymentType = $_POST["paymentType"];

            // Decide base price based on choice
            if ($fuelType == "unleaded") {
                $fuel = new FuelType("Unleaded", 2.99, 0.09);
            }
            else if ($fuelType == "leaded") {
                $fuel = new FuelType("Leaded", 3.49, 0.09);
            }
            else if ($fuelType == "diesel") {
                $fuel = new FuelType("Diesel", 3.99, 0.09);
            }
            else {
                // Assume unleaded by default if no value given
                $fuel = new FuelType("Unleaded", 2.99, 0.09);
            }

            // Calculate pricing
            $priceCalc = new Price($fuel,$state,$truck,$gallonsRequested);
            $pricePerGallon = $fuel->get_price_per_gallon();
            $totalPrice = $priceCalc->calculate_total_sale_price();
        }
    ?>







        <!--<object type="text/html" data="components/nav-bar.php"></object> -->
    </div>
        <section name="summarySection">
            <h1><u>ORDER SUMMARY</u></h1>
            <p>Confirm your order:</p>
                <?php echo "<p>Ship to $companyName at: $street $city, $statename</p>" ?>
                <?php echo "<p>$gallonsRequested gallons of $fuelType</p>" ?>
                <?php echo "<p>Deliver By: $deliveryDate</p>" ?>
        </section>
            <div class="priceEstimate" name="priceEstimate", id="priceEstimate">
                <ul class="priceEstimate">
                    <li class="priceEstimate"><?php echo "<p>Price/Gallon: $pricePerGallon</p>" ?></li>
                    <li class="priceEstimate"><?php echo "<p>Total Price: $totalPrice</p>" ?></li>
                </ul>
            </div>
        </section>
        <section class="buttons">
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