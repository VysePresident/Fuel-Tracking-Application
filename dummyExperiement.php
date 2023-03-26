<?php
require_once 'dummyFile.php';

// Create a new instance of the dummyFile class
$dummyFile = new dummyFile();

// Call the create_table function
$dummyFile->create_table();

// Call the add_quote function with input values
$dummyFile->add_quote('ABC Company', 'CA', 'Los Angeles', '123 Main St');

// Call the get_all_quotes function and print the output
$quotes = $dummyFile->get_all_quotes();
var_dump($quotes);

// Call the get_last_quote_location function and print the output
$last_quote_location = $dummyFile->get_last_quote_location();
var_dump($last_quote_location);

// Call the get_num_quotes function and print the output
$num_quotes = $dummyFile->get_num_quotes();
var_dump($num_quotes);

// Call the is_valid_state function with an input value
$is_valid_state = $dummyFile->is_valid_state('CA');
var_dump($is_valid_state);

// Call the is_valid_city function with an input value
$is_valid_city = $dummyFile->is_valid_city('Los Angeles');
var_dump($is_valid_city);

// Call the is_valid_address function with an input value
$is_valid_address = $dummyFile->is_valid_address('123 Main St');
var_dump($is_valid_address);

?>