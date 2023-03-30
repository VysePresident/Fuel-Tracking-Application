<?php

require_once 'hcUser.php';

class Client extends hcUser {
    private $zipcode;
    private $companyName;
    private $companyState;
    private $companyCity;
    private $companyStreet;
    private $companyStreet2;

    public function __construct($email, $fname, $lname, $phone, $zipcode,
                                $companyName, $companyState, $companyCity, $companyStreet) {
        parent::__construct($email, $fname, $lname, $phone);
        $this->companyName = $companyName;
        $this->companyState = $companyState;
        $this->companyCity = $companyCity;
        $this->companyStreet = $companyStreet;
        $this->companyStreet2 = null;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
    }

    public function getCompanyState() {
        return $this->companyState;
    }

    public function setCompanyState($companyState) {
        $this->companyState = $companyState;
    }

    public function getCompanyCity() {
        return $this->companyCity;
    }

    public function setCompanyCity($companyCity) {
        $this->companyCity = $companyCity;
    }

    public function getCompanyStreet() {
        return $this->companyStreet;
    }

    public function setCompanyStreet($companyStreet) {
        $this->companyStreet = $companyStreet;
    }

    public function getCompanyStreet2() {
        return $this->companyStreet2;
    }

    public function setCompanyStreet2($companyStreet2) {
        $this->companyStreet2 = $companyStreet2;
    }
}

