<?php

namespace App;

use mysqli;

class DatabaseConnection {
  private $conn;

  public function __construct() {
      // Replace the credentials and database name with your own
      $this->conn = new mysqli("localhost", "username", "password", "database_name");

      if ($this->conn->connect_errno) {
          throw new Exception($this->conn->connect_error);
      }
  }

  public function getConnection() {
      return $this->conn;
  }
}
