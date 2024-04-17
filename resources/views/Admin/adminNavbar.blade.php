<x-app-layout>
<ul class="flex flex-col">
    <div class="font-semibold text-xl text-gray-800 leading-tight">
        <span class="mt-16 block admin-text">Admin {{ __('Dashboard') }}</span>
    </div>

    <li class="mt-5 mb-2">
        <a href="{{ route('admindashboard') }}" class="{{ request()->routeIs('admindashboard') ? 'active' : '' }}" id="panel-link">
            Panel
        </a>
    </li><hr>

    <li class="mb-2">
        <a href="{{ route('admin.menu') }}" class="{{ request()->routeIs('admin.menu') ? 'active' : '' }}" id="menu-link">
            Menu
        </a>
    </li><hr>
    <li class="mb-2">
        <a href="{{ route('employee') }}" class="{{ request()->routeIs('employee') ? 'active' : '' }}" id="employee-link">
            Employee
        </a>
    </li><hr>

    <li class="mb-2">
        <a href="#" id="order-link">
            Orders
        </a>
    </li>

    <li class="mb-2" id="online-orders" style="display: block;"> 
        <a href="{{ route('admin.order') }}" class="{{ request()->routeIs('admin.order') ? 'active' : '' }}" id="order-link-online" style="padding-left:15%;">
            Online Orders
        </a>
    </li>

    <li class="mb-2" id="in-house-orders" style="display: block;"> 
        <a href="{{ route('admin.waiterorder') }}" class="{{ request()->routeIs('admin.waiterorder') ? 'active' : '' }}" id="order-link-waiter" style="padding-left:15%;">
            In-house Orders
        </a>
    </li><hr>


    <li class="mb-2">
        <a href="{{ route('admin.booking') }}" class="{{ request()->routeIs('admin.booking') ? 'active' : '' }}" id="booking-link">
            Table bookings
        </a>
    </li><hr>

    <li class="mb-2">
        <a href="{{ route('admin.inventory') }}" class="{{ request()->routeIs('admin.inventory') ? 'active' : '' }}" id="inventory-link">
            Inventory
        </a>
    </li><hr>
</ul>

<style>

    body {
        margin: 0;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 18%;
        background-color: #F8F8F8;
        position: fixed;
        height: 100%;
        overflow: auto;
    }

    li a,
    .admin-text {
        display: block;
        color: #4B49AC;
        padding: 8px 16px;
        text-decoration: none;
    }

    li a.active {
        background-color: #4B49AC;
        color: white;
    }

    li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const orderLink = document.getElementById('order-link');
            const onlineOrders = document.getElementById('online-orders');
            const inHouseOrders = document.getElementById('in-house-orders');

            let ordersVisible = false; // Flag to track visibility

            orderLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior of the link

                // Toggle visibility of online and in-house orders
                if (ordersVisible) {
                    onlineOrders.style.display = 'none';
                    inHouseOrders.style.display = 'none';
                } else {
                    onlineOrders.style.display = 'block';
                    inHouseOrders.style.display = 'block';
                }

                // Update the flag
                ordersVisible = !ordersVisible;
            });

            // Get all links including the "Orders" and "In-house Orders" / "Online Orders"
            const links = document.querySelectorAll('li a');

            // Add click event listener to each link
            links.forEach(link => {
                link.addEventListener('click', () => {
                    // Display all nav items when "Orders" and one of the two items is clicked
                    if (ordersVisible && (link.id === 'order-link-waiter' || link.id === 'order-link-online')) {
                        links.forEach(l => l.parentNode.style.display = 'block');
                    }
                });
            });
        });

</script>

</x-app-layout>
