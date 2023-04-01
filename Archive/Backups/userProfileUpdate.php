<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\User;
use App\DatabaseConnection;

session_start();

$userId = $_SESSION['user_id'];

$dbConn = new DatabaseConnection();
$conn = $dbConn->getConnection();

$user = new User($conn);

// Get the user input and sanitize it
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$mname = filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_STRING);
$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$companyName = filter_input(INPUT_POST, 'companyName', FILTER_SANITIZE_STRING);
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
$street2 = filter_input(INPUT_POST, 'street2', FILTER_SANITIZE_STRING);
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);


if ($user->validate_input($sanitizedUserData)) {
    if ($user->updateUser($sanitizedUserData, $userId)) {
        echo "User profile updated successfully";
        // Redirect to an edit page
        header("Location: ../editUserProfile.html");
    } else {
        echo "Error updating user profile";
    }
} else {
    echo "Invalid input data";
}
