<?php
    declare(strict_types=1);
    
    use PHPUnit\Framework\TestCase;

    // Contains the State class as the fuelPricing.php file also includes the state.php file.
    // Using 'src/state.php' causes an error, as it attempts to re-declare the State class.
    include_once('src/fuelPricing.php');
    /**
     * @covers State
     */
    class StateTest extends TestCase {
        /** @test */
        public function testState() {
            // create a State instance
            $state = new State('California', 20.0);
        
            // check the initial values
            $this->assertEquals('California', $state->getName());
            $this->assertEquals(20.0, $state->getCost());
        
            // update the average shipping cost
            $state->setCost(25.0);
            $this->assertEquals(25.0, $state->getCost());
        }
    }
?>
