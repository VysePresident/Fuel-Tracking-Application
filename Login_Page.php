<?php include_once 'components/nav-bar.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<!--Linking the page that allows one to put restrictions on the email input fields-->
    <script src="components/email.validation.js"></script>
	<!--Linking the page that allows one to put restrictions on the password input fields-->
	<script src="components/password.validation.js"></script>

	<!--SESSION CONTINUATION - probably not necessary but for the sake of consistency -->
	<?php
		require_once 'server/loginSession.php';
		//require_once 'components/nav-bar.php';
	?>
	<!--This is section of the code is primarily for the top of the page. 
	For ex the image, the nav bar, and the links.-->
	<meta charset = "UTF-8" />
	<meta name = "viewport" content  = "width=device-width, initial-scale = 1.0" />
	<link rel = "stylesheet" href = "styles/login_page.css">
	<div class="nav-bar" id="nav-bar">
		<?php //include_once 'components/nav-bar.php'; ?>
        <!--<object type="text/html" data="components/nav-bar.php"></object>-->
	</div>
  <!--<header>
    <a href="./index.html"><img src="img/logo.png"></a>
	<link rel="stylesheet" href="styles/nav-bar.css">
	<nav>
		<i class="fa fa-bars" onclick="showMenu()"></i>
		<div class="nav-links" id="navLinks">
		  <i class="fa fa-times" onclick="hideMenu()"></i>
		  <ul>
			<li><a href="contact.html">CONTACT US</a></li>
			<li><a href="about.html">ABOUT</a></li>
			<li><a href="register.html">REGISTER</a></li>
			<li><a href="Login_Page.html">SIGN IN</a></li>
			<li><a></a></li>
		  </ul>
		</div>
	</nav>
</header>-->
	<?php
		ini_set("display_errors", "1");
		ini_set("display_startup_errors", "1");
		error_reporting(E_ALL);
		
		//require_once 'components/nav-bar.php';
	?>
</head>

<body>
<!--Accces the login php page-->
	<form method = "post" action = loginConfirmation.php>
		<!--The title of the page, need to centralize it and make the font bigger-->
		<label for = "login here" >Login Here</label>
		<!--This is the email section of the page-->
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required placeholder="Enter email">
		</div>
		<!--This is the password section of the page-->
		<div>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required placeholder="Enter password">
		</div>
		<!--The remember me section of the page-->
		<label 
            for = "remember"> Remember me:
            <input type = "checkbox" id = " remember" name = "remember">
        </label>
		<!--This is the Login portion of the page-->
		<div class = "button-container">
			<button type="submit">Login</button>
		</div>
		<!--This is where the link for the registration page will be-->
		<p>Don't have an account?<a href = "registration.php">Register here</a>.</p>
	</form>
    <footer>
		<!--This is where the footer of the page will be-->
		<section>
			<div class="footer" id="footer"></div>
		</section>
		<link rel="stylesheet" href="styles/footer.css">
		<div class="footer" id="footer"></div>
		<script src="components/nav-bar.js"></script>
		<script src="components/footer.js"></script>
    </footer>
</body>
</html>


