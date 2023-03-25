<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class FuelQuoteTest extends TestCase{
    protected $fuelQuote;
    protected $order;

    protected function setUp(): void
    {
        $this->fuelQuote = new FuelQuote();
        $this->order = new Order();
    }

    public function testAddQuote(){
        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $lastOrderId = $this->order->get_last_order_id();

        $initialQuoteCount = count($this->fuelQuote->get_all_quotes());

        $this->fuelQuote->add_quote($lastOrderId);

        $allQuotes = $this->fuelQuote->get_all_quotes();
        $newQuoteCount = count($allQuotes);

        $this->assertEquals($initialQuoteCount + 1, $newQuoteCount);
    }

    public function testGetLastQuoteLocation(){
        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $lastOrderId = $this->order->get_last_order_id();
        $this->fuelQuote->add_quote($lastOrderId);

        $lastQuoteLocation = $this->fuelQuote->get_last_quote_location();

        // Assuming your get_last_quote_location method returns an array with city and state.
        $this->assertIsArray($lastQuoteLocation);
        $this->assertCount(2, $lastQuoteLocation);
        $this->assertArrayHasKey('city', $lastQuoteLocation);
        $this->assertArrayHasKey('state', $lastQuoteLocation);
    }
    // Other test methods for the FuelQuote class...
}
