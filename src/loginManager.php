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
        // Check credentials

        $stmt = $this->conn->prepare("SELECT * FROM userCredentials WHERE email = ?");
        $stmt->bind_param("s", $email); // TESTING
        $stmt->execute();
        $result = $stmt->get_result();
        $clientData = $result->fetch_assoc();
        //$stmt->execute([$email]);
        //$clientData = $stmt->fetch_assoc();
        //$clientData = $stmt->fetch();

        if ($clientData) {
            // Credentials good.  Check Password
            echo "CLIENT FOUND!" . ' \n ';
            if($this->doesPasswordMatch($this->password, $clientData['password']))
            {
                echo "PASSWORD MATCH! " . ' \n ';
                $stmtClientInformation = $this->conn->prepare(
                    "SELECT * FROM clientInformation WHERE email = ?");
                $stmtClientInformation->bind_param("s", $email);
                $stmtClientInformation->execute();
                $resultClientInformation = $stmtClientInformation->get_result();
                $clientInformation = $resultClientInformation->fetch_assoc();

                if ($clientInformation)
                {
                    echo "CLIENT INFO FOUND: " . ' \n ';
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
                        echo "SETTING mName: " . ' \n ';
                        $myClient->setMname($clientInformation['mname']);
                    }
                    if (isset($clientInformation['companyStreet2']))
                    {
                        echo "SETTING street2" .' \n ';
                        $myClient->setcompanyStreet2($clientInformation['companyStreet2']);
                    }
                    return $myClient;
                    
                }
                else
                {
                    // Error connecting to database
                    echo "Error connecting to database!";
                    //header("location: index.php?error=DB_CONN_FAILED");
                    //exit();
                }
                
            }
            else
            {
                //Login fails - wrong password
                echo "Wrong Password!";
                //header("location: index.php?error=WRONG_PASSWORD");
                //exit();
            }
          //echo "This is password: " . $clientData['password'] . '\n';
          //echo "This is object password: " . $this->password . '\n';
            /*return new Client(
                $clientData['email'],
                $clientData['fname'],
                $clientData['lname'],
                $clientData['phone'],
                $clientData['password'],
                $clientData['companyName'],
                $clientData['companyState'],
                $clientData['companyCity'],
                $clientData['companyStreet']
            );*/
        } else {
            // Email doesn't exist
            echo "NO EMAIL FOUND WHOOPS" . ' \n ';
            return null;
        }
    }

    public function doesPasswordMatch($pwd1, $pwd2) {
        if ($pwd1 == $pwd2) {
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
            $this->loginUser($client);
            echo "LOGGED IN!" . '\n';
            /*if ($this->doesPasswordMatch($client, $this->password)) {
                $this->loginUser($client);
                //header("Location: ../index.php?noerror");
                echo "LOGGED IN!" . '\n';
                //exit();*/
            } /*else {
                echo "WRONG PASSWORD!" . '\n';
                echo "This is password: " . $this->password;
                //header("Location: ../index.php?error=wrongpassword");
                //exit();
            }
        }*/
        else {
            echo "THERE WAS NO USER!" . '\n';
            //header("Location: ../index.php?error=nouser");
            //exit();
        }
}

    private function loginUser($client) {
        session_start();
        $_SESSION['client'] = $client;
    }

}
?>
