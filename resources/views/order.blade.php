@auth
    <div class="flex" style="text-decoration: none;">
        @include('user.dashboard')

        <div class="content mt-16">
            <h1 class="emp-text">Order details</h1>

            <form id="order-form" action="{{ route('order.create') }}" method="POST">
            @csrf
                <div class="flex w-95">
                    <div class="invoice-section card">
                        <h1 class="bill-text">Billing details</h1>

                        <div class="mb-4">
                            <div class="flex justify-between">
                                <div class="w-33">
                                    <label for="name" class="label">Name: <span style="color: red;">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ Auth::user()->name}}" class="input" readonly>
                                </div>

                                <div class="w-33">
                                    <label for="email" class="label">Email: <span style="color: red;">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ Auth::user()->email}}" class="input" readonly>
                                </div>

                                <div class="w-33">
                                    <label for="phone" class="label">Phone number: <span style="color: red;">*</span></label>
                                    <input type="tel" name="phone_number" id="phone" class="input" placeholder="Enter phone number" required>
                                    @error('phone')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <label for="delivery_address" class="label">Delivery Address: <span style="color: red;">*</span></label>
                            <input type="text" name="delivery_address" id="delivery_address" placeholder="Add delivery address" required class="input">

                            <label for="landmark" class="label">Nearest landmark: <span style="color: red;">*</span></label>
                            <input type="text" name="landmark" id="landmark" placeholder="Enter description of nearest landmark" class="input" required>

                            <input type="hidden" name="total_amount"  value={{$total_amount}}>
                            <input type="hidden" name="items" 
                                value="{{ json_encode($cartItems->map(function($item) {
                                    return [
                                        'Item name' => $item->menuItem->name,
                                        'Price' => $item->menuItem->price,
                                        'Quantity' => $item->quantity,
                                        'Total Price'=> $item->menuItem->price*$item->quantity
                                    ];
                                    })) 
                                }}">


                            <input type="hidden" name="payment_method" id="payment_method" value="">

                        </div>
                        <table class="product-section">
                            <tr>
                                <th class="product-label">Product</th>
                                <th class="product-value">Sub Total</th>
                            </tr>
                            @foreach($cartItems as $cartItem)
                            <tr>
                                <td class="product-label">{{ $cartItem->menuItem->name }} x {{$cartItem->quantity}}</td>
                                <td class="product-value">{{ $cartItem->menuItem->price * $cartItem->quantity }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th class="product-label">Estimated Tax:</th>
                                <td class="product-value">{{$tax}}</td>
                            </tr>
                            <tr>
                                <th class="product-label">Delivery Charge:</th>
                                <td class="product-value">{{$delivery}}</td>
                            </tr>

                            <tr>
                                <th class="product-label">Total:</th>
                                <td class="product-value">{{$total_amount}}</td>
                            </tr>
                        </table>

                    </div>


                    <div class="payment-section card">
                        <h1>Choose a payment method</h1>
                        <div class="payment-method">
                            <button type="submit" class="payment-method-button" id="cashOnDeliveryBtn">
                                <div class="flex"><img src="img/cod.jpg" alt="cash-on-delivery"><span class="cod pay">Cash On Delivery</span></a>
                            </button> 

                            <button type="submit" class="payment-method-button" id="esewaBtn">
                                <div class="flex"><img src="img/esewa.png" alt="esewa"><span class="esewa pay">Pay via esewa</span></a>
                            </button> 

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endauth


<script>
    document.addEventListener("DOMContentLoaded", function () {
    var cashOnDeliveryBtn = document.getElementById("cashOnDeliveryBtn");
    var esewaBtn = document.getElementById("esewaBtn");

    cashOnDeliveryBtn.addEventListener("click", function (event) {
        event.preventDefault();

        // Retrieve input field values
        var phone = document.getElementById("phone").value;
        var deliveryAddress = document.getElementById("delivery_address").value;
        var landmark = document.getElementById("landmark").value;

        // Check if all required fields are filled
        if (!phone || !deliveryAddress || !landmark) {
            alert("Please fill all required fields.");
            return;
        }

        // Set the payment method value for Cash on Delivery
        var paymentMethodInput = document.getElementById("payment_method");
        paymentMethodInput.value = "Cash On Delivery";

        // Submit the form
        var orderForm = document.getElementById("order-form");
        orderForm.submit();
    });

    esewaBtn.addEventListener("click", function (event) {
        event.preventDefault();

        // Retrieve input field values
        var phone = document.getElementById("phone").value;
        var deliveryAddress = document.getElementById("delivery_address").value;
        var landmark = document.getElementById("landmark").value;

        // Check if all required fields are filled
        if (!phone || !deliveryAddress || !landmark) {
            alert("Please fill all required fields.");
            return;
        }

        // Set the payment method value for eSewa
        var paymentMethodInput = document.getElementById("payment_method");
        paymentMethodInput.value = "eSewa";

        // Submit the form
        var orderForm = document.getElementById("order-form");
        orderForm.action = "{{ route('esewa.callback') }}"; // Set the action to eSewa callback route
        orderForm.submit();
        });
    });

</script>



<style>
    .flex {
        display: flex;
    }

    .w-95{
        width: 95%;
        margin: auto;
    }

    .w-33{
        width: 33%;
    }

    form{
        width: 100%;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    .bill-text {
        font-size: 16px;
        color: red;
        font-weight: bolder;
        margin-bottom:10px;
    }

    .invoice-section{
        margin-top: 20px;
        padding: 20px;
        width:60%;
        margin-right:15px;
    }

    .payment-section{
        width:40%;
        margin-top: 20px;
        padding: 20px;
    }

    .payment-section h1{
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: red;
    }

    .product-section{
        width:50%;
        margin: auto;
    }

    .product-section tr{
        font-size:12px;
        border-bottom: 1px solid red;
    }    

    .product-label {
        padding: 12px;
        text-align:left;
    }

    .product-value {
        padding:12px;
        text-align: right;
    }

    .label {
        padding:5px;
        display: block;
        font-size: 16px;
        font-weight:bold;
        color: #555;
        margin-bottom: 5px;
    }

    .input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom:10px;
    }

    .card{
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .payment-method{
        width:80%;
        margin:auto;
    }

    .payment-method-button{
        border: 1px solid gray;
        margin-top: 20px;
        border-radius: 10px;
    }

    .payment-method img{
        padding:5px;
        width: 16%;
    }

    .pay{
        width:100%;
        margin:auto;
        font-size: 18px;
        font-weight: bolder;
    }

    .esewa{
        color: green;
    }

    .cod{
        color: gray;
    }

    .pay:hover{
        font-size: 20px;
        transition: 0.2s;
    }

</style>