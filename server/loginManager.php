<?php

require_once 'clientsList.php';
$GLOBALS['clients'] = $clients;

class LoginManager {
    private $email;
    private $password;
    private $myClients;

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

    public function __construct($email, $password)
    {
      $this->email = $email;
      $this->password = $password;
      $this->myClients = $GLOBALS['clients'];
      //$this->myClients = $clients;
    }
  
    public function doesEmailExist() {
      foreach ($this->myClients as $client) {
        if ($client->getEmail() === $this->email) {
          return true;
        }
      }
      return false;
    }
  
    public function doesPasswordMatch() {
      foreach ($this->myClients as $client) {
        if ($client->getEmail() === $this->email) {
          if ($client->getPassword() === $this->password) {
            //$this->loginUser($client);
            return true;
          } else {
            echo "Incorrect password.";
            return false;
          }
        }
      }
      echo "Incorrect login information.";
    }
  
    public function loginUser($client) {
      session_start();
      $_SESSION['email'] = $client->getEmail();
      $_SESSION['fname'] = $client->getFname();
      $_SESSION['lname'] = $client->getLname();
      $_SESSION['phone'] = $client->getPhone();
      $_SESSION['companyName'] = $client->getCompanyName();
      $_SESSION['companyState'] = $client->getCompanyState();
      $_SESSION['companyCity'] = $client->getCompanyCity();
      $_SESSION['companyStreet'] = $client->getCompanyStreet();
      echo "Logged in successfully.";
    }

    public function isLoginValid()
    {
      $confirmEmailExists = $this->doesEmailExist();
      $confirmPasswordMatches = $this->doesPasswordMatch();

      if ($confirmEmailExists && $confirmPasswordMatches)
      {
        $client = $this->getClientByEmail($this->email);
        $this->loginUser($client);
        echo "<p>MISSION SUCCESS LOGGED IN!</p>";
        return true;
      }
      return false;
    }

    private function getClientByEmail($email) {
      foreach ($this->myClients as $client) {
        if ($client->getEmail() === $email) {
          echo "<p>EMAIL FOUND</p>";
          return $client;
        }
      }
      return null;
    }
}
?>


<?php

/*
require_once 'clientsList.php';

class LoginManager {
    private $email;
    private $password;

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

    public function __construct($email, $password)
    {
      $this->email = $email;
      $this->password = $password;
    }
  
    public function doesEmailExist($clients) {
      foreach ($clients as $client) {
        if ($client->getEmail() === $this->email) {
          return true;
        }
      }
      return false;
    }
  
    public function doesPasswordMatch($clients) {
      foreach ($clients as $client) {
        if ($client->getEmail() === $this->email) {
          if ($client->getPassword() === $this->password) {
            //$this->loginUser($client);
            return true;
          } else {
            echo "Incorrect password.";
            return false;
          }
        }
      }
      echo "Incorrect login information.";
    }
  
    public function loginUser($client) {
      session_start();
      $_SESSION['email'] = $client->getEmail();
      $_SESSION['fname'] = $client->getFname();
      $_SESSION['lname'] = $client->getLname();
      $_SESSION['phone'] = $client->getPhone();
      $_SESSION['companyName'] = $client->getCompanyName();
      $_SESSION['companyState'] = $client->getCompanyState();
      $_SESSION['companyCity'] = $client->getCompanyCity();
      $_SESSION['companyStreet'] = $client->getCompanyStreet();
      echo "Logged in successfully.";
    }

    /*public function isLoginValid()
    {
      $confirmEmailExists = $this->doesEmailExist($clients);
      $confirmPasswordMatches = $this->doesPasswordMatch($clients);

      if ($confirmEmailExists && $confirmPasswordMatches)
      {
        this->loginUser($client);
      }

    }
  }*/

  ?>
  