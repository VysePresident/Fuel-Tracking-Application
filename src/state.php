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
        class State {
            // Properties
            private $avg_ship_cost;
            private $name;

            // Constructor
            public function __construct($name, float $cost) {
                $this->setName($name);
                $this->setCost($cost);
            }

            // Methods
            public function setCost($avg_ship_cost) {
                $this->avg_ship_cost = $avg_ship_cost;
            }

            public function getCost() {
                return $this->avg_ship_cost;
            }

            public function setName($name) {
                $this->name = $name;
            }

            public function getName() {
                return $this->name;
            }
        }
    ?>
</head>
</html>