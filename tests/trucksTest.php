<?php
    declare(strict_types=1);
    use PHPUnit\Framework\TestCase;

    // Contains the Truck class as the fuelPricing.php file also includes the trucks.php file.
    // Using 'src/trucks.php' causes an error, as it attempts to re-declare the Truck class.
    include_once('src/fuelPricing.php');
    /**
     * @covers Truck
     */

    class TrucksTest extends TestCase {
        /** @test */
        public function testTruck() {
            // create a Truck instance
            $truck = new Truck(5000, 5, 10);

            // check the initial values
            $this->assertEquals(5000, $truck->getCapacity());
            $this->assertEquals(5, $truck->getAvailable());
            $this->assertEquals(10, $truck->getTotal());
        }
    }
?>
