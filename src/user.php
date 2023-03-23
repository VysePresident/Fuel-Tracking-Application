<?php

namespace App;
use mysqli;
use Exception;

class User{
  private $conn;

  public function __construct(mysqli $conn){
    $this->conn = $conn;
    if ($this->conn->connect_errno) {
        throw new Exception($this->conn->connect_error);
    }
  }

  public function clean_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($this->conn, $data);
    return $data;
  }

  public function validate_input($data){
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

    // Validate other string lengths
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

  public function createUser(array $userData) {
    if (!$this->validate_input($userData)) {
        throw new Exception("Invalid user data provided.");
    }

    $hashed_password = password_hash($userData['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_profiles (email, password, fname, mname, lname, phone, companyName, state, city, street, street2, zipcode)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $userData['custEmail'], $hashed_password, $userData['fname'], $userData['mname'], $userData['lname'], $userData['phone'], $userData['companyName'], $userData['state'], $userData['city'], $userData['street'], $userData['street2'], $userData['zipcode']);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}
}