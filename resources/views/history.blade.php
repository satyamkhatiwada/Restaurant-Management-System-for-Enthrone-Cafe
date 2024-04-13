@auth
<div class="flex" style="text-decoration: none;">
    @include('user.dashboard')
    <div class="content mt-16">
        <h1 class="emp-text">Order history</h1>
        <div class="history">
            @if($orders->isEmpty())
                <p class="no-items">No Orders placed yet.</p>
            @else
                @foreach($orders as $order)
                <div class="card" id="order-card-{{ $order->id }}">
                    <div class="card-header">
                        Order #{{ $order->id }}
                    </div>
                    <div class="card-body">
                        <p class="p-2">Total Amount: Rs. {{ $order->total_amount }}</p>
                        <p class="flex p-2">Status:
                            @if($order->status == 'pending')
                                <img src="{{ asset('img/pending.png') }}" alt="Pending" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #8B8000;">Pending</span>
                            @elseif($order->status == 'completed')
                                <img src="{{ asset('img/completed.png') }}" alt="Completed" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: green;">Completed</span>
                            @elseif($order->status == 'canceled')
                                <img src="{{ asset('img/cancelled.png') }}" alt="Cancelled" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: red;">Cancelled</span>
                            @elseif($order->status == 'confirmed')
                                <img src="{{ asset('img/confirmed.png') }}" alt="Confirmed" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold;">Confirmed</span>
                            @elseif($order->status == 'processing')
                                <img src="{{ asset('img/processing.png') }}" alt="Processing" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #80FF00;">Processing</span>

                            @elseif($order->status == 'dispatched')
                                <img src="{{ asset('img/dispatched.png') }}" alt="Dispatched" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #FF00FF;">Dispatched</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            @endif

            <div id="order-details" class="order-details">
                <h1>dwehduiwhfwiud</h1>
                @foreach(json_decode($order->items) as $item)
                <li>
                    <strong>{{ $item->{"Item name"} }}</strong> X {{ $item->Quantity }} X {{ $item->Price }} <br>
                </li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endauth

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderCards = document.querySelectorAll('.card');
            const orderDetails = document.getElementById('order-details');
            const body = document.body;

            orderCards.forEach((card) => {
                card.addEventListener('click', function () {
                    const orderId = this.id.split('-')[2]; // Extract the order ID from the card ID
                    // Apply blurred background class to body
                    body.classList.add('blurred-background');

                    // Fetch and display detailed order information for the clicked order
                    orderDetails.innerHTML = `Detailed information for Order #${orderId}`;
                    orderDetails.classList.add('active');


                    // Log a message to the console to verify that the card click event is working
                    console.log('Card clicked:', orderId);
                });
            });

            // Close the detailed order information card when clicking outside of it
            window.addEventListener('click', function (event) {
                if (!event.target.closest('.order-details') && !event.target.closest('.card')) {
                    orderDetails.classList.remove('active');
                    body.classList.remove('blurred-background'); // Remove blurred background class
                }
            });
        });
    </script>




<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding-left: 120px; /* Add padding to the content */
        padding-right: 120px; /* Add padding to the content */
        padding-top: 20px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
        margin-bottom: 1%;
    }

    .history{
        padding:2.5%;
    }

    .card {
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 10px;
    padding: 10px;
    width: 100%;; /* Adjust width as needed */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f0f0f0;
        padding: 8px;
        border-bottom: 1px solid #ccc;
        font-weight: bold;
    }

    .card-body {
        padding: 8px;
    }

    .no-items{
    width: 100%;
    text-align: center;
    padding-top: 10%;
    padding-bottom:8%;
    font-size: 30px;
    color: lightgray;
    }

    /* Hover effect for card */
    .card:hover {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }

    /* Styles for the detailed order information card */
    .order-details {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50%;
        height: 50%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        padding: 20px;
        z-index: 1000;
    }

    .order-details.active {
        display: block;
    }
    
    .blurred-background {
        pointer-events: none; /* Disables pointer events on the background */
    }


</style>

@extends('footer')