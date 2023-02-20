const navBar = document.getElementById('nav-bar');

navBar.innerHTML = `
  <link rel="stylesheet" href="./styles/nav-bar.css">
  <header>
    <a href="./index.html"><img src="img/logo.png"></a>
    <nav>
      <i class="fa fa-bars" onclick="showMenu()"></i>
      <div class="nav-links" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()"></i>
        <ul>
          <li><a href="contact.html">CONTACT US</a></li>
          <li><a href="about.html">ABOUT</a></li>
          <li><a href="register.html">REGISTER</a></li>
          <li><a href="signin.html">SIGN IN</a></li>
        </ul>
      </div>
    </nav>
  </header>
`;

// get the navLinks element
const navLinks = document.getElementById("navLinks");

// show/hide the navigation menu when the user clicks the menu icon
function showMenu() {
  navLinks.style.right = "0";
}

function hideMenu() {
  navLinks.style.right = "-200px";
}


