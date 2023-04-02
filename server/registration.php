<?php
require_once __DIR__ . '/../vendor/autoload.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
// $dotenv->load();

use App\User;

// Database credentials
// $servername = getenv('DB_HOST');
// $username = getenv('DB_USER');
// $password = getenv('DB_PASS');
// $dbname = getenv('DB_NAME');
$servername = "gasco-server.mysql.database.azure.com";
$username = "tanya";
$password = 'team53server';
$dbname = 'gasco';
$port = 3306;
$ssl_mode = "require";

// echo "Host: {$servername}, User: {$username}, Pass: {$password}, Name: {$dbname}";

// Create connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port, MYSQLI_CLIENT_SSL);

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
$companyState = $user->clean_input($_POST['state']);
$companyCity = $user->clean_input($_POST['city']);
$companyStreet = $user->clean_input($_POST['street']);
$companyStreet2 = $user->clean_input($_POST['street2']);
$zipcode = $user->clean_input($_POST['zipcode']);

if ($user->validate_input([
    'email' => $email,
    'password' => $password,
    'fname' => $fname,
    'mname' => $mname,
    'lname' => $lname,
    'phone' => $phone,
    'companyName' => $companyName,
    'companyState' => $companyState,
    'companyCity' => $companyCity,
    'companyStreet' => $companyStreet,
    'companyStreet2' => $companyStreet2,
    'zipcode' => $zipcode
])) {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement for ClientInformation
    $sql_client_info = "INSERT INTO ClientInformation (email, fname, mname, lname, phone, companyName, companyState, companyCity, companyStreet, companyStreet2, zipcode)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_client_info = $conn->prepare($sql_client_info);
    $stmt_client_info->bind_param("sssssssssss", $email, $fname, $mname, $lname, $phone, $companyName, $companyState, $companyCity, $companyStreet, $companyStreet2, $zipcode);

    // Prepare and execute SQL statement for UserCredentials
    $sql_user_credentials = "INSERT INTO UserCredentials (email, password)
    VALUES (?, ?)";

    $stmt_user_credentials = $conn->prepare($sql_user_credentials);
    $stmt_user_credentials->bind_param("ss", $email, $hashed_password);

    // Execute both statements
    if ($stmt_client_info->execute() && $stmt_user_credentials->execute()) {
        echo "New record created successfully";
        //Redirect to a confirmation page
        header("Location: ../editUserProfile.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid input data";
}

$stmt_client_info->close();
$stmt_user_credentials->close();
$conn->close();
