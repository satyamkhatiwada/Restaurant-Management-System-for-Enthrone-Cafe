<script>
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
</script>
<div class="" style="text-decoration: none;">
  @if (auth()->check())
    @include('user.dashboard')
  
  @else
    @include('guestdashboard')
  @endif

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">

  <section>

    <div class="container">
        <!-- First card -->
        <div class="card">
            <img src="{{ asset('img/Welcome2.jpg') }}" alt="Low Width Image" style="border: 1px solid black;">
        </div>

        <!-- Second card with updated content -->
        <div class="card" style="flex: 2; border-radius: 15px;">
            <div class="centered-text">
                <h1 style="font-size: 35px">Delicious food for every mood</h1>
                <a href="{{ route('menu') }}"><button class="order-button">Order Now &rarr;</button></a>
            </div>
            <div id="slideshow" class="slideshow">
                <img src="{{ asset('img/aibu.png') }}" alt="Slide 1">
                <img src="{{ asset('img/bentobg.png') }}" alt="Slide 3">
                <img src="{{ asset('img/pizzabg.png') }}" alt="Slide 4" style="width: 500px; height: 550px; padding-left: 50px;">
                <img src="{{ asset('img/Beer bg.png') }}" alt="Slide 2" style="width: 500px; height: 550px;">
            </div>
        </div>
                
    </div>
    <!-- Marquee below the container -->
    <div class="marquee">
        <div class="marquee-content">
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
            <!-- Repeat the content for continuous animation -->
            <span>Most Trusted</span>
            <span>Fastest Growing</span>
            <span>Highest Rated</span>
            <span>Fast Delivery</span>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <img src="{{ asset('img/award.png') }}" alt="" srcset="" style="max-width: 1100px; height: auto; margin: 0 auto; padding: 10px;">
        </div>
    </div>

    <!-- reserve table -->
    <div class="dual-card-container">
        <!-- Part 1: Styled table centered in 50% of the screen -->
        <div class="res">
            <div class="table-wrapper">
                <table class="styled-reserve-table">
                    <tr>
                        <th>Join us for Dinner</th>
                    </tr>
                    <tr>
                        <td>
                            <p>Treat yourself to a wonderful dining experience with a menu that promises to delight your taste buds. Reserve your table now and enjoy exceptional culinary delights!</p>
                            @if (auth()->check()&& !auth('waiter')->check())
                              <a href="{{ route('booking') }}" class="btn btn-primary btn-sm reserve-button" style="font-family: 'Poppins', sans-serif;">Reserve &rarr;</a>
                            @else
                              <a href="{{ route('login') }}" class="btn btn-primary btn-sm reserve-button" style="font-family: sans-serif, poppins">Reserve &rarr;</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div> 
        
        <!-- Part 2: Image taking 50% of the width -->
        <div class="res-img">
            <img src="{{ asset('img/reserved.png') }}" alt="Reserve a Seat">
        </div>
    </div>

    <!-- About us -->
    <div class="dual-card-container">
        <div class="new-card">
            <img src="{{ asset('img/burger.jpg') }}"  alt="Website Image">
        </div>
        <div class="new-card" style="background-color: #ff0000; height: 467px; color: #fff;">
            <th style="font-family: 'Poppins', sans-serif; color: black; font-size: 30px;">Learn More</th>
            <p style="font-family: 'Poppins', sans-serif; margin-bottom: 10px;">Enthrone offers a diverse range of cuisines, catering to various tastes and occasions. Whether it's for a casual meal or a special event, we provide options to suit every need. From corporate gatherings to intimate parties, you can rely on us to make your event memorable.
                <br> <br>
                At Enthrone, we prioritize customer satisfaction above all else. Our dedicated team ensures that every aspect of your experience with us is exceptional. Whether you're ordering food online or making advanced reservations, we strive to exceed your expectations.
                <br> <br>
                Contact us today to explore our catering menu options, inquire about event catering, or reserve a table for your next dining experience. Let us take care of the details while you focus on enjoying delicious food and creating lasting memories.
            </p>
            <a href="{{route('about')}}" class="btn btn-primary btn-sm fancy-btn" style="font-family: 'Poppins', sans-serif;float: right;">About us &rarr;</a>
        </div>
    </div>

    <!-- testomonials -->
    <div class="testimonial-heading">
        <h2>What Our Customers Say</h2>
    </div>


    <div class="testimonial-grid-container">
        
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="{{ asset('img/t1.png') }}" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Ramita Rai</h3>
                <p class="testimonial-role">Baluwatar Kathmandu</p>
                <p class="testimonial-text">"Absolutely delicious! Every bite was a flavor explosion."</p>
            </div>
        </div>
   
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="{{ asset('img/t4.png') }}" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Rasbari Khatiwada</h3>
                <p class="testimonial-role">Jhamsikhel, Lalitpur</p>
                <p class="testimonial-text">"Fantastic service and mouthwatering dishes. A must-visit!"</p>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="img/t3.png" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Namita Chakkar</h3>
                <p class="testimonial-role">Jawalakhel, Lalitpur</p>
                <p class="testimonial-text">"Exquisite cuisine and a charming ambiance. Perfect for any occasion."
                </p>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="img/t6.png" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Damodar Lohani</h3>
                <p class="testimonial-role">Naxal, Kathmandu</p>
                <p class="testimonial-text">"Simply divine! Can't wait to come back for more."</p>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="img/t5.png" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Rameshwor  Karki</h3>
                <p class="testimonial-role">Maharajgunj, Kathmandu</p>
                <p class="testimonial-text">"Top-notch quality and unparalleled taste. Highly recommended!"</p>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-image">
                <img src="img/t2.png" alt="Person's Name">
            </div>
            <div class="testimonial-info">
                <h3 class="testimonial-name">Sita Gupta</h3>
                <p class="testimonial-role">Lazimpat, Kathmandu</p>
                <p class="testimonial-text">"Fresh ingredients and impeccable presentation. 5 stars!"
                </p>
            </div>
        </div>
    </div>

  </section>

