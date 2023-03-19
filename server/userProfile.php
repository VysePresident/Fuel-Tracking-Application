<?php
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

// Validate and sanitize input data
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

$email = clean_input($_POST['custEmail']);
$password = clean_input($_POST['password']);
$fname = clean_input($_POST['fname']);
$mname = clean_input($_POST['mname']);
$lname = clean_input($_POST['lname']);
$phone = clean_input($_POST['phone']);
$companyName = clean_input($_POST['companyName']);
$state = clean_input($_POST['state']);
$city = clean_input($_POST['city']);
$street = clean_input($_POST['street']);
$street2 = clean_input($_POST['street2']);
$zipcode = clean_input($_POST['zipcode']);

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute SQL statement
$sql = "INSERT INTO user_profiles (email, password, fname, mname, lname, phone, companyName, state, city, street, street2, zipcode)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $email, $hashed_password, $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode);

if ($stmt->execute()) {
    echo "New record created successfully";
    // Redirect to a confirmation page
    // header("Location: confirmed_profile.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
