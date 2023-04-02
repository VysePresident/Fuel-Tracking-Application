<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once('dbh.php');

// Use the email from the session
$userEmail = $_SESSION['email'];

// Connect to the database
$dbh = new Dbh();
$conn = $dbh->connect();

// Prepare the SELECT statement
$stmt = $conn->prepare("SELECT * FROM clientInformation WHERE email = ?");
$stmt->bind_param("s", $userEmail);

// Execute the SELECT statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    echo json_encode(["error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
