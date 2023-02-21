const myButton = document.querySelector("#myButton");
const loadingBarR = document.querySelector("#loadingBar");

navBar.innerHTML = `
<section>
            <div class="loadingBar">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
              </div>
</section>
`

myButton.addEventListener("click", function() {
  if (myDiv.style.display === "none") {
    myDiv.style.display = "block";
  } else {
    myDiv.style.display = "none";
  }
});