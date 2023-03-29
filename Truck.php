<?php
require_once __DIR__ . '/vendor/autoload.php';

use Geocoder\Provider\OpenStreetMap;
use Geocoder\Query\GeocodeQuery;
use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\StatefulGeocoder;




class Trucking {
    public $db_name;
    private $geocoder;
    private $starting_location;

    
    public function __construct($starting_location) {
        $this->geocoder = new StatefulGeocoder(new OpenStreetMap(), null, new CurlHttpAdapter());
        $this->starting_location = $starting_location;
    }

    public function get_distance($destination_address) {
        $starting_location = $this->geocoder->geocodeQuery(GeocodeQuery::create($this->starting_location));
        $destination_location = $this->geocoder->geocodeQuery(GeocodeQuery::create($destination_address));

        if ($starting_location && $destination_location) {
            $starting_point = [$starting_location->getCoordinates()->getLatitude(), $starting_location->getCoordinates()->getLongitude()];
            $destination_point = [$destination_location->getCoordinates()->getLatitude(), $destination_location->getCoordinates()->getLongitude()];
            $distance_in_miles = $this->distance($starting_point, $destination_point, 'mi');
            return $distance_in_miles;
        } else {
            return null;
        }
    }

    public function calculate_final_cost($order, $fuel_quote) {
        // Constants
        $MAX_CAPACITY = 3000;
        //The gas price changes based on the selected fuel by the user
        $PRICES_PER_GALLON = [
            "Leaded" => 3.047,
            "Unleaded" => 3.760,
            "Diesel" => 3.793
        ];

        $MPG = 6.5;
        // Get the last order, fuel type, and quote from the order and fuel_quote instances
        $orders = $order->get_all_orders();
        $last_order = end($orders);
        $fuel_type = $last_order[1];
        $gallons = $last_order[2];
        $city_state = $fuel_quote->get_last_quote_location();
        $destination_address = $city_state[0] . ', ' . $city_state[1];

        if ($gallons <= 0) {
            return null;
        }

        $distance_in_miles = $this->get_distance($destination_address);

        if ($distance_in_miles === null) {
            return null;
        }

        $distance_cost = $distance_in_miles / $MPG;

        //Get the price per gallon for the selected fuel type
        $price_per_gallon = $PRICES_PER_GALLON[$fuel_type];

        // Calculate the number of trucks needed
        $num_trucks = ceil($gallons / $MAX_CAPACITY);
        $remaining_gallons = $gallons;

        // Calculate the final cost based on the number of trucks
        $final_cost = 0;
        for ($i = 0; $i < $num_trucks; $i++) {
            if ($remaining_gallons > $MAX_CAPACITY) {
                $gallons_on_truck = $MAX_CAPACITY;
            } else {
                $gallons_on_truck = $remaining_gallons;
            }

            $cost_for_truck = $gallons_on_truck * $price_per_gallon + $distance_cost;
            $final_cost += $cost_for_truck;
            $remaining_gallons -= $MAX_CAPACITY;
        }

        return $final_cost;
    }

    private function distance($from, $to, $unit) {
        $theta = $from[1] - $to[1];
        $dist = sin(deg2rad($from[0])) * sin(deg2rad($to[0])) +  cos(deg2rad($from[0])) * cos(deg2rad($to[0])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtolower($unit);
        if ($unit == "km") {
            return ($miles * 1.609344);
        } else if ($unit == "nmi") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}
?>