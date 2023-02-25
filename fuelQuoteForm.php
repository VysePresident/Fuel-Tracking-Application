<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/fuelQuoteForm.css">
    
    <title>Fuel Quote Form</title>

    <script src="components/nav-bar.js" defer></script>
    <script src="components/footer.js" defer></script>
</head>

<?php
// Dummy values to stand in for user profile information, as we are not yet intended
// to work on the backend.

$company_name = "dummyCorp";
$state = "Confusion";
$city = "dummyCity";
$street = "12345 dummyStreet Dr";

?>

<body>
    <!--Add link for action to Order Summary Page-->
    <section>
        <form class="formTable" action="orderSummary.php" method="POST">
            <div class="nav-bar" id="nav-bar"></div>
            <section>
                <h1><u>Fuel Order Form</u></h1>
                <p>Proud to serve businesses across the country for <br>
                    over 50 years</p>

                <h2>Ship To:</h2>
                <p class="formRow">
                    <?php echo "<p class='formCell'><u>Company Name</u>: </p>" ?>
                    <?php echo "<p class='formCell'>$company_name </p>" ?>
                </p>
                <p class="formRow">
                    <?php echo "<p class='formCell'><u>State</u>: </p>" ?>
                    <?php echo "<p class='formCell'> $state </p>" ?>
                </p>
                <p class="formRow">
                    <?php echo "<p class='formCell'><u>City</u>: </p>" ?>
                    <?php echo "<p class='formCell'> $city </p>" ?>
                </p>
                <p class="formRow">
                    <?php echo "<p class='formCell'><u>Street Address</u>: </p>" ?>
                    <?php echo "<p class='formCell'>$street </p>" ?>
                </p>
            </section>
            <section>
                <h2 class="formHeader">Order Details:</h2>
                <p class="formRow">
                    <label for="fuelType" class="formCell">Fuel Type:</label>
                    <select class="formCell" name="fuelType" id="fuelType" required>
                        <option value="" disabled selected>Select Fuel Type</option>
                        <option value="unleaded">Unleaded</option>
                        <option value="leaded">Leaded</option>
                        <option value="diesel">Diesel</option>
                    </select>
                </p>
                <p class="formRow">
                    <label for="gallonsRequested" class="formCell">Gallons of Fuel:</label>
                    <input class="formCell" type="number" name="gallonsRequested" id="gallonsRequested" required>
                </p>
                <p class="formRow">
                    <label class="formCell" for="deliveryDate">Deliver By:</label>
                    <input class="formCell" type="date" name="deliveryDate" id="deliveryDate" required>
                </p>
                <p class="formRow">
                    <p class="formCell">Price per Gallon: </p>
                    <p class="formCell">[WIP: pricing module not required]</p>
                </p>
                <p class="formRow">
                    <p class="formCell">Total Price: </p>
                    <p class="formCell">[WIP: pricing module not required]</p>
                </p>

            </section>
            <section>
                <p class="formRow">
                    <div class="paymentType">
                        <label class="formCell">Payment Type: </label>
                        <div class="formCell">
                            <label for="cash">Cash</label>
                            <input type="radio" name="paymentType" id="cash" value="cash">
                            
                            <label for="credit">Credit</label>
                            <input type="radio" name="paymentType" id="credit" value="credit">

                            <label for="debit">Debit</label>
                            <input type="radio" name="paymentType" id="debit" value="debit">
                        </div> 
                    </div>
                </p>
            <section>
                <input type="submit" value="Submit" class="submitButton" id="submitButton">
            </section>
        </form>
    </section>
</body>
<footer>
    <div id="footerWrapper">
        <div class="footer" id="footer"></div>
    </div>
</footer>

</html>