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

public function validate_input($data, $password_optional = false){
    $errors = [];

    // Check for required fields
    if($password_optional){
        $required_fields = ['email', 'fname', 'lname', 'phone', 'companyName', 'state', 'city', 'street', 'zipcode'];
    }
    else{
        $required_fields = ['email', 'password', 'fname', 'lname', 'phone', 'companyName', 'state', 'city', 'street', 'zipcode'];
    }
    
    foreach ($required_fields as $field) {
        if ($field === 'mname') {
            continue;
        }
        if (!isset($data[$field]) || empty($data[$field])) {
            $errors[] = "Missing or empty field: " . $field;
        }
    }

    // Check email format
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

        $errors[] = "Invalid email format";
    }

    // Check password length
    if ($password_optional) {
        // Check if the password field is provided and is not empty
        if (isset($data['password']) && !empty($data['password'])) {
            if (strlen($data['password']) < 8) {
                $errors[] = "Password too short, must be at least 8 characters";
            }
        }
    } else {
        if (!isset($data['password']) || empty($data['password'])) {
            $errors[] = "Missing or empty field: password";
        } elseif (strlen($data['password']) < 8) {
            $errors[] = "Password too short, must be at least 8 characters";
        }
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
        'mname' => 50,
        'lname' => 50,
        'companyName' => 100,
        'city' => 100,
        'street' => 100,
        'street2' => 100
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


//   public function createUser(array $userData) {
//     if (!$this->validate_input($userData)) {
//         throw new Exception("Invalid user data provided.");
//     }

//     $hashed_password = password_hash($userData['password'], PASSWORD_DEFAULT);

//     $sql = "INSERT INTO ClientInformation (email, fname, mname, lname, phone, companyName, companyState, companyCity, companyStreet, companyStreet2, zipcode)
//     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

//     $stmt = $this->conn->prepare($sql);
//     $stmt->bind_param("ssssssssssss", $userData['email'], $hashed_password, $userData['fname'], $userData['mname'], $userData['lname'], $userData['phone'], $userData['companyName'], $userData['state'], $userData['city'], $userData['street'], $userData['street2'], $userData['zipcode']);

//     if ($stmt->execute()) {
//         return true;
//     }

//     return false;
// }



// public function editUserProfile(array $userData) {
//     if (!$this->validate_input($userData)) {
//         throw new Exception("Invalid user data provided.");
//     }

//     $hashed_password = password_hash($userData['password'], PASSWORD_DEFAULT);

//     $sql = "UPDATE user_profiles SET custEmail=?, password=?, fname=?, mname=?, lname=?, phone=?, companyName=?, state=?, city=?, street=?, street2=?, zipcode=? WHERE id=?";

//     $stmt = $this->conn->prepare($sql);
//     $stmt->bind_param("ssssssssssssi", $userData['custEmail'], $hashed_password, $userData['fname'], $userData['mname'], $userData['lname'], $userData['phone'], $userData['companyName'], $userData['state'], $userData['city'], $userData['street'], $userData['street2'], $userData['zipcode'], $userData['id']);

//     if ($stmt->execute()) {
//         return true;
//     }

//     return false;
//   }
}