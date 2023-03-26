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
        class FuelType {
            // Properties
            public $fuel_type_name;
            public $base_cost_per_gallon;
            public $price_per_gallon;
            private $rate;

            // Constructor
            public function __construct($name, float $cost, float $rate) {
                $this->set_fuel_type_name($name);
                $this->set_base_cost_per_gallon($cost);
                $this->rate = $rate;
                $this->set_price_per_gallon();
            }

            // Methods
            public function get_fuel_type_name() {
                return $this->fuel_type_name;
            }

            public function get_base_cost_per_gallon() {
                return $this->base_cost_per_gallon;
            }

            public function get_price_per_gallon() {
                return $this->price_per_gallon;
            }

            private function set_fuel_type_name($name) {
                $this->fuel_type_name = $name;
            }

            private function set_base_cost_per_gallon($cost) {
                $this->base_cost_per_gallon = $cost;
            }

            private function set_price_per_gallon() {
                $this->price_per_gallon = $this->base_cost_per_gallon + ($this->base_cost_per_gallon * $this->rate);
            }
        }
    ?>
</head>
</html>