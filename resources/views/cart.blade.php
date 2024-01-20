@auth
<div class="flex" style="text-decoration: none;">
    @include('user.dashboard')

    <div class="content mt-16">
        <h1 class="emp-text">My Shopping Cart</h1>
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
                <h1 class="Summary-text">Summary:</h1>
                <div class="summary-section">
                <p><span class="summary-label">Subtotal:</span> <span class="summary-value">{{ $subtotal }}</span></p>
                <p><span class="summary-label">Estimated Tax:</span> <span class="summary-value">{{ $tax }}</span></p>
                <p><span class="summary-label">Delivery Charge:</span> <span class="summary-value">{{ $delivery }}</span></p>
                <hr>
                <p><span class="summary-label">Total:</span> <span class="summary-value">{{ $subtotal+ $tax + $delivery }}</span></p>
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="checkout-button">Checkout</button>
                </form>
            </div>
            </div>   
        </div>
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

    th, td, td form button, td form {
        padding: 10px;
        text-align: left;
        margin:0;
    }

    th {
        background-color: white;
        color: red;
        border-bottom: 1px solid #ddd;
    }

    .cart-desc{
        color: gray;
        padding: 3px 0px 3px 0px;
    }

    .total{
        width:95%;
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
    }

    .summary-section {
        text-align: left;
    }

    .summary-label {
        display: inline-block;
        width: 120px; /* Adjust the width as needed */
    }

    .summary-value {
        display: inline-block;
        text-align: right;
        width: calc(100% - 120px); /* Adjust the width as needed */
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
        margin: 4px 2px;
        width:100%;
        cursor: pointer;
    }

    .checkout-button:hover {
        background-color: #45a049;
    }

</style>

