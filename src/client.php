<?php

require_once 'hcUser.php';

class Client extends hcUser {
    private $companyName;
    private $companyState;
    private $companyCity;
    private $companyStreet;

    public function __construct($email, $fname, $lname, $phone, $password,
                                $companyName, $companyState, $companyCity, $companyStreet) {
        parent::__construct($email, $fname, $lname, $phone, $password);
        $this->companyName = $companyName;
        $this->companyState = $companyState;
        $this->companyCity = $companyCity;
        $this->companyStreet = $companyStreet;
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
}

