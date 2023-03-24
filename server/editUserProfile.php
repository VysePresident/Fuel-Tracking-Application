<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\User;

$servername = "localhost";
$username = "root";
$password = "GasCo12345678";
$dbname = "gasco";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = new User($conn);

// $userId = $user->clean_input($_POST['userId']);
$email = $user->clean_input($_POST['custEmail']);
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

$stmt = null;

if ($user->validate_input([
    'custEmail' => $email,
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
    $sql = "UPDATE user_profiles SET email=?, password=?, fname=?, mname=?, lname=?, phone=?, companyName=?, state=?, city=?, street=?, street2=?, zipcode=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $email, $hashed_password, $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode, $userId);
} else {
    echo "Invalid input data";
}

if ($stmt !== null && $stmt->execute()) {
    echo "Record updated successfully";
    //Redirect to a confirmation page
    header("Location: ../confirmed_profile.html");
} else {
    echo "Error updating record.<br>" . $conn->error;
}

if ($stmt !== null) {
    $stmt->close();
}

$conn->close();
