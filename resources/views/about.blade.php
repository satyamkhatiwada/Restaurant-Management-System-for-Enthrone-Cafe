
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Our Story and Team</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>
    <div class="" style="text-decoration: none;">
      @if (auth()->check())
        @include('user.dashboard')
    
      @else
        @include('guestdashboard')
      @endif

       
            <div class="background-image">
                <img src="img/Enthrone outdoor.png" alt="Background Image">
                <div class="background-overlay"></div>
                <div class="background-image-text">
                    <div class="our-story-section">
                        <h2 class="our-story-heading">Our Story</h2>
                    </div>
                    Enthrone Cafe was established in 2023 with the aim of providing luxurious and delicious foods. In January 2024, Enthrone also launched its Car and Wash service, striving to offer more than just exquisite cuisine.
                </div>
            </div>
            <div class="container">

                <div class="our-team-section">
                    <h2 class="our-team-heading">Meet Our Team</h2>
                    <div class="our-team-content">
                        <!-- Team member cards -->
                        <div class="team-member-card">
                            <div class="team-member-image">
                                <img src="img/pranav.png" alt="Team Member Name">
                            </div>
                            <div class="team-member-info">
                                <h3 class="team-member-name">Mr. Pranab Sigdel</h3>
                                <p class="team-member-role">Owner | Automobile Enthusiast</p>
                                <p class="testimonial-text">I did my masters in the Automobile industry in Dubai. I am really fond of different varieties of foods and machines.</p>
                            </div>
                        </div>
                        <div class="team-member-card">
                            <div class="team-member-image">
                                <img src="img/pujanrai.png" alt="Team Member Name">
                            </div>
                            <div class="team-member-info">
                                <h3 class="team-member-name">Mr. Pujan Rai</h3>
                                <p class="team-member-role">Head Chef</p>
                                <p class="testimonial-text">Cooking is my passion since I was a child. I have been a Chef for the past 10 years. <br><br> </p>
                            </div>
                        </div>
                        <div class="team-member-card">
                            <div class="team-member-image">
                                <img src="img/sabin.png" alt="Team Member Name">
                            </div>
                            <div class="team-member-info">
                                <h3 class="team-member-name">Mr. Sabin Karki</h3>
                                <p class="team-member-role">Admin</p>
                                <p class="testimonial-text">I have been working in Restaurant Insdustry since past 8 years. I have skill to run a restaurant.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</body>

<style>
    .our-story-heading, .our-team-heading {
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }
    .our-team-content {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    .team-member-card {
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
        width: 300px; /* Adjust width as needed */
    }
    .team-member-image img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .team-member-info {
        text-align: center;
    }
    .team-member-name {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .team-member-role {
        font-style: italic;
        color: #777;
        margin-bottom: 10px;
    }
    /* Background image */
    .background-image {
        position: relative;
        text-align: center;
        color: white;
    }
    .background-image img {
        width: 100%;
        height: auto;
        filter: brightness(50%);
    }
    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(46, 44, 44, 0.5); /* Adjust opacity as needed */
    }
    .background-image-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-family: poppins;
        z-index: 1; /* Ensure text is on top of overlay */
    }
</style>

@extends('footer')
