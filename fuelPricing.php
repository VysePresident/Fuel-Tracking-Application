<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/orderSummary.css">

    <script src="components/nav-bar.js" defer></script>
    <script src="components/footer.js" defer></script>
    <script src="components/orderSummary.js" defer></script>

    <?php
        include 'fuelType.php';
        include 'state.php';
        include 'trucks.php';
        
        // PRICE = 
        class Price {
            // Properties
            private $state;
            private $truck;
            private $fuel_type;
            private $num_gallons;

            // Constructor
            public function __construct(FuelType $fueltype, State $state, Truck $truck) {
                $this->fuel_type = $fueltype;
                $this->state = $state;
                $this->truck = $truck;
            }

            // Methods
            public function calculate_num_trucks() {
                return ceil($this->num_gallons / $this->truck->getCapacity());
            }

            public function calculate_shipping_costs()
            {
                return ($this->calculate_num_trucks() * $this->state->getCost());
            }

            public function calculate_material_cost() {
                // Cost per gallon * Num of gallons
                return($this->fuel_type->base_cost_per_gallon * $this->num_gallons);
            }

            public function calculate_landed_cost()
            {
                return($this->calculate_shipping_costs() + $this->calculate_material_cost());
            }

            public function calculate_total_sale_price() {
                $shipping_cost = $this->calculate_shipping_costs();
                $gas_price = $this->fuel_type->price_per_gallon * $this->num_gallons;
                $total_price = $gas_price + $shipping_cost;
                
                return $total_price;
            }

            public function calculate_profit_percentage() {
                $sale_price = $this->calculate_total_sale_price();
                $landed_cost = $this->calculate_landed_cost();
                $profit_percentage = ($sale_price - $landed_cost ) / $landed_cost;

                return($profit_percentage);
            }
        }
    ?>
</head>
</html>