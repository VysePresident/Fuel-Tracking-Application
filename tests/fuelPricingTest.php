<?php
    use PHPUnit\Framework\TestCase;

    include_once('fuelPricing.php');

    class FuelPricingTest extends TestCase {
        /**
         * @covers Price::calculate_num_trucks
         */
        public function testCalculateNumTrucks() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(3, $price->calculate_num_trucks());
        }
        /**
         * @covers Price::calculate_shipping_costs
         */
        public function testCalculateShippingCosts() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(30.0, $price->calculate_shipping_costs());
        }
        /**
         * @covers Price::calculate_material_cost
         */
        public function testCalculateMaterialCost() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(7500.0, $price->calculate_material_cost());
        }
        /**
         * @covers Price::calculate_landed_cost
         */
        public function testCalculateLandedCost() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(7530.0, $price->calculate_landed_cost());
        }
        /**
         * @covers Price::calculate_total_sale_price
         */
        public function testCalculateTotalSalePrice() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(10830.0, $price->calculate_total_sale_price());
        }
        /**
         * @covers Price::calculate_profit_percentage
         */
        public function testCalculateProfitPercentage() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(0.43956043956044, $price->calculate_profit_percentage(), '', 0.0001);
        }
    }
?>
