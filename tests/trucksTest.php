<?php
    declare(strict_types=1);
    use PHPUnit\Framework\TestCase;

    require_once 'trucks.php';
    /**
     * @covers Truck
     */

    class TruckTest extends TestCase {
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
