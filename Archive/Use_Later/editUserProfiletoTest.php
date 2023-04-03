<?php
// require_once __DIR__ . '/../vendor/autoload.php';
namespace App;
use mysqli;
use Exception;

use App\User;

class EditUserProfiletoTest {
  private $conn;

  public function __construct(mysqli $conn){
      $this->conn = $conn;
      if ($this->conn->connect_errno) {
          throw new Exception($this->conn->connect_error);
      }
  }

  public function run() {
    $user = new User($this->conn);
    // ob_start();
    if (!isset($_POST['email'])) {
      echo "Email not provided";
      return;
    }

    // Get the form data
    $email = $user->clean_input($_POST['email']);
    $password = $user->clean_input($_POST['password']);
    $fname = $user->clean_input($_POST['fname']);
    $mname = $user->clean_input($_POST['mname']);
    $lname = $user->clean_input($_POST['lname']);
    $phone = $user->clean_input($_POST['phone']);
    $companyName = $user->clean_input($_POST['companyName']);
    $state = $user->clean_input($_POST['state']);
    $city = $user->clean_input($_POST['city']);
    $street = $user->clean_input($_POST['street']);
    $street2 = $user->clean_input($_POST['street2']);
    $zipcode = $user->clean_input($_POST['zipcode']);

    $validation_result = $user->validate_input([
        'email' => $email,
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
    ]);

    if ($validation_result === true) {
      try {
        // Hash the password 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare and execute SQL statement for ClientInformation
        $sql_client_info = "UPDATE ClientInformation SET email=?, fname=?, mname=?, lname=?, phone=?, companyName=?, companyState=?, companyCity=?, companyStreet=?, companyStreet2=?, zipcode=? WHERE email=?";

        $stmt_client_info = $this->conn->prepare($sql_client_info);
        $stmt_client_info->bind_param("ssssssssssss", $email, $fname, $mname, $lname, $phone, $companyName, $state, $city, $street, $street2, $zipcode, $email);

        // Prepare and execute SQL statement for UserCredentials
        $sql_user_credentials = "UPDATE UserCredentials SET email=?, password=? WHERE email=?";

        $stmt_user_credentials = $this->conn->prepare($sql_user_credentials);
        $stmt_user_credentials->bind_param("sss", $email, $hashed_password, $email);

        // Execute both statements
        if ($stmt_client_info->execute() && $stmt_user_credentials->execute()) {
          
            //Redirect to a confirmation page
          
          // header("Location: ../confirmed_profile.php");
          // echo "Record updated successfully";
          // ob_end_clean(); 
          // ob_end_flush();
        }
        else {
          echo "Error updating record: " . $this->conn->error . "<br>";
        }
    } 
    catch (Exception $e) {
      echo "Error updating record: " . $e->getMessage() . "<br>";
    }
    }else {
      echo "Invalid input data:<br>";
      foreach ($validation_result as $error) {
        echo $error . "<br>";
      }
    }
  }
}
          
  // Database credentials
  $servername = "gasco-server.mysql.database.azure.com";
  $username = "tanya";
  $password = "team53server";
  $dbname = "gasco";
  $port = 3306;
  
  // Create connection
  $conn = mysqli_init();
  mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
  mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port, MYSQLI_CLIENT_SSL);
  
  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  
  $edit_user_profile = new EditUserProfiletoTest($conn);
  $edit_user_profile->run();
  
  $conn->close();
