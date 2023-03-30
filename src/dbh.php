<?php

class Dbh {

    protected function connect() {
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

        $host = 'gasco-server.mysql.database.azure.com';
        $user = 'alex';
        $password = 'team53server';
        $dbname = 'gasco';

        // Create connection
        $conn = new mysqli($host, $user, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}