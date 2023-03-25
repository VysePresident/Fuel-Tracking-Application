<?php
    declare(strict_types=1);
    namespace Tests\Unit;
    use FuelType;
    use PHPUnit\Framework\TestCase;

    require_once 'fuelType.php';
    /**
     * @covers FuelType
     */
    class FuelTypeTest extends TestCase {
        /** @test */
        public function testFuelType() {
            // create a FuelType instance
            $fuelType = new FuelType('Gasoline', 2.5, 0.1);

            // check the initial values
            $this->assertEquals('Gasoline', $fuelType->get_fuel_type_name());
            $this->assertEquals(2.5, $fuelType->get_base_cost_per_gallon());
            $this->assertEquals(2.75, $fuelType->get_price_per_gallon());
        }
    }
?>
