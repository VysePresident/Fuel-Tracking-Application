<?php
    include_once 'components/nav-bar.php';
    include("server/connection.php");
    ?>

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
    <script src="components/fuelQuoteForm.js" defer></script>
</head>

<body>
    <!--Add link for action to Order Summary Page-->
    <section>
        <form class="formTable" action="orderSummary.php" method="POST">
            <div class="nav-bar" id="nav-bar">
                <?php
                    //include_once 'components/nav-bar.php';
                    //include("server/connection.php");
                    ini_set("display_errors", "1");
                    ini_set("display_startup_errors", "1");
                    error_reporting(E_ALL);

                    if(isset($_SESSION['client']))
                    {
                        $client = $_SESSION['client'];
                        $email = $client->getEmail();
                        $query = "SELECT * FROM clientinformation WHERE email = \"".$email."\";";
                        
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($result);

                        $company_name = $row['companyName'];
                        $state = $row['companyState'];
                        $city = $row['companyCity'];
                        $street = $row['companyStreet'];
                    }
                    else
                    {
                        header("Location: Login_Page.php");
                        exit; // make sure to exit after the redirect
                        /*$email = "(None - please sign in)";
                        $company_name = "(None - please sign in)";
                        $state = "(None - please sign in)";
                        $city = "(None - please sign in)";
                        $street = "(None - please sign in)";*/
                    }
                ?> 
            </div>
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
                <p>
                    <label for="suggestedPrice">Price Per Gallon: </label>
                    <input class="formCell" type="text" name="suggestedPrice" id="suggestedPrice" readonly required>
                </p>
                <p>
                    <label for="totalAmount">Total Price: </label>
                    <input class="formCell" type="text" name="totalAmount" id="totalAmount" readonly required>
                </p>
            <section>
                <button type="button" id="getQuoteBtn" disabled="true">Get Quote</button>
            </section>
            <section>
                <input type="button" value="Submit" class="grayButton" id="grayButton">
                <input type="hidden" value="Submit" class="submitButton" id="submitButton">
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