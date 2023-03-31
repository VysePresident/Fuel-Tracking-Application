<?php

class hcUser {
    private $email;
    private $fname;
    private $mname;
    private $lname;
    private $phone;
    private $zipcode;

    public function __construct($email, $fname, $lname, $phone, $zipcode) {
        $this->email = $email;
        $this->fname = $fname;
        $this->mname = null;
        $this->lname = $lname;
        $this->phone = $phone;
        $this->zipcode = $zipcode;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFname() {
        return $this->fname;
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function getMname() {
        return $this->mname;
    }

    public function setMname($mname) {
        $this->mname = $mname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getZipcode() {
        return $this->zipcode;
    }

    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }
}

?>