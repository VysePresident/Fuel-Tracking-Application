const home = document.getElementById("editUserProfile");
const container = document.createElement("div");

container.className = "container";
container.innerHTML = `
<body>
    <form class="formTable" action="./server/editUserProfile.php" method="POST">
        <input type="hidden" name="id" id="id" value="1">
        <div class="nav-bar" id="nav-bar"></div>
        <section id="formbox">
            <h1>USER PROFILE</h1>

            <section>
              <h2 class=>Profile Information</h2>
              <div class="formRow">
                  <p class="formCell" for="email">Email:</p>
                  <input class="formCell" type="email" name="email" id="email" required>
              </div>
              <div class="formRow">
                  <p class="formCell" for="password">Password:</p>
                  <input class="formCell" type="password" name="password" id="password" minlength="8" required>
              </div>
              <div class="formRow">
                <p class="formCell" for="password">Confirm Password:</p>
                <input class="formCell" type="password" name="confirmPassword" id="confirmPassword" minlength="8" required>
              </div>
            </section>
  

            <section>
              <h2 class="formHeader">Personal Information</h2>
              <div class="formRow">
                  <p class="formCell" for="fname">First Name:</p>
                  <input class="formCell" type="text" name="fname" id="fname" maxlength="50" required>
              </div>
              <div class="formRow">
                <p class="formCell" for="mname">Middle Name (optional):</p>
                <input class="formCell" type="text" name="mname" id="mname" maxlength="50">
              </div>
              <div class="formRow">
                  <p class="formCell" for="lname">Last Name:</p>
                  <input class="formCell" type="text" name="lname" id="lname" maxlength="50" required>
              </div class="formRow">
              <div class="formRow">
                  <p class="formCell" for="phone">Phone Number:</p>
                  <input class="formCell" type="tel" name="phone" id="phone" required>
              </div>
            </section>
  
            <h2>Company Information</h2>
            <div class="formRow">
                <p class="formCell" for="companyName">Company Name:</p>
                <input class="formCell" type="text" name="companyName" id="companyName" required>
            </div>
            
            <div class="formRow">
                <p for="state" class="formCell">State:</p>
                <select class="formCell" name="state" id="state" required>
                    <option src="components/states.js"></option>
                </select>
            </div>
            <div class="formRow">
                <p class="formCell" for="city">City:</p>
                <input class="formCell" type="text" name="city" id="city" maxlength="100" required>
            </div>
            <div class="formRow">
                <p class="formCell" for="street">Street Address:</p>
                <input class="formCell" type="text" name="street" id="street" maxlength="100" required>
            </div>
                <div class="formRow">
                <p class="formCell" for="street2">Street Address 2 (Optional):</p>
                <input class="formCell" type="text" name="street2" id="street2" maxlength="100">
            </div>
            <div class="formRow">
              <p class="formCell" for="zipcode">Zip Code:</p>
              <input class="formCell" type="text" name="zipcode" id="zipcode" maxlength="9" required>
            </div>
        </section>

        <section>
            <input type="submit" value="Submit" class="submitButton" id="submitButton">
        </section>
    </form>
    
</body>
`;
home.appendChild(container);

async function fetchUserData() {
    const response = await fetch('./server/getUserData.php');
    const userData = await response.json();
    // Populate the form fields with the fetched user data
    document.getElementById('email').value = userData.email;
    document.getElementById('password').value = userData.password;
    document.getElementById('confirmPassword').value = userData.password;
    document.getElementById('fname').value = userData.fname;
    document.getElementById('mname').value = userData.mname;
    document.getElementById('lname').value = userData.lname;
    document.getElementById('phone').value = userData.phone;
    document.getElementById('companyName').value = userData.companyName;
    document.getElementById('state').value = userData.companyState;
    document.getElementById('city').value = userData.companyCity;
    document.getElementById('street').value = userData.companyStreet;
    document.getElementById('street2').value = userData.companyStreet2;
    document.getElementById('zipcode').value = userData.zipcode;
}


// async function fetchUserData() {
//     const userData = {
//         email: 'john.doe@example.com',
//         password: 'Password123@',
//         fname: 'John',
//         mname: 'D',
//         lname: 'Doe',
//         phone: '555-555-5555',
//         companyName: 'ABC Corp',
//         state: 'Texas',
//         city: 'Missouri City',
//         street: '123 Main St',
//         street2: '',
//         zipcode: '90001'
//     };
  
//     // Populate the form fields with the fetched user data
//     document.getElementById('email').value = userData.email;
//     document.getElementById('password').value = userData.password;
//     document.getElementById('confirmPassword').value = userData.password;
//     document.getElementById('fname').value = userData.fname;
//     document.getElementById('mname').value = userData.mname;
//     document.getElementById('lname').value = userData.lname;
//     document.getElementById('phone').value = userData.phone;
//     document.getElementById('companyName').value = userData.companyName;
//     document.getElementById('state').value = userData.state;
//     document.getElementById('city').value = userData.city;
//     document.getElementById('street').value = userData.street;
//     document.getElementById('street2').value = userData.street2;
//     document.getElementById('zipcode').value = userData.zipcode;
// }

// Call the fetchUserData function when the page loads
fetchUserData();

  
const form = document.querySelector('.formTable');
console.log(form);
form.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (password !== confirmPassword) {
    e.preventDefault(); // prevent the form from submitting
    alert('Passwords do not match'); // display an error message
  }
});

