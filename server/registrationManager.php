<?php

//require_once 'clientsList.php';
require_once '../src/client.php';

class RegistrationManager extends Client {

    private $passwordConfirm;

    public function __construct($email, $password, $passwordConfirm, $fname, $lname, $phone, $companyName, $companyState, $companyCity, $companyStreet) {
        parent::__construct($email, $password, $fname, $lname, $phone, $companyName, $companyState, $companyCity, $companyStreet);
        $this->passwordConfirm = $passwordConfirm;
    }

    public function getPasswordConfirm() {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm($passwordConfirm) {
        $this->passwordConfirm = $passwordConfirm;
    }

    public function isEmailUnique() {
        global $clients;
        foreach ($clients as $client) {
            if ($client->getEmail() == $this->getEmail()) {
                return false;
            }
        }
        return true;
    }

    public function doesPasswordMatch() {
        return ($this->getPassword() === $this->getPasswordConfirm());
    }

    public function validateInput() {
        $validEmail = filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL) !== false;
        $validPhone = preg_match("/^[0-9]{10}$/", $this->getPhone()) === 1;
        $validStringFields = strlen($this->getFname()) <= 50 && strlen($this->getLname()) <= 50 && strlen($this->getCompanyName()) <= 50 && strlen($this->getCompanyState()) <= 50 && strlen($this->getCompanyCity()) <= 50 && strlen($this->getCompanyStreet()) <= 50;
        $validPasswordLength = strlen($this->getPassword()) >= 8;
        return $validEmail && $validPhone && $validStringFields && $validPasswordLength;
    }

    public function createAccount() {
        global $clients;
        array_push($clients, new Client($this->getEmail(), $this->getPassword(), $this->getFname(), $this->getLname(), $this->getPhone(), $this->getCompanyName(), $this->getCompanyState(), $this->getCompanyCity(), $this->getCompanyStreet()));
        $_SESSION['client'] = end($clients);
    }

    public function isRegistrationValid() {
        if (!$this->validateInput()) {
            return "Invalid input. Please check your information and try again.";
        } else if (!$this->doesPasswordMatch()) {
            return "Passwords do not match. Please try again.";
        } else if (!$this->isEmailUnique()) {
            return "Email address already has an account!";
        } else {
            $this->createAccount();
            return true;
        }
    }

}

