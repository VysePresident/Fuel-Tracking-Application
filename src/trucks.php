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
        class Truck {
            // Properties
            private $carrying_capacity;
            private $total_trucks;
            private $available_trucks;

            // Constructor
            public function __construct(int $capacity, int $available, int $total) {
                $this->setCapacity($capacity);
                $this->setAvailable($available);
                $this->setTotal($total);
            }

            // Methods
            public function setCapacity($num) {
                $this->carrying_capacity = $num;
            }

            public function getCapacity() {
                return $this->carrying_capacity;
            }

            public function setAvailable($num) {
                $this->available_trucks = $num;
            }

            public function getAvailable() {
                return $this->available_trucks;
            }

            public function setTotal($num) {
                $this->total_trucks = $num;
            }

            public function getTotal() {
                return $this->total_trucks;
            }
        }
        
    ?>
</head>
</html>