<div class="flex" style="text-decoration: none;"> 
    @include('waiter.dashboard')
    
    <div class="content mt-16">
        <h1 class="emp-text">Order for: {{ $table->name }}</h1>
        <div class="category-container">
            <a href="#" class="category-btn" data-category="all">All</a>
            @foreach($categories as $category)
                <a href="#" class="category-btn" data-category="{{ $category->id }}">{{ $category->category }}</a>
            @endforeach
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Item</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1; // Initialize the serial number
                        $subtotal = 0; 
                    @endphp

                    @foreach($menuItems as $menuItem)
                        @php
                            // Calculate subtotal for each item
                            $subtotalItem = $menuItem->price * 1; // Default quantity is 1
                        @endphp
                        <tr class="menu-item" data-category="{{ $menuItem->category_id }}">
                            <td>{{ $sn++ }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" style="width: 100px;">
                            </td>
                            <td>{{ $menuItem->name }}</td>
                            <td>{{ $menuItem->price }}</td>
        
                            <td>
                                <div class="flex items-center">
                                    <button type="button" class="quantity-btn" data-action="decrease">-</button>
                                    <span class="mx-2 quantity">1</span>
                                    <button type="button" class="quantity-btn" data-action="increase">+</button>
                                </div>
                            </td>
                            <td class="total-price">{{ $subtotalItem }}</td>
                            <td>
                                <button class="btn btn-primary book-btn">
                                    Add
                                </button>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
            <!-- <h1 class="subtotal">Total: {{ $subtotal }}</h1> -->
            <div class="order-summary">
                <h2 class="order-summary-title emp-text">Order Summary</h2>
                <ul class="order-list" id="orderList">
                </ul>
                <br>
                <hr>
                
                <div id="orderTotal"> 0.00</div>
                <form action="{{ route('waiter.createOrder', ['id' => $table->id])}}" method="POST" class="waiterOrder-form">
                    @csrf
                
                    <input type="hidden" name="items" id="orderItemsInput">
                    <input type="hidden" name="total_amount" id="orderTotalInput">
                    <button type="submit" class="btn btn-primary book-btn">
                        Confirm Order
                    </button>
                </form>

                
            </div>
        </div>
        
    </div>
    
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryButtons = document.querySelectorAll('.category-btn');
        const menuItems = document.querySelectorAll('.menu-item');
        const quantityButtons = document.querySelectorAll('.quantity-btn');
        const bookButtons = document.querySelectorAll('.book-btn');
        const orderList = document.getElementById('orderList');
        const orderTotal = document.getElementById('orderTotal');
        const orderTotalInput = document.getElementById('orderTotalInput');
        const orderItemsInput = document.getElementById('orderItemsInput'); // Corrected variable name

        let totalAmount = 0;

        bookButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const itemName = row.querySelector('td:nth-child(3)').innerText;
                const itemPrice = parseFloat(row.querySelector('td:nth-child(4)').innerText);
                const quantity = parseInt(row.querySelector('.quantity').innerText);
                const totalPrice = itemPrice * quantity;

                totalAmount += totalPrice;

                const listItem = document.createElement('li');
                listItem.textContent = `${quantity} x ${itemName} - Rs. ${totalPrice.toFixed(2)}`;
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('delete-btn');
                listItem.appendChild(deleteButton); // Append delete button to list item

                orderList.appendChild(listItem);

                orderTotal.textContent = totalAmount.toFixed(2);

            });
        });

        // Increase and decrease button event listeners
        quantityButtons.forEach(button => {
            button.addEventListener('click', () => {
                const action = button.getAttribute('data-action');
                const row = button.closest('tr');
                const quantityElement = row.querySelector('.quantity');
                const totalElement = row.querySelector('.total-price');

                let quantity = parseInt(quantityElement.innerText);

                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }

                quantityElement.innerText = quantity;
                const price = parseFloat(row.querySelector('td:nth-child(4)').innerText);
                totalElement.innerText = (price * quantity).toFixed(2);

            });
        });

        // Category button event listeners
        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedCategoryId = button.getAttribute('data-category');

                menuItems.forEach(item => {
                    const itemCategoryId = item.getAttribute('data-category');
                    item.style.display = selectedCategoryId === 'all' || selectedCategoryId === itemCategoryId ? 'table-row' : 'none';
                });
            });
        });

        orderList.addEventListener('click', event => {
            if (event.target.classList.contains('delete-btn')) {
                const listItem = event.target.parentElement;
                const priceText = listItem.textContent.split('Rs. ')[1];
                const price = parseFloat(priceText);
                totalAmount -= price; // Subtract the deleted item's price from total
                listItem.remove(); // Remove the list item from the DOM
                orderTotal.textContent = totalAmount.toFixed(2); // Update the total amount
            }
        });

        // Function to retrieve order items
        // Function to retrieve order items
