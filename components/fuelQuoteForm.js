// Get Quote Button Click Event
document.getElementById("getQuoteBtn").addEventListener("click", function (event) {
    event.preventDefault();
    // TESTING TESTING TESTING
    console.log("This is 1");
  
    // Get form values
    var fuelType = document.getElementById("fuelType").value;
    var gallonsRequested = document.getElementById("gallonsRequested").value;
    var deliveryDate = document.getElementById("deliveryDate").value;
  
    // Check if all fields are filled
    if (
      fuelType !== "" &&
      gallonsRequested !== "" &&
      deliveryDate !== ""
    ) {
        // TESTING TESTING TESTING
        console.log("This is 2");

      // Disable Get Quote and Submit Quote buttons
      //document.getElementById("getQuoteBtn").disabled = true;
      //document.getElementById("submitBtn").disabled = true;
  
      // Create data object to send via AJAX
      var data = {
        fuelType: fuelType,
        gallonsRequested: gallonsRequested,
        deliveryDate: deliveryDate,
      };

      // TESTING TESTING TESTING
      console.log("This is 3");
  
      // Make AJAX call to Pricing Module
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "server/pricingModule.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

      // TESTING TESTING TESTING
      console.log("This is 4");

      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

            // TESTING TESTING TESTING
            console.log("This is 5");

          console.log(xhr.responseText) // TESTING TESTING TESTING
          // Parse response JSON
          var response = JSON.parse(xhr.responseText);
  
          // Populate Suggested Price and Total Amount fields
          document.getElementById("suggestedPrice").value = response.suggestedPrice;
          document.getElementById("totalAmount").value = response.totalAmount;

          // TESTING TESTING TESTING
            console.log("This is 6");
  
          // Enable Submit Quote button
          //document.getElementById("submitBtn").disabled = false;
          console.log(response); // TESTING TESTING TESTING
        }
      };
      xhr.send(JSON.stringify(data));
    } else {
      // Show error message if any field is empty
      // TESTING TESTING TESTING
      console.log("This is error#");
      alert("Please fill in all the required fields.");
    }
  });

// Update Get Quote and Submit buttons
const in1 = document.getElementById('fuelType');
const in2 = document.getElementById('gallonsRequested');
const in3 = document.getElementById('deliveryDate');
const in4 = document.getElementById('cash');
const in5 = document.getElementById('credit');
const in6 = document.getElementById('debit');

function checkInputs() {
  if (in1.value && in2.value && in3.value && (in4.checked || in5.checked || in6.checked)) {
    document.getElementById("getQuoteBtn").disabled = false;
    document.getElementById("grayButton").type = "hidden";
    document.getElementById("submitButton").type = "submit";
  } else {
    document.getElementById("getQuoteBtn").disabled = true;
    document.getElementById("grayButton").type = "button";
    document.getElementById("submitButton").type = "hidden";
  }
}

in1.addEventListener('input', checkInputs);
in2.addEventListener('input', checkInputs);
in3.addEventListener('input', checkInputs);
in4.addEventListener('input', checkInputs);
in5.addEventListener('input', checkInputs);
in6.addEventListener('input', checkInputs);