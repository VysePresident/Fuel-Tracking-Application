<?php

require_once 'src/loginManager.php';
$email = $_POST['email'];
$pass = $_POST['password'];

$loginManager = new LoginManager($email, $pass);
$loginManager->isLoginValid();

?>