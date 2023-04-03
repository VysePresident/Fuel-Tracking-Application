<?php
    use PHPUnit\Framework\TestCase;

    include_once('src/fuelPricing.php');

    class FuelPricingTest extends TestCase {
        /**
         * @covers Price::calculate_num_trucks
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers State::__construct
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::getCapacity
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
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
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers Price::calculate_num_trucks
         * @covers State::__construct
         * @covers State::getCost
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::getCapacity
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
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
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers State::__construct
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
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
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers Price::calculate_material_cost
         * @covers Price::calculate_num_trucks
         * @covers Price::calculate_num_trucks
         * @covers Price::calculate_shipping_costs
         * @covers State::__construct
         * @covers State::getCost
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::getCapacity
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
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
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers Price::calculate_num_trucks
         * @covers Price::calculate_shipping_costs
         * @covers State::__construct
         * @covers State::getCost
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::getCapacity
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
         */
        public function testCalculateTotalSalePrice() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(8280.0 /*10830.0*/, $price->calculate_total_sale_price());
        }
        /**
         * @covers Price::calculate_profit_percentage
         * @covers FuelType::__construct
         * @covers FuelType::set_base_cost_per_gallon
         * @covers FuelType::set_fuel_type_name
         * @covers FuelType::set_price_per_gallon
         * @covers Price::__construct
         * @covers Price::calculate_landed_cost
         * @covers Price::calculate_material_cost
         * @covers Price::calculate_num_trucks
         * @covers Price::calculate_shipping_costs
         * @covers Price::calculate_total_sale_price
         * @covers State::__construct
         * @covers State::getCost
         * @covers State::setCost
         * @covers State::setName
         * @covers Truck::__construct
         * @covers Truck::getCapacity
         * @covers Truck::setAvailable
         * @covers Truck::setCapacity
         * @covers Truck::setTotal
         */
        public function testCalculateProfitPercentage() {
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);
            $state = new State('California', 10.0);
            $truck = new Truck(1000, 5, 10);
            $price = new Price($fuelType, $state, $truck, 3000);
            $this->assertEquals(0.099601593625498 /*0.43956043956044*/, $price->calculate_profit_percentage(), '', 0.0001);
        }
    }
?>
