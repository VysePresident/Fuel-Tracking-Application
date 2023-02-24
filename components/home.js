const home = document.getElementById('home');
const container = document.createElement('div');

container.className = 'container';
container.innerHTML = `
  <link rel="stylesheet" href="./styles/home.css">
  <body class="homebody">
    <section class="bg-about">
      <section class="about">
        <h2>We Are Your Go-To Company For Petroleum!</h2>
        <div class="buy">
          <a href="./fuelQuoteForm.html" class="btn-buy">BUY NOW</a>
        </div>
      </section>
    </section>

    <section class="promotion">
      <h2>Our Products</h2>
      <div class="images">
        <img src="./img/gasoline.jpg" alt="gasoline" />
        <img src="./img/diesel.jpg" alt="gasoline" />
        <img src="./img/propane.jpg" alt="gasoline" />
      </div>
      
      <p>
        We offer a wide range of fuel products, including gasoline, diesel,
        and propane, to meet the needs of our customers. <br> Our products are
        sourced from reputable suppliers and tested for quality and compliance
        with industry standards.
      </p>
      <div class="btn-about">
        <a href="about.js">LEARN MORE</a>
      </div>
    </section>

    <section class="hiring">
      <div class=join-container>
        <div class="join-img">
          <img src="./img/join.jpg" alt="join" />
        </div>
        <div class="join-info">
          <div class="join-text">
            <h2>Join Us</h2>
            <p>
            We are always looking for talented individuals to join our team. <br> If you are passionate about the fuel industry <br> and are looking for a challenging and rewarding career, we would love to hear from you.
            </p>
          </div>
          <div class="btn-join">
            <a href="join.js">APPLY NOW</a>
          </div>
        </div>
      </div>
    </section>

    <section class="contact">
      <h2>Contact Us</h2>
      <p>
        When you choose Gas Co., you can take advantage of the 24/7 support provided by our team of Operations & <br> Service Specialists. We are always available to ensure that your fuel requirements are fulfilled.
      </p>
      <div class="btn-contact">
        <a href="./contact.html">CONTACT US</a>
      </div>
    </section>

  </body>
  

`;
home.appendChild(container);