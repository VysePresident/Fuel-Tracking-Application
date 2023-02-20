const home = document.getElementById('home');
const container = document.createElement('div');

container.className = 'container';
container.innerHTML = `
  <link rel="stylesheet" href="./styles/home.css">
  <body class=homebody">
    <section class="bg-about">
      <section class="about">
        <h2>We Are Your Go-To Company For Petroleum!</h2>
        <div class="buy">
          <button type="submit" class="btn-buy">BUY NOW</button>
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
        and propane, to meet the needs of our customers. Our products are
        sourced from reputable suppliers and tested for quality and compliance
        with industry standards.
      </p>
      <a href="about.js">LEARN MORE</a>
    </section>

    <section class="hiring">
      <h2>Join Us</h2> 
      <div class="joinimg">
        <img src="./img/join.jpg" alt="join" />
      </div>
      <p>
        We are always looking for talented individuals to join our team. If you
        are passionate about the fuel industry and are looking for a challenging
        and rewarding career, we would love to hear from you.
      </p>
      <a href="join.js" class="button">APPLY NOW</a>
    </section>

    <section class="contact">
      <h2>Contact Us</h2>
      <p>
        If you have any questions or would like to learn more about our products
        and services, please do not hesitate to contact us.
      </p>
        <a href="contact.js" class="button">CONTACT US</a>
    </section>

  </body>
  

`;
home.appendChild(container);