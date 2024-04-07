<footer class="footer-area bg-dark text-white pt-5 pb-3">
  <div class="container" style="justify-content: center; width: 80%; margin:auto;">
    <div class="flex">
      <!-- About Us -->
      <div class="col-md-3">
        <h5>About Us</h5>
        <p>
          <i class="fas fa-map-marker-alt"></i> Rotopul, Kathmandu<br>
          <i class="fas fa-phone"></i> <a href="tel:+1234567890" class="footer-link">+1234567890</a><br>
          <i class="fas fa-envelope"></i> <a href="mailto:info@example.com" class="footer-link">info@example.com</a>
        </p>
        <a href="your-about-us-link" class="btn btn-outline-light btn-sm">Find More</a>
      </div>

      <!-- Services -->
      <div class="col-md-3">
        <h5>Services</h5>
        <ul class="list-unstyled">
          <li><a href="#">Order Online</a></li>
          <li><a href="#">Table Reservation</a></li>
        </ul>
      </div>

      <!-- Payment Options -->
      <div class="col-md-3">
        <h5>Payment Options</h5>
        <a href="#"><img src="{{asset('img/esewa2.png')}}" alt="eSewa Payment" class="payment-logo"></a> <br>
        <a href="#"><img src="{{asset('img/cod2.png')}}" alt="Cash On Delivery" class="payment-logo" style="height: 35%; width: 60%;"></a>
      </div>

      <!-- Follow Us -->
      <div class="col-md-3">
        <h5>Follow Us</h5>
        <div class="social-icons">
          <a href="#" class="bi bi-facebook"> Facebook</a><br>
          <a href="#" class="bi bi-instagram"> Instagram</a><br>
          <a href="#" class="bi bi-whatsapp"> WhatsApp</a><br>
        </div>
      </div>

      <div class="col-md-3"> <!-- Increased to 'col-md-3' from 'col-md-2' -->
        <h5>Find Us</h5>
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.6773409914187!2d85.32378831506181!3d27.70359573298252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb192d6e52b0bf%3A0xc424dfe7297397ec!2sRatopul%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1646400790917!5m2!1sen!2snp" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
      </div>

    </div> 
  </div>

  <div>
      <h1 class="text-center mt-4">&copy; 2024 Satyam Khatiwada. All rights reserved.</h1>
  </div>
  
</footer>


<style>
  /* Footer styles */
.footer-area {
  margin-top: 2%;
  background-color: #333333;
  color: #ffffff;
  font-family: 'Helvetica Neue', Arial, sans-serif;
  padding-top: 5rem;
  padding-bottom: 1rem;
  width: 100%;
}

.footer-area h5, .footer-area p, .footer-area li, .footer-area a {
  font-size: 16px;
  color: #ffffff;
}

.footer-area a {
  transition: color 0.2s;
  cursor: pointer;
}

.footer-area a:hover {
  color: #ffc107;
  text-decoration: none;
}

.footer-area .btn {
  background-color: transparent;
  color: #ffffff;
  border: 1px solid #ffffff;
}

.footer-area .btn:hover {
  color: #ffc107;
}

.social-icons a, .social-icons img {
  font-size: 16px;
  color: #ffffff;
  width: auto;
  height: 1em;
  vertical-align: middle;
}

.payment-logo, .social-logo {
  width: auto;
  height: 3rem;
  vertical-align: middle;
}

.map-container iframe {
  width: 100%;
  height: 200px;
  border: none;
  border-radius: 4px;
}

.text-center {
  color: #ffffff;
  text-align: center;
}

/* Equal width for each column */
.col-md-3 {
  flex-basis: 25%;
  max-width: 25%;
}

</style>