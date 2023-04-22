<?php

//session_start();

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

    /*public function getConn() {
        return $this->conn;
    }*/

    /*public function setConn($conn) {
        $this->conn = $conn;
    }*/

    // Constructor
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    public function getClientByEmail($email) {
        // Check credentials
        //echo "CHECK CREDENTIALS"  . '\n';
        $stmt = $this->conn->prepare("SELECT * FROM userCredentials WHERE email = ?");
        $stmt->bind_param("s", $email); // TESTING
        $stmt->execute();
        $result = $stmt->get_result();
        $clientData = $result->fetch_assoc();

        if ($clientData) {
            // Credentials good.  Check Password
            //echo "CHECK PASSWORD"  . '\n';
            if($this->doesPasswordMatch($this->password, $clientData['password']))
            {
                $stmtClientInformation = $this->conn->prepare(
                    "SELECT * FROM clientInformation WHERE email = ?");
                $stmtClientInformation->bind_param("s", $email);
                $stmtClientInformation->execute();
                $resultClientInformation = $stmtClientInformation->get_result();
                $clientInformation = $resultClientInformation->fetch_assoc();

                if ($clientInformation)
                {
                    //echo "GET CLIENT INFO"  . '\n';
                    $myClient = new Client(
                        $clientInformation['email'],
                        $clientInformation['fname'],
                        $clientInformation['lname'],
                        $clientInformation['phone'],
                        $clientInformation['zipcode'],
                        $clientInformation['companyName'],
                        $clientInformation['companyState'],
                        $clientInformation['companyCity'],
                        $clientInformation['companyStreet']
                    );
                    if (isset($clientInformation['mname']))
                    {
                        $myClient->setMname($clientInformation['mname']);
                    }
                    if (isset($clientInformation['companyStreet2']))
                    {
                        $myClient->setcompanyStreet2($clientInformation['companyStreet2']);
                    }
                    return $myClient;
                    
                }
                else
                {
                    //echo "CAN'T CONNECT"  . '\n';
                    // Error connecting to database
                    return null;
                    //header("location: index.php?error=DB_CONN_FAILED");
                    //exit();
                }
                
            }
            else
            {
                //echo "WRONG PASSWORD"  . '\n';
                //Login fails - wrong password
                return null;
                //header("location: index.php?error=WRONG_PASSWORD");
                //exit();
            }
        } else {
            //echo "WRONG EMAIL"  . '\n';
            // Email doesn't exist
            return null;
        }
    }

    public function doesPasswordMatch($pwd1, $pwd2) {
        if (password_verify($pwd1, $pwd2)) /*($pwd1 == $pwd2)*/ {
            return true;
        } else {
            return false;
        }

        //USE WHEN HASHING IS BUILT IN!
        //return password_verify($password, $client->getPassword());
    }

    /*public function isLoginValid() {
        $client = $this->getClientByEmail($this->email);
        if ($client) {
            $this->loginUser($client);
            header("Location: ../index.php?noerror");
            exit();
            } 
        else {
            header("Location: ../index.php?error=noUser!");
            exit();
        }
}*/

    public function isLoginValid() {
        $client = $this->getClientByEmail($this->email);
        //echo 'RESULTS ARE ' . '\n';
        if ($client) {
            //echo 'SUCCESS' . '\n';
            //header("Location: ../login.php");
            $_SESSION['client'] = $client;
            $_SESSION['email'] = $client->getEmail();
            header("Location: ../index.php?noerror");
            exit();
            } 
        else {
            //echo 'FAILURE' . '\n';
            return false;
            //header("Location: ../index.php?error=noUser!");
            //exit();
        }
    }

    /*public function loginUser($client) {
        session_start();
        $_SESSION['client'] = $client;
        return true;
    }*/

}
?>
