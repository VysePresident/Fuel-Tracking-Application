<?php

require_once 'clientsList.php';
require_once '../src/hcUser.php';
require_once '../src/client.php';
require_once 'loginManager.php';
require_once 'registrationManager.php';

$myLoginManager = new LoginManager('tom@example.com', 'password1');
$myLoginManager->isLoginValid();
header("Location: ../index.php");


//$myLoginManager->confirmClientsWorks();
//echo $myLoginManager->getEmail();
$testEmailExists = $myLoginManager->doesEmailExist($clients);
if($testEmailExists)
{
    echo "<p>IT LIVES!</p>";
}
else {
    echo "<p>IT DEAD</p>";
}

$testPassMatch = $myLoginManager->doesPasswordMatch($clients);
if($testPassMatch)
{
    echo "<p>222IT LIVES222!</p>";
}
else {
    echo "<p>222IT DEAD222</p>";
}

$testIsLoginValid = $myLoginManager->isLoginValid();
if($testIsLoginValid)
{
    echo "<p>333 IT LIVES 333!</p>";
}
else {
    echo "<p>333 IT DEAD 333</p>";
}

//echo "$testEmailExists";*/

echo "<p>LINE BREAK</p>";

//echo $myManager->getPhone();



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
    <p>Test</p>
    <p><?php echo $clients[0]->getFname();?></p>
    <p><?php echo $clients[0]->getEmail();?></p>
    <p>Test</p>
    <p>Test</p>
</body>
</html>