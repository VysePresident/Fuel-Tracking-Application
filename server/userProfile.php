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

$email = $user->clean_input($_POST['email']);
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

if ($user->validate_input([
    'email' => $email,
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
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement
    $sql = "INSERT INTO user_profiles (email, password, fname, mname, lname, phone, companyName, state, city, street, street2, zipcode)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $email, $hashed_password, $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode);
} else {
    echo "Invalid input data";
}

if ($stmt->execute()) {
    echo "New record created successfully";
    //Redirect to a confirmation page
    header("Location: ../editUserProfile.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