function getOrderItems() {
    const items = [];
    orderList.querySelectorAll('li').forEach(item => {
        const itemText = item.textContent.trim();
        const itemWithoutDelete = itemText.replace(/Delete/g, '').trim(); // Remove "Delete" text
        items.push(itemWithoutDelete);
    });
    return items;
}


        const orderForm = document.querySelector('.waiterOrder-form');
        if (orderForm) {
            console.log("Form found:", orderForm); // Log the found form element
            orderForm.addEventListener('submit', event => {
                event.preventDefault(); // Prevent the default form submission

                // Get the items and total_amount values from your JavaScript logic
                const items = getOrderItems(); // Implement getOrderItems() to retrieve the order items
                const totalAmount = parseFloat(orderTotal.textContent.trim());

                // Set the values in the hidden input fields
                orderItemsInput.value = JSON.stringify(items);
                orderTotalInput.value = totalAmount.toFixed(2);

                // Debug: Log the values before form submission
                console.log('Items:', items);
                console.log('Total Amount:', totalAmount);

                // Submit the form
                orderForm.submit();
            });
        } else {
            console.log('Form not found.'); // Log an error if the form is not found
        }
    });
</script>

<style>
    /* Your CSS styles here */
</style>


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

    .order-summary {
        flex: 1;
        padding: 16px;
        margin-left:2%;
        margin-top:2%;
        border-left: 1px solid red;
    }

    .order-summary-title {
        text-align: center;
    }
    
    .order-list {
        margin-top: 2%;
        padding-left: 10px;
        font-size: 16px;
        color: black;
        
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
        padding: 16px;
    }

    .emp-text {
        font-size: 25px;
        color: gray;
        margin-bottom: 1%;
        text-align: center;
    }

    .book-btn {
        /* background-color: #4CAF50; Green */
        border: 1px solid #4CAF50;;
        color: black;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 2px;
        width:100%;
        cursor: pointer;
    }

    .book-btn:hover{
        transition:.3s;
        color: white;
        background-color: #4CAF50; /* Green */

    }
    .row {
        display: flex;
        padding: 16px;
        flex-wrap: wrap;
        /* margin: -15px; Adjust margin to create gaps between cards */
    }

    .table {
        width: 60%;
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

    #orderTotal{
        width:100%;
        padding-top:5px;
        text-align: right;
        font-weight: bold;
    }

    .price{
        font-size:14px;
        font-weight: bold;
        color: green;
    }

    .order-list {
    margin-top: 2%;
    padding-left: 10px;
    font-size: 16px;
    color: black;
    list-style-type: none; /* Remove default list styles */
}

.order-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 0;
}

.delete-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 5px 8px;
    cursor: pointer;
    margin-left: auto !important;
    display: inline-block; /* Ensure the button takes up space horizontally */
}

.delete-btn:hover {
    background-color: darkred; /* Change background color on hover */
}

.order-list li .delete-btn {
    margin-left: 10px; /* Adjust margin as needed */
}


</style>