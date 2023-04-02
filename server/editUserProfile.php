<?php
session_start();

require_once('./src/dbh.php');
require_once('./src/client.php');

if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
    exit();
}

// Get the current client object from the session
$client = $_SESSION['client'];

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$companyName = $_POST['companyName'];
$state = $_POST['state'];
$city = $_POST['city'];
$street = $_POST['street'];
$street2 = $_POST['street2'];
$zipcode = $_POST['zipcode'];

// Update the client object with the new values
$client->setEmail($email);
$client->setPassword($password);
$client->setFname($fname);
$client->setMname($mname);
$client->setLname($lname);
$client->setPhone($phone);
$client->setCompanyName($companyName);
$client->setCompanyState($state);
$client->setCompanyCity($city);
$client->setCompanyStreet($street);
$client->setcompanyStreet2($street2);
$client->setZipcode($zipcode);

// Update the client information in the database
$conn = new Dbh();
$stmt = $conn->connect()->prepare("UPDATE clientInformation SET fname=?, mname=?, lname=?, phone=?, companyName=?, companyState=?, companyCity=?, companyStreet=?, companyStreet2=?, zipcode=? WHERE email=?");
$stmt->bind_param("sssssssssss", $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode, $email);
$stmt->execute();

// Update the user credentials in the database
$stmt = $conn->connect()->prepare("UPDATE userCredentials SET password=? WHERE email=?");
$stmt->bind_param("ss", $password, $email);
$stmt->execute();

// Update the client object in the session
$_SESSION['client'] = $client;

header("Location: ../confirmed_profile.php");
exit();
?>
