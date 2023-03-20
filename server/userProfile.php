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

function validate_input($data) {
    // Check for required fields
    $required_fields = ['custEmail', 'password', 'fname', 'lname', 'phone', 'companyName', 'state', 'city', 'street', 'zipcode'];
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            return false;
        }
    }

    // Check email format
    if (!filter_var($data['custEmail'], FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Check password length
    if (strlen($data['password']) < 8) {
        return false;
    }

    // Check phone number format
    if (!preg_match('/^\d{10,20}$/', $data['phone'])) {
        return false;
    }

    // Check zipcode format
    if (!preg_match('/^\d{5}(-\d{4})?$/', $data['zipcode'])) {
        return false;
    }

    // Validate other string lengths according to the database schema
    $string_lengths = [
        'fname' => 50,
        'mname' => 50,
        'lname' => 50,
        'companyName' => 100,
        'city' => 100,
        'street' => 100,
        'street2' => 100
    ];
    foreach ($string_lengths as $field => $length) {
        if (isset($data[$field]) && strlen($data[$field]) > $length) {
            return false;
        }
    }

    return true;
}

if (validate_input([
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
    header("Location: ../confirmed_profile.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$stmt->close();
$conn->close();
?>
