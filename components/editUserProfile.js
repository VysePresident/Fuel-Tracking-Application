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
                  <input class="formCell" type="password" name="password" id="password" minlength="8" placeholder="Leave empty to keep the current password">
              </div>
              <div class="formRow">
                <p class="formCell" for="password">Confirm Password:</p>
                <input class="formCell" type="password" name="confirmPassword" id="confirmPassword" minlength="8" placeholder="Leave empty to keep the current password">
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
    try {
        const response = await fetch('/server/getClientData.php');
        const responseBody = await response.text();
        if (!response.ok) {
            throw new Error(response.status);
        }
        const clientData = JSON.parse(responseBody);
        console.log(clientData);
        // Populate the form fields with the fetched user data
        document.getElementById('email').value = clientData.email;
        // document.getElementById('password').value = clientData.password;
        // document.getElementById('confirmPassword').value = clientData.password;
        document.getElementById('fname').value = clientData.fname;
        document.getElementById('mname').value = clientData.mname;
        document.getElementById('lname').value = clientData.lname;
        document.getElementById('phone').value = clientData.phone;
        document.getElementById('companyName').value = clientData.companyName;
        document.getElementById('state').value = clientData.companyState;
        document.getElementById('city').value = clientData.companyCity;
        document.getElementById('street').value = clientData.companyStreet;
        document.getElementById('street2').value = clientData.companyStreet2;
        document.getElementById('zipcode').value = clientData.zipcode;
    } catch (error) {
        console.error(`Failed to fetch user data: ${error}`);
        // Handle the error by displaying an error message to the user
        const errorMessage = document.createElement('p');
        errorMessage.textContent = 'Failed to fetch user data. Please try again later.';
        container.appendChild(errorMessage);
    }
}


 document.addEventListener('DOMContentLoaded', function() {
    // Call the fetchUserData function when the DOM is loaded
    fetchUserData();
      
    const form = document.querySelector('.formTable');
    console.log(form);
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        if (password !== '' && confirmPassword !== '' && password !== confirmPassword) {
            e.preventDefault(); // prevent the form from submitting
            alert('Passwords do not match'); // display an error message
        }
    });

});
 