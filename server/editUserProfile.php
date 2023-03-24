
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\User;

// Database credentials
$servername = "localhost";
$username = "root";
$password = "GasCo12345678";
$dbname = "gasco";
$port = 3307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = new User($conn);

$custEmail = $user->clean_input($_POST['custEmail']);
$password = $user->clean_input($_POST['password']);
$fname = $user->clean_input($_POST['fname']);
$mname = $user->clean_input($_POST['mname']);
$lname = $user->clean_input($_POST['lname']);
$phone = $user->clean_input($_POST['phone']);
$companyName = $user->clean_input($_POST['companyName']);
$state = $user->clean_input($_POST['state']);
$city = $user->clean_input($_POST['city']);
$street = $user->clean_input($_POST['street']);
$street2 = $user->clean_input($_POST['street2']);
$zipcode = $user->clean_input($_POST['zipcode']);



$validation_result = $user->validate_input([
    'custEmail' => $custEmail,
    'password' => $password,
    'fname' => $fname,
    'mname' => $mname,
    'lname' => $lname,
    'phone' => $phone,
    'companyName' => $companyName,
    'state' => $state,
    'city' => $city,
    'street' => $street,
    'street2' => $street2,
    'zipcode' => $zipcode
]);

if ($validation_result === true) {
    try {
        // Hash the password 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($user->editUserProfile([
            'custEmail' => $custEmail,
            'password' => $password,
            'fname' => $fname,
            'mname' => $mname,
            'lname' => $lname,
            'phone' => $phone,
            'companyName' => $companyName,
            'state' => $state,
            'city' => $city,
            'street' => $street,
            'street2' => $street2,
            'zipcode' => $zipcode
        ])) {
            echo "Record updated successfully";
            //Redirect to a confirmation page
            header("Location: ../confirmed_profile.html");
        } 
        else  {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    } catch (Exception $e) {
        echo "Error updating record: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Invalid input data:<br>";
    foreach ($validation_result as $error) {
        echo $error . "<br>";
    }
}        
$conn->close();

