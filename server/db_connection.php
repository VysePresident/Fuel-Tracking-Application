<?php
$servername = "gasco-server.mysql.database.azure.com";
$username = "tanya";
$password = "team53server";
$dbname = "gasco";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
