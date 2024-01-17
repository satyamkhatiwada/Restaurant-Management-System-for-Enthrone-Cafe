<div class="flex" style="text-decoration: none;">
  @if (auth()->check())
    @include('user.dashboard')
  
  @else
    @include('guestdashboard')

  @endif

  <div class="slideshow-container">
    <div class="mySlides fade">
      <div class="numbertext mt-16">1 / 3</div>
      <img src="img/food.jpeg" style="width:100%; height: 100vh; object-fit: cover;  filter: brightness(50%);">
      <div class="text">There's nothing to think of because we serve<br><span style="color: #FF4500;"> everything you wished for</span></div>
      <div class="content-button">
        <a href="{{ route('menu') }}">
            <button>View our menu</button>
        </a>
      </div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext mt-16">2 / 3</div>
        <img src="img/burger.jpeg" style="width:100%; height: 100vh; object-fit: cover; filter: brightness(50%);">
        <div class="text">Caption Two</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext mt-16">3 / 3</div>
        <img src="img/f.jpeg" style="width:100%; height: 100vh; object-fit: cover; filter: brightness(50%);">
        <div class="text">Caption Three</div>
    </div>

    <div class="dots" style="text-align: center;">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span>
    </div>
  </div> 
</div>

  <!-- Your HTML code -->

<script>
  let slideIndex = 0;
  showSlides();

  function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");

    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
      dots[i].classList.remove("active");
    }

    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";

    // Add active class to the corresponding dot
    dots[slideIndex - 1].classList.add("active");

    setTimeout(showSlides, 5000); // Change image every 5 seconds
  }
</script>


<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  width: 100%;
  position: relative;
}

/* Caption text */
.text {
  color: white;
  font-size: 30px;
  font-weight: bolder;
  padding: 8px 12px;
  position: absolute;
  bottom: 45%;
  width: 100%;
  text-align: center;
}

.content-button {
  color: white;
  font-size: 12px;
  font-weight: bolder;
  padding: 8px 12px;
  position: absolute;
  bottom: 40%; /* Adjust the percentage for vertical positioning */
  left: 50%; /* Set left to 50% to center horizontally */
  transform: translateX(-50%); /* Move it back by half of its own width */
  background-color: red; /* Change the background color to red */
}

.content-button:hover{
  background-color: transparent;
  border: 1px solid red;
  transition: 0.2s;
}

/* Number text (1/3 etc) */
.numbertext {
  color: white;
  font-weight: bolder;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

.dots {
  position: absolute;
  bottom: 10px; /* Adjust the value as needed */
  left: 50%;
  transform: translateX(-50%);
}

.dot {
  height: 10px;
  width: 10px;
  background-color: gray;
  border-radius: 50%;
  display: inline-block;
  margin: 0 4px; /* Adjust the value as needed */
  transition: background-color 0.6s ease;
}

.active {
  background-color: black;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}