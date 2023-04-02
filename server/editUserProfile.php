<?php
// require_once('../src/dbh.php');
// require_once('../src/client.php');
// require_once('../src/user.php');

// session_start();

// if (!isset($_SESSION['email'])) {
//     header('Location: ../index.php');
//     exit();
// }

// // Get the current client object from the session
// $client = $_SESSION['client'];

// // Get the form data
// $email = $_POST['email'];
// $password = $_POST['password'];
// $fname = $_POST['fname'];
// $mname = $_POST['mname'];
// $lname = $_POST['lname'];
// $phone = $_POST['phone'];
// $companyName = $_POST['companyName'];
// $state = $_POST['state'];
// $city = $_POST['city'];
// $street = $_POST['street'];
// $street2 = $_POST['street2'];
// $zipcode = $_POST['zipcode'];



// // Update the client object with the new values
// $client->setEmail($email);
// $client->setFname($fname);
// $client->setMname($mname);
// $client->setLname($lname);
// $client->setPhone($phone);
// $client->setCompanyName($companyName);
// $client->setCompanyState($state);
// $client->setCompanyCity($city);
// $client->setCompanyStreet($street);
// $client->setcompanyStreet2($street2);
// $client->setZipcode($zipcode);

// try {
//     // Update the client information in the database
//     $conn = new Dbh();
//     $stmt = $conn->connect()->prepare("UPDATE clientInformation SET fname=?, mname=?, lname=?, phone=?, companyName=?, companyState=?, companyCity=?, companyStreet=?, companyStreet2=?, zipcode=? WHERE email=?");
//     $stmt->bind_param("sssssssssss", $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode, $email);
//     $stmt->execute();

//     // Update the user credentials in the database
//     $stmt = $conn->connect()->prepare("UPDATE userCredentials SET password=? WHERE email=?");
//     $stmt->bind_param("ss", $password, $email);
//     $stmt->execute();

//     // Update the client object in the session
//     $_SESSION['client'] = $client;

//     header("Location: ../confirmed_profile.php");
//     exit();
// } catch (mysqli_sql_exception $e) {
//     // Handle the database error
//     echo "An error occurred: " . $e->getMessage();
// }


require_once __DIR__ . '/../vendor/autoload.php';

use App\User;

// Database credentials
$servername = "gasco-server.mysql.database.azure.com";
$username = "tanya";
$password = "team53server";
$dbname = "gasco";
$port = 3306;

// Create connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port, MYSQLI_CLIENT_SSL);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = new User($conn);

// Get the form data
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

$validation_result = $user->validate_input([
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
]);

if ($validation_result === true) {
    try {
        // Hash the password 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare and execute SQL statement for ClientInformation
        $sql_client_info = "UPDATE ClientInformation SET email=?, fname=?, mname=?, lname=?, phone=?, companyName=?, companyState=?, companyCity=?, companyStreet=?, companyStreet2=?, zipcode=? WHERE email=?";

        $stmt_client_info = $conn->prepare($sql_client_info);
        $stmt_client_info->bind_param("ssssssssssss", $email, $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode, $email);

        // Prepare and execute SQL statement for UserCredentials
        $sql_user_credentials = "UPDATE UserCredentials SET email=?, password=? WHERE email=?";

        $stmt_user_credentials = $conn->prepare($sql_user_credentials);
        $stmt_user_credentials->bind_param("sss", $email, $hashed_password, $email);

        // Execute both statements
        if ($stmt_client_info->execute() && $stmt_user_credentials->execute()) {
            echo "Record updated successfully";
            //Redirect to a confirmation page
            header("Location: ../confirmed_profile.php");
        } else {
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
