<?php

class Dbh {

    public function connect() {
        ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

        $host = 'gasco-server.mysql.database.azure.com';
        $user = 'alex';
        $password = 'team53server';
        $dbname = 'gasco';
        $port = 3306;

        // Create connection
        // $conn = new mysqli($host, $user, $password, $dbname);
        $conn = mysqli_init();
        mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
        mysqli_real_connect($conn, $host, $user, $password, $dbname, $port, MYSQLI_CLIENT_SSL);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}