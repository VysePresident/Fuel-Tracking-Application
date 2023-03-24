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

    <?php
        include 'fuelType.php';         // Component of fuelPricing.php
        include 'state.php';            // Component of fuelPricing.php
        include 'trucks.php';           // Component of fuelPricing.php
        include 'fuelPricing.php';      // The module for the pricing of fuel
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Dummy variables to fill in for future backend requirements:
            $companyName = "dummyCorp";
            $state = "Confusion";
            $city = "dummyCity";
            $street = "12345 dummyStreet Dr";

            // Dummy variables because Pricing module is not yet required:
            $pricePerGallon = "[WIP: Pricing Module Not Required]";
            $totalPrice = "[WIP: Pricing Module Not Required]";

            // Get the values submitted in the form
            $fuelType = $_POST["fuelType"];
            $gallonsRequested = $_POST["gallonsRequested"];
            $deliveryDate = $_POST["deliveryDate"];
            $paymentType = $_POST["paymentType"];

            // Dummy values for testing purposes:
            
            //$fuelType = "Diesel";
            //$gallonsRequested = 100;
            //$deliveryDate = "Test";
            //$paymentType = "Cash";
            
            /*echo "<p>Company name: $companyName</p>";
            echo "<p>Email: $state</p>";
            echo "<p>Email: $city</p>";
            echo "<p>Email: $street</p>";
            echo "<p>Email: $fuelType</p>";
            echo "<p>Email: $gallonsRequested</p>";
            echo "<p>Email: $fname</p>";
            echo "<p>Email: $lname</p>";
            echo "<p>Email: $custEmail</p>";
            echo "<p>Email: $phone</p>";
            echo "<p>Email: $paymentType</p>";*/
        }
    ?>
</head>

<body>
    <form class="orderSummary" action="orderConfirmation.html">
    <div class="nav-bar" id="nav-bar"></div>
        <section name="summarySection">
            <h1><u>ORDER SUMMARY</u></h1>
            <p>Confirm your order:</p>
                <?php echo "<p>Ship to $companyName at: $street $city, $state</p>" ?>
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
            <input type="submit" formaction="index.html" value="Cancel" class="cancelButton" id="cancelButton" onclick="goHome()">
        </section>
    </form>
</body>

<footer>
    <section>
        <div class="footer" id="footer"></div>
    </section>
</footer>
</html>