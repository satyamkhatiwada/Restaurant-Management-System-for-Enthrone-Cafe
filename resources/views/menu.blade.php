<div class="flex" style="text-decoration: none;"> 
    @if (auth()->check())
        @include('user.dashboard')
    @else
        @include('guestdashboard')

    @endif

    <div class="content mt-16">
        <img src="img/menu.webp" style="width:100%; height: 45vh; object-fit: cover;  filter: brightness(50%); position: relative;">
        <h1 class="emp-text">Our Menu</h1>
        <div class="category-container">
            <a href="{{route('menu')}}" class="category-btn" data-category="all">All</a>
            @foreach($categories as $category)
                <a href="#" class="category-btn" data-category="{{ $category->id }}">{{ $category->category }}</a>
            @endforeach
        </div>
        <div class="row">
            @foreach ($menuItems as $menuItem)
                <div class="col-md-4 mb-3" data-category="{{ $menuItem->category_id }}">
                    <div class="card flex">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menuItem->name }}</h5>
                            <p class="card-text desc">{{ $menuItem->description }}</p><br>
                            <p class="card-text price">Price: {{ $menuItem->price }}</p>
                            <!-- <a href="#" class="btn">Order Now</a>
                            <a href="#" class="btn">Add to Cart</a> -->
                        </div>
                        <img src="{{ asset('storage/' . $menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}">
                        @if(auth()->check())
                            <form action="{{ route('cart.add', ['menuItemId' => $menuItem->id]) }}" method="POST">
                                @csrf
                                <!-- Your form fields and submit button go here -->
                                <button type="submit">
                                    <a href="{{ route('cart.add', ['menuItemId' => $menuItem->id]) }}">
                                        <img src="img/plus.png" class="add-to-cart" alt="">
                                    </a>
                                </button>
                            </form>

                        @else
                            <!-- Display link to login for guest users -->
                            <a href="{{ route('login') }}">
                                <img src="img/plus.png" class="add-to-cart" alt="">
                            </a>
                        @endif
                        <div class="card-overlay"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<!-- </div> -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryButtons = document.querySelectorAll('.category-btn');
        const menuItems = document.querySelectorAll('.col-md-4');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedCategoryId = button.getAttribute('data-category');

                menuItems.forEach(item => {
                    const itemCategoryId = item.getAttribute('data-category');
                    item.style.display = selectedCategoryId === 'all' || selectedCategoryId === itemCategoryId ? 'flex' : 'none';
                });
            });
        });
    });
</script>

<style>
    .flex {
        display: flex;
    }

    .category-container {
        display: flex;
        gap: 10px; /* Adjust the gap as needed for equal spacing */
        justify-content: center; /* Center the categories horizontally */
        margin-top: 20px; /* Adjust the margin as needed */
    }

    .category-btn {
        display: inline-block;
        padding: 10px 20px; /* Adjust padding as needed */
        background-color: #fff; /* Set the background color */
        color: #333; /* Set the text color */
        text-decoration: none;
        border: 1px solid #ddd; /* Set the border color */
        border-radius: 8px; /* Adjust border-radius for rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow for a shadow effect */
        transition: transform 0.2s ease-in-out;
    }

    .category-btn:hover {
        transform: scale(1.05); /* Add a slight scale effect on hover */
    }

    .content {
        width: 100%;
        flex: 1;
        /* padding: 16px; */
    }

    .emp-text {
        font-size: 28px;
        color: White;
        padding-left: 18px;
        font-weight: bold;
        position: absolute;
        top:48%;
    }

    .row {
        display: flex;
        padding: 16px;
        flex-wrap: wrap;
        /* margin: -15px; Adjust margin to create gaps between cards */
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        padding: 15px; /* Adjust padding to create gaps between cards */
    }

    .card-title{
        font-weight: bold;
    }

    .desc{
        /* width:60%; */
        font-size:10px;
        color:gray;
    }

    .price{
        font-size:14px;
        font-weight: bold;
        color: green;
    }

    .card {
        height: 22vh;
        display: flex;
        position: relative;
        border: none;
        overflow: hidden;
        transition: transform 0.3s;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background: rgba(0, 0, 0, 0.5); */
        z-index: 1;
        border-radius: 10px; /* Rounded corners for overlay */
    }

    .card .card-img-top {
        width: 40%;
        height: 18vh;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        right: 0; /* Align to the right */
        transform: translateY(-50%);
        margin-right:5px;
    }

    .add-to-cart {
        position: absolute;
        top: 0;
        right: 0;
        margin-top:2%;
        width: 40px; /* Adjust width as needed */
        height: 40px; /* Adjust height as needed */
        border: 2px solid #fff; /* Set border properties */
        border-radius: 10px; /* Adjust border-radius for rounded corners */
        background-color: rgba(255, 255, 255, 0.8); /* Set background color with opacity */
        box-sizing: border-box; /* Include border in width/height calculations */
        padding: 10px; /* Adjust padding as needed */
        z-index: 2; /* Ensure the "plus" image is above the card content */
    }

    .add-to-cart img {
        width: 100%; /* Ensure the image fills the square container */
    }

    .add-to-cart:hover{
        width:45px;
        height:45px;
        transition:0.2s;
    }

    .card-body {
        width: 60%;
        /* flex: 1; */
        padding: 20px; /* Adjust padding as needed */
        z-index: 2;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card .btn {
        background-color: #04AA6D;
        color: white;
        border: none;
        margin-right: 5px;
    }

    .card .btn:hover {
        background-color: white;
        border: 1px solid #04AA6D;
        color: black;
    }
</style>