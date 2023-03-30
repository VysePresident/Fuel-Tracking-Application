<?php

ini_set("display_errors", "1");
		ini_set("display_startup_errors", "1");
		error_reporting(E_ALL);

require_once 'src/loginManager.php';
$email = $_POST['email'];
$pass = $_POST['password'];

$loginManager = new LoginManager($email, $pass);
$loginManager->isLoginValid();

?>