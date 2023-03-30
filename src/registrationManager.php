<?php

namespace App;
use mysqli;
use Exception;

require_once __DIR__ . '/dbh.php';

class User extends \Dbh {
  private $conn;

  public function __construct(){
    $this->conn = $this->connect(); //$conn;
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
    $errors = [];

    // Check for required fields
    $required_fields = ['custEmail', 'password', 'fname', 'lname', 'phone', 'zipcode', 'companyName', 'state', 'city', 'street'];
    foreach ($required_fields as $field) {
        if ($field === 'mname') {
            continue;
        }
        if (!isset($data[$field]) || empty($data[$field])) {
            $errors[] = "Missing or empty field: " . $field;
        }
    }

    // Check email format
    if (!filter_var($data['custEmail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check password length
    if (strlen($data['password']) < 8) {
        $errors[] = "Password too short, must be at least 8 characters";
    }

    // Check phone number format
    if (!preg_match('/^\d{10,20}$/', $data['phone'])) {
        $errors[] = "Invalid phone number format";
    }

    // Check zipcode format
    if (!preg_match('/^\d{5}(-\d{4})?$/', $data['zipcode'])) {
        $errors[] = "Invalid zipcode format";
    }

    // Validate other string lengths
    $string_lengths = [
        'fname' => 50,
        //'mname' => 50,
        'lname' => 50,
        'companyName' => 100,
        'city' => 100,
        'street' => 100//,
        //'street2' => 100
    ];
    foreach ($string_lengths as $field => $length) {
        if ($field === 'mname' || $field === 'street2') {
            continue;
        }
        if (isset($data[$field]) && strlen($data[$field]) > $length) {
            $errors[] = "Field " . $field . " too long, maximum length is " . $length . " characters";
        }
    }

    return empty($errors) ? true : $errors;
}

  public function createUser(array $userData) {

    $userData = $this->clean_input(($userData)); // ADDED

    if (!$this->validate_input($userData)) {
        throw new Exception("Invalid user data provided.");
    }

    $hashed_password = password_hash($userData['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_profiles (custEmail, password, fname/*, mname*/, lname, phone, zipcode, companyName, state, city, street/*, street2*/)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
$stmt->bind_param("ssssssssss", $userData['custEmail'], $hashed_password, $userData['fname']/*, $userData['mname']*/, $userData['lname'], $userData['phone'], $userData['zipcode'], $userData['companyName'], $userData['state'], $userData['city'], $userData['street']/*, $userData['street2']*/ );

    if ($stmt->execute()) {
        return true;
    }

    return false;
}


public function editUserProfile(array $userData) {
    if (!$this->validate_input($userData)) {
        throw new Exception("Invalid user data provided.");
    }

    $hashed_password = password_hash($userData['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE clientInformation SET email=?, password=?, fname=?/*, mname=?*/, lname=?, phone=?, zipcode=?, companyName=?, companyState=?, companyCity=?, companyStreet=?/*, street2=?*/ WHERE email=?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $userData['email'], $hashed_password, $userData['fname'], $userData['mname'], $userData['lname'], $userData['phone'], $userData['companyName'], $userData['state'], $userData['city'], $userData['street'], $userData['street2'], $userData['zipcode'], $userData['id']);

    if ($stmt->execute()) {
        
        $sql = "UPDATE userCredentials SET email=?, password=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $userData['custEmail'], $hashed_password);

        return true;
    }

    return false;
  }
}