</div>

<script>
        // Slideshow functionality
        var images = document.getElementById("slideshow").getElementsByTagName("img");
        var currentIndex = 0;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % images.length;
            for (var i = 0; i < images.length; i++) {
                images[i].style.display = "none";
            }
            images[currentIndex].style.display = "block";
        }

        setInterval(nextSlide, 3500); // Change image every 3.5 seconds
</script>

<style>
  section {
    font-family: 'Satisfy', cursive;
    margin: 0;
    overflow-x: hidden;
  }
  .container {
    display: flex;
    max-width: 100%;
    padding: 20px;
  }
  .card {
    flex: 1;
    border: 0px solid #ccc;
    display: flex; /* Display as flex container */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 550px; /* Set a specific height for both cards */
    position: relative;
    margin-top: 40px;
  }
  /* Set max width and max height for images inside cards */
  .card img {
    max-width: 100%;
    max-height: 100%;
    height: auto;
  }
  .card:nth-child(2) {
    background: linear-gradient(to bottom, rgb(186, 198, 205), rgb(198, 143, 16));
    position: relative;
    overflow: hidden;
  }

    /* Fancy button styles */
  .order-button {
    margin-top: 10px;
    position: absolute;
    bottom: 210x;
    left: 13%;
    transform: translateX(-50%);
    background-color: rgb(226, 22, 22); /* Yellow color */
    color: rgb(255, 255, 255);
    border: none;
    cursor: pointer;
    padding: 10px 20px; /* Adjusted padding */
    font-size: 18px; /* Adjusted font size */
    font-family: poppins;
    border-radius: 20px; /* Adjusted border radius */
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }
  .order-button:hover {
    background-color: rgb(255, 115, 0); /* Lighter yellow color on hover */
    box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
    transform: translate(-50%, -5px);
  }

    /* Centered text */
  .centered-text {
    text-align: center;
    margin-bottom: 20px;
  }

  /* Marquee style */
  .marquee {
    margin-top: 20px;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
  }

  .marquee-content {
    white-space: nowrap;
    display: block;
    /* Ensure the animation runs smoothly and continuously */
    animation: marquee 20s linear infinite;
    animation-delay: -15s;
  }

  .marquee-content span {
    font-size: 34px; /* Larger font size */
    padding-right: 50px; /* Adjust spacing between phrases */
  }

  .marquee-content span:nth-child(odd) {
      font-family: 'Satisfy', cursive;
  }
    .marquee-content span:nth-child(even) {
        font-family: 'Silkscreen', monospace;
    }
    /* Continuous Marquee Animation */
    @keyframes marquee {
        0% { transform: translateX(10%); }
        100% { transform: translateX(-100%); }
    }

    .dual-card-container {
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .new-card {
    flex: 1;
    border: 0px solid #ccc;
    padding: 20px 20px;
    margin: 0 -10px;
    }

    .new-card img {
        /* max-width: 60%; */
        width: 740px;
        height: 467px;
        display: block;
    }

    /* about us btn */
    .fancy-btn {
    background-color: #000000;
    color: #ffffff;
    border: 2px solid #ff6f61;
    border-radius: 20px;
    padding: 5px 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    }

    .fancy-btn:hover {
        background-color: #f5796e;
        color: #ffffff;
    }
    /* Container for table to help with centering */
    .table-wrapper {
        max-width: 80%; /* Table container takes up to 50% of the parent width */
        margin: auto; /* Center the table container within the .res div */
    }

    .res {
        flex-basis: 50%; /* Allocate 50% of the space to the table container */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px; /* Adjust padding as needed */
    }

    .styled-reserve-table {
        border-collapse: collapse;
        width: 100%; /* The table itself will take up 100% of the .table-wrapper */
    }

    .styled-reserve-table th,
    .styled-reserve-table td {
        border: 1px solid #ccc;
        text-align: center;
        padding: 20px;
    }

    .styled-reserve-table th {
        font-family: 'Satisfy', cursive;
        font-size: 30px; /* Match this size to your design */
    }

    .styled-reserve-table td p {
        margin-bottom: 20px;
        font-size: 20px; /* Match this size to your design */
    }

    .reserve-button {
        background-color: #f5796e;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px; /* Match this size to your design */
        border-radius: 30px; /* Rounded corners */
    }

    .reserve-button:hover {
        background-color: #000000;
    }

    .res-img {
        flex-basis: 50%; /* Allocate 50% of the space to the image container */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .res-img img {
        width: 100%; /* Image will take the full width of its container */
        height: auto; /* Maintain aspect ratio */
    }
    /* testomonials */
    .testimonial-heading {
        text-align: center;
        margin-bottom: 30px;
        margin-top: 70px;
    }

    .testimonial-heading h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 24px; /* Adjust size as needed */
        font-weight: bold;
        color: #333; /* Adjust color as needed */
    }

    /* Apply Poppins font to testimonial text */
    .testimonial-text {
        font-family: 'Poppins', sans-serif;
    }
    .testimonial-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 columns */
        grid-gap: 20px; /* spacing between cards */
        padding: 20px;
        max-width: 1200px; /* Adjust the max-width as needed */
        margin: 0 auto; /* Center the grid in the page */
    }

    .testimonial-card {
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 5px; /* Optional: for rounded corners */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .testimonial-image img {
        border-radius: 50%; /* Circular images */
        width: 100px; /* Adjust as needed */
        height: 100px; /* Adjust as needed */
        object-fit: cover;
        margin-bottom: 10px;
    }

    .testimonial-info {
        text-align: center;
    }

    .testimonial-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .testimonial-role {
        font-style: italic;
        color: #777;
        margin-bottom: 10px;
    }

  .testimonial-text {
    font-size: 14px;
    line-height: 1.4;
  }

</style>

@extends('footer')

