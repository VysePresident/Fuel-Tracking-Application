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

require_once('db_connection.php');

// Use the email from the session
$userEmail = $_SESSION['email'];

$query = "SELECT ci.*, uc.password FROM ClientInformation ci
          JOIN UserCredentials uc ON ci.email = uc.email
          WHERE ci.email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
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
