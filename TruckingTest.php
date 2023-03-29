<?php

use PHPUnit\Framework\TestCase;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Model\Coordinates;
use Geocoder\Model\Address;

class TruckingTest extends TestCase
{
    protected $trucking;
    protected $mockGeocoder;

    protected function setUp(): void
    {
        $this->mockGeocoder = $this->createMock(\Geocoder\StatefulGeocoder::class);
        $this->trucking = new Trucking("123 Main St, Springfield, USA");
        $this->trucking->geocoder = $this->mockGeocoder;
    }

    public function testGetDistance()
    {
        $this->mockGeocoder
            ->method('geocodeQuery')
            ->willReturnOnConsecutiveCalls(
                new Address(null, null, null, null, null, new Coordinates(40.7128, -74.0060)),
                new Address(null, null, null, null, null, new Coordinates(34.0522, -118.2437))
            );

        $distance = $this->trucking->get_distance("Los Angeles, CA, USA");
        $this->assertEquals(2444.47, round($distance, 2));
    }

    public function testCalculateFinalCost(){
        //Create mock Order and FuelQuote instances
        $mockOrder = $this->createMock(Order::class);
        $mockFuelQuote = $this->createMock(FuelQuote::class);
        // Set up mock data for the order
$mockOrder->method('get_all_orders')
->willReturn([
    [1, "Diesel", 5000, "New York, NY, USA"]
]);

// Set up mock data for the fuel quote
$mockFuelQuote->method('get_last_quote_location')
->willReturn(["Los Angeles", "CA"]);

// Mock geocoder responses
$this->mockGeocoder
->method('geocodeQuery')
->willReturnOnConsecutiveCalls(
    new Address(null, null, null, null, null, new Coordinates(40.7128, -74.0060)),
    new Address(null, null, null, null, null, new Coordinates(34.0522, -118.2437))
);
    }
}
?>
