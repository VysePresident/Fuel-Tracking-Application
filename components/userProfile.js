const home = document.getElementById("userProfile");
const container = document.createElement("div");

container.className = "container";
container.innerHTML = `
<body>
    <form class="formTable" action="confirmed_profile.html" method="POST">
        <div class="nav-bar" id="nav-bar"></div>
        <section id="formbox">
            <h1>USER PROFILE</h1>

            <section>
              <h2 class=>Profile Information</h2>
              <div class="formRow">
                  <p class="formCell" for="custEmail">Email:</p>
                  <input class="formCell" type="email" name="custEmail" id="custEmail" required>
              </div>
              <div class="formRow">
                  <p class="formCell" for="password">Password:</p>
                  <input class="formCell" type="password" name="password" id="password" minlength="8" required>
              </div>
              <div class="formRow">
                <p class="formCell" for="password">Confirm Password:</p>
                <input class="formCell" type="password" name="password" id="password" minlength="8" required>
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
                <p class="formCell" for="street">Street Address 2 (Optional):</p>
                <input class="formCell" type="text" name="street" id="street" maxlength="100">
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

// Get the select element
const stateSelect = document.getElementById("state");

// Add the states to the select element
for (let i = 0; i < states.length; i++) {
  const option = document.createElement("option");
  option.value = states[i].code;
  option.textContent = states[i].name;
  stateSelect.appendChild(option);
}
