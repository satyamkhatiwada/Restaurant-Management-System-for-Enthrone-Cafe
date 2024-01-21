@auth
<div class="flex" style="text-decoration: none;">
    @include('user.dashboard')

    <div class="content mt-16">
        <h1 class="emp-text">My Shopping Cart</h1>
        @if(count($cartItems) > 0)
        <div class="flex">
            <div class="w-60">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th> <!-- Add a column for actions (e.g., remove item) -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1; // Initialize the serial number
                            $subtotal = 0; 
                            $tax = 0;
                            $delivery = 100;
                        @endphp
                        @foreach($cartItems as $cartItem)
                            <tr>
                                <td>{{$sn++}}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $cartItem->menuItem->image) }}" alt="{{ $cartItem->menuItem->name }}" style="width: 300px;">
                                </td>
                                <td>{{ $cartItem->menuItem->name }} <br> <p class="cart-desc">{{ $cartItem->menuItem-> description}}</p></td>
                                <td>{{ $cartItem->menuItem->price }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('patch')

                                        <div class="flex items-center">
                                            <button type="submit" name="quantity" value="{{ $cartItem->quantity - 1 }}" {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                            <span class="mx-2">{{ $cartItem->quantity }}</span>
                                            <button type="submit" name="quantity" value="{{ $cartItem->quantity + 1 }}">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $cartItem->menuItem->price * $cartItem->quantity }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="img/deleteitem.png" alt="remove" class="w-4 h-4"></button>
                                    </form>
                                </td>
                            </tr>
                            @php
                            // Calculate and accumulate subtotal for each item
                            $subtotal += $cartItem->menuItem->price * $cartItem->quantity;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            
                <h1 class="total">Total: {{ $subtotal }}</h1>
            </div>
            <div class="w-40">
                <h1 class="Summary-text">Order Summary:</h1>
                <table class="summary-section">
                    <tr>
                        <th class="summary-label">Sub-total:</th>
                        <td class="summary-value">{{ $subtotal }}</td>
                    </tr>
                    <tr>
                        <th class="summary-label">Estimated Tax:</th>
                        <td class="summary-value">{{$tax}}</td>
                    </tr>
                    <tr>
                        <th class="summary-label">Delivery Charge:</th>
                        <td class="summary-value">{{$delivery}}</td>
                    </tr>
                </table>
                <table class="summary-section-total">
                    <tr>
                        <th class="summary-label">Estimated Total:</th>
                        <td class="summary-value">{{ $subtotal+ $tax + $delivery }}</td>
                    </tr>
                </table>
                <a href="{{route('checkout')}}">
                    <button type="submit" class="checkout-button">Checkout (Rs. {{ $subtotal+ $tax + $delivery }})</button>
                </a>
            </div>   
        </div>
        @else
        <p class="no-items">No Items in the cart</p>
        @endif
    </div>
</div>
@else
    <p>ytytd</p>
@endauth

<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    /* Add some styling for the table, adjust as needed */
    .table {
        border-collapse: collapse;
        margin-top: 20px;
        border-bottom: 1px solid #ddd;
    }

    .table th, .table td, .table td form button,.table td form {
        padding: 10px;
        text-align: left;
        margin:0;
    }

    .table th {
        background-color: white;
        color: red;
        border-bottom: 1px solid #ddd;
    }

    .cart-desc{
        color: gray;
        padding: 3px 0px 3px 0px;
    }

    .total{
        width:90%;
        padding-top:5px;
        text-align: right;
        font-weight: bold;
    }

    .w-60{
        width:60%;
    }

    .w-40{
        width:40%;
        margin-top: 20px;
        padding-top:20px;
        padding-left:5%;
    }

    .Summary-text{
        font-weight:bold;
        text-align: left;
        font-size:18px;
        padding-bottom: 10px;
    }

    .summary-section, .summary-section-total {
       width:90%;
    }

    .summary-section{
        border-bottom: 1px solid #ddd;
    }

    .summary-label {
        padding: 10px;
        text-align:left;
    }

    .summary-value {
        padding:10px;
        text-align: right;
    }

    .checkout-button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 2px;
        width:90%;
        cursor: pointer;
    }

    .checkout-button:hover {
        background-color: #45a049;
    }

    .no-items{
        width: 100%;
        text-align: center;
        padding-top: 10%;
        font-size: 30px;
        color: lightgray;
    }

</style>

