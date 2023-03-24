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
        include 'fuelType.php';
        include 'state.php';
        include 'trucks.php';
        
        // PRICE = 
        class Price {
            private $state;
            private $truck;
            private $fuel_type;
            private $num_gallons;

            // Constructor
            public function __construct($fueltype, $state, $truck) {
                $this->fuel_type = $fueltype;
                $this->state = $state;
                $this->truck = $truck;
            }

            // Functions (WIP)
            public function calculate_num_trucks() {
                return ceil($this->num_gallons / $this->truck.$this->carrying_capacity);
            }

            public function calculate_shipping_costs()
            {
                return (calculate_num_trucks() * getState().avg_shipping_cost_per_truck)
            }

            public function calculate_material_cost() {
                $material_cost = $this->fuel_type.$this->base_cost_per_gallon * $this->$num_gallons;
                return $material_cost;
            }

            +calculate_landed_cost()
            {
                 shipping_cost = calculate_shipping_costs()
                 material_cost = calculate_material_cost()
                 landed_cost = shipping_cost + material_cost
            
                return landed_cost 
            }
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