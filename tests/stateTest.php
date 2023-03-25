<?php
    declare(strict_types=1);
    
    use PHPUnit\Framework\TestCase;
    
    require_once 'state.php';
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
