<?php

use PHPUnit\Framework\TestCase;

class FuelQuoteTest extends TestCase
{
    private $fuelQuote;

    protected function setUp(): void
    {
        $this->fuelQuote = new FuelQuote('test.db');
    }

    protected function tearDown(): void
    {
        unset($this->fuelQuote);
        unlink('test.db');
    }

    /**
     * @covers FuelQuote::add_quote
     * @covers FuelQuote::get_num_quotes
     */
    public function testAddQuote(): void
    {
        $this->fuelQuote->add_quote('Test Company', 'TX', 'Austin', '123 Test St');
        $this->assertEquals(1, $this->fuelQuote->get_num_quotes());
    }

    /**
     * @covers FuelQuote::add_quote
     * @covers FuelQuote::get_all_quotes
     */
    public function testGetAllQuotes(): void
    {
        $this->fuelQuote->add_quote('Test Company', 'TX', 'Austin', '123 Test St');
        $this->fuelQuote->add_quote('Test Company 2', 'TX', 'Dallas', '456 Test St');
        $quotes = $this->fuelQuote->get_all_quotes();
        $this->assertCount(2, $quotes);
        $this->assertEquals('Test Company', $quotes[0]['company_name']);
        $this->assertEquals('TX', $quotes[0]['state']);
        $this->assertEquals('Austin', $quotes[0]['city']);
        $this->assertEquals('123 Test St', $quotes[0]['address']);
        $this->assertEquals('Test Company 2', $quotes[1]['company_name']);
        $this->assertEquals('TX', $quotes[1]['state']);
        $this->assertEquals('Dallas', $quotes[1]['city']);
        $this->assertEquals('456 Test St', $quotes[1]['address']);
    }

    /**
     * @covers FuelQuote::add_quote
     * @covers FuelQuote::get_last_quote_location
     */
    public function testGetLastQuoteLocation(): void
    {
        $this->fuelQuote->add_quote('Test Company', 'TX', 'Austin', '123 Test St');
        $this->fuelQuote->add_quote('Test Company 2', 'TX', 'Dallas', '456 Test St');
        $lastQuoteLocation = $this->fuelQuote->get_last_quote_location();
        $this->assertEquals('Dallas', $lastQuoteLocation['city']);
        $this->assertEquals('TX', $lastQuoteLocation['state']);
    }

    /**
     * @covers FuelQuote::is_valid_state
     */
    public function testIsValidState(): void
    {
        $this->assertTrue($this->fuelQuote->is_valid_state('TX'));
        $this->assertTrue($this->fuelQuote->is_valid_state('CA'));
        $this->assertFalse($this->fuelQuote->is_valid_state('TEXAS'));
        $this->assertFalse($this->fuelQuote->is_valid_state('texas'));
        $this->assertFalse($this->fuelQuote->is_valid_state('T'));
    }

    /**
     * @covers FuelQuote::is_valid_city
     */
    public function testIsValidCity(): void
    {
        $this->assertTrue($this->fuelQuote->is_valid_city('Austin'));
        $this->assertTrue($this->fuelQuote->is_valid_city('New York'));
        $this->assertTrue($this->fuelQuote->is_valid_city('San Francisco'));
        $this->assertFalse($this->fuelQuote->is_valid_city('Los Angeles, CA'));
        $this->assertFalse($this->fuelQuote->is_valid_city('1234 Main St'));
    }
       /**
     * @covers FuelQuote::is_valid_address
     */
    public function testIsValidAddress(): void
    {
        $this->assertTrue($this->fuelQuote->is_valid_address('123 Main St'));
        $this->assertTrue($this->fuelQuote->is_valid_address('456 Test Ave, Apt 2B'));
        $this->assertFalse($this->fuelQuote->is_valid_address('1234 Main St; Apt 3'));
        $this->assertFalse($this->fuelQuote->is_valid_address('1'));
    }
}
 