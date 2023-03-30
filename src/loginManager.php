<?php

require_once __DIR__ . '/dbh.php';
require_once __DIR__ . '/client.php';

ini_set('max_execution_time', 300);
ini_set('memory_limit', '256M');

class LoginManager extends Dbh {
    private $email;
    private $password;
    private $conn;

    // Getters and Setters
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Constructor
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    public function getClientByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM clientInformation WHERE email = ?");
        $stmt->bind_param("s", $email); // TESTING
        $stmt->execute();
        $result = $stmt->get_result();
        $clientData = $result->fetch_assoc();
        //$stmt->execute([$email]);
        //$clientData = $stmt->fetch_assoc();
        //$clientData = $stmt->fetch();

        if ($clientData) {
          //echo "This is password: " . $clientData['password'] . '\n';
          //echo "This is object password: " . $this->password . '\n';
            return new Client(
                $clientData['email'],
                $clientData['fname'],
                $clientData['lname'],
                $clientData['phone'],
                $clientData['password'],
                $clientData['companyName'],
                $clientData['companyState'],
                $clientData['companyCity'],
                $clientData['companyStreet']
            );
        } else {
            return null;
        }
    }

    public function doesPasswordMatch($client, $password) {
        if ($client->getPassword() == $password) {
            return true;
        } else {
            return false;
        }

        //USE WHEN HASHING IS BUILT IN!
        //return password_verify($password, $client->getPassword());
    }

    public function isLoginValid() {
        $client = $this->getClientByEmail($this->email);
        if ($client) {
            if ($this->doesPasswordMatch($client, $this->password)) {
                $this->loginUser($client);
                //header("Location: ../index.php?noerror");
                //echo "LOGGED IN!" . '\n';
                exit();
            } else {
                //echo "WRONG PASSWORD!" . '\n';
                //echo "This is password: " . $this->password;
                header("Location: ../index.php?error=wrongpassword");
                exit();
            }
        } else {
            //echo "THERE WAS NO USER!" . '\n';
            header("Location: ../index.php?error=nouser");
            exit();
        }
    }

    private function loginUser($client) {
        session_start();
        $_SESSION['client'] = $client;
    }
}
?>
