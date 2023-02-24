const home = document.getElementById('userProfile');
const container = document.createElement('div');

container.className = 'container';
container.innerHTML = `
<body>
    <form class="formTable" action="orderSummary.php" method="POST">
        <div class="nav-bar" id="nav-bar"></div>
        <section>
            <h1>PROFILE</h1>

            <section>
              <h2 class="formHeader">PROFILE INFORMATION</h2>
              <p class="formRow">
                  <label class="formCell" for="custEmail">Email:</label>
                  <input class="formCell" type="text" name="custEmail" id="custEmail" required>
              </p>
              <p class="formRow">
                  <label class="formCell" for="password">Password:</label>
                  <input class="formCell" type="password" name="password" id="password" minlength="8" required>
              </p>
              <p class="formRow">
                <label class="formCell" for="password">Confirm Password:</label>
                <input class="formCell" type="password" name="password" id="password" minlength="8" required>
              </p>
            </section>
  

            <section>
              <h2 class="formHeader">PERSONAL INFORMATION</h2>
              <p class="formRow">
                  <label class="formCell" for="fname">First Name:</label>
                  <input class="formCell" type="text" name="fname" id="fname" maxlength="25" required>
              </p>
              <p class="formRow">
                <label class="formCell" for="mname">Middle Name (optional):</label>
                <input class="formCell" type="text" name="mname" id="mname" maxlength="25">
            </p>
              <p class="formRow">
                  <label class="formCell" for="lname">Last Name:</label>
                  <input class="formCell" type="text" name="lname" id="lname" maxlength="25" required>
              </p class="formRow">
              <p class="formRow">
                  <label class="formCell" for="custEmail">Email:</label>
                  <input class="formCell" type="text" name="custEmail" id="custEmail" required>
              </p>
              <p class="formRow">
                  <label class="formCell" for="phone">Phone Number:</label>
                  <input class="formCell" type="tel" name="phone" id="phone" required>
              </p>
            </section>
  
            <h2>COMPANY INFORMATION</h2>
            <p class="formRow">
                <label class="formCell" for="companyName">Company Name:</label>
                <input class="formCell" type="text" name="companyName" id="companyName" required>
            </p>
            
            <p class="formRow">
                <label for="state" class="formCell">State:</label>
                <select class="formCell" name="state" id="state" required>
                    <script src="components/states.js"></script>
                </select>
            </p>
            <p class="formRow">
                <label class="formCell" for="city">City:</label>
                <input class="formCell" type="text" name="city" id="city" maxlength="100" required>
            </p>
            <p class="formRow">
                <label class="formCell" for="street">Street Address:</label>
                <input class="formCell" type="text" name="street" id="street" maxlength="100" required>
            </p>
            <p class="formRow">
              <label class="formCell" for="zipcode">Zip Code:</label>
              <input class="formCell" type="text" name="zipcode" id="zipcode" maxlength="9" required>
          </p>
        </section>

        <section>
            <input type="submit" value="Submit" class="submitButton" id="submitButton">
        </section>
    </form>
    
</body>
`;
home.appendChild(container);