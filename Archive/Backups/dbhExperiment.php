<?php

ini_set("display_errors", "1");
      ini_set("display_startup_errors", "1");
      error_reporting(E_ALL);

try {
    $dbh = new PDO('mysql:host=server.mysql.database.azure.com;dbname=gasco;sslmode=require', 'username', 'password');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert dummy testing entries
    $stmt = $dbh->prepare("INSERT INTO ClientInformation (email, password, fname, lname, phone, zipcode, companyName, companyState, companyCity, companyStreet)
                           VALUES (:email, :password, :fname, :lname, :phone, :zipcode, :companyName, :companyState, :companyCity, :companyStreet)");

    $stmt->execute(array(
        ':email' => 'bob1@example.com',
        ':password' => 'password1',
        ':fname' => 'Bobby',
        ':lname' => 'Bobson',
        ':phone' => '123-456-7890',
        ':zipcode' => '12345',
        ':companyName' => 'Bob Inc.',
        ':companyState' => 'California',
        ':companyCity' => 'Los Angeles',
        ':companyStreet' => '1234 Bob St.'
    ));

    $stmt->execute(array(
        ':email' => 'bob2@example.com',
        ':password' => 'password2',
        ':fname' => 'Bobert',
        ':lname' => 'Bobsen',
        ':phone' => '123-456-7891',
        ':zipcode' => '12346',
        ':companyName' => 'Bob & Sons',
        ':companyState' => 'New York',
        ':companyCity' => 'New York City',
        ':companyStreet' => '5678 Bob Ave.'
    ));

    $stmt->execute(array(
        ':email' => 'bob3@example.com',
        ':password' => 'password3',
        ':fname' => 'Bobina',
        ':lname' => 'Bobsen',
        ':phone' => '123-456-7892',
        ':zipcode' => '12347',
        ':companyName' => 'Bobbity Bob',
        ':companyState' => 'Texas',
        ':companyCity' => 'Houston',
        ':companyStreet' => '910 Bob Blvd.'
    ));

    $stmt->execute(array(
        ':email' => 'bob4@example.com',
        ':password' => 'password4',
        ':fname' => 'Bob-o',
        ':lname' => 'Bobbyson',
        ':phone' => '123-456-7893',
        ':zipcode' => '12348',
        ':companyName' => 'Bob and Beyond',
        ':companyState' => 'Florida',
        ':companyCity' => 'Miami',
        ':companyStreet' => '111 Bob Lane'
    ));

    $stmt->execute(array(
        ':email' => 'bob5@example.com',
        ':password' => 'password5',
        ':fname' => 'Bobbles',
        ':lname' => 'Bobberson',
        ':phone' => '123-456-7894',
        ':zipcode' => '12349',
        ':companyName' => 'Bobulous',
        ':companyState' => 'Arizona',
        ':companyCity' => 'Phoenix',
        ':companyStreet' => '222 Bob Rd.'
    ));

    echo "Successfully inserted dummy testing entries.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Heya!</p>
    
</body>
</html>