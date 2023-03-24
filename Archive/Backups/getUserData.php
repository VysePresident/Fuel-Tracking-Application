<?php
require_once 'database.php';

header('Content-Type: application/json');

$userId = $_SESSION['userId'];

// Fetch user data from the database
$query = "SELECT * FROM users WHERE id = :userId";
$stmt = $db->prepare($query);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the user data as a JSON object
echo json_encode($userData);
?>
