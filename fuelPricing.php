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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Variables
            $margin = 0.0;
            $calculateRate = 0.0;

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