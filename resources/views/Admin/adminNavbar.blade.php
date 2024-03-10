<x-app-layout>
<ul class="flex flex-col">
    <div class="font-semibold text-xl text-gray-800 leading-tight">
        <span class="mt-16 block admin-text">Admin {{ __('Dashboard') }}</span>
    </div>

    <li class="mt-5 mb-2">
        <a href="{{ route('admindashboard') }}" class="{{ request()->routeIs('admindashboard') ? 'active' : '' }}" id="panel-link">
            Panel
        </a>
    </li>

    <li class="mb-2">
        <a href="{{ route('admin.menu') }}" class="{{ request()->routeIs('admin.menu') ? 'active' : '' }}" id="menu-link">
            Menu
        </a>
    </li>
    <li class="mb-2">
        <a href="{{ route('employee') }}" class="{{ request()->routeIs('employee') ? 'active' : '' }}" id="employee-link">
            Employee
        </a>
    </li>
    <li class="mb-2">
        <a href="{{ route('admin.order') }}" class="{{ request()->routeIs('admin.order') ? 'active' : '' }}" id="inventory-link">
            Orders
        </a>
    </li>

    <li class="mb-2">
        <a href="#" class="{{ request()->routeIs('admin.booking') ? 'active' : '' }}" id="inventory-link">
            Table bookings
        </a>
    </li>

    <li class="mb-2">
        <a href="#" class="{{ request()->routeIs('inventory') ? 'active' : '' }}" id="inventory-link">
            Inventory
        </a>
    </li>
</ul>

<style>
    body {
        margin: 0;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 20%;
        background-color: #F8F8F8;
        position: fixed;
        height: 100%;
        overflow: auto;
    }

    li a,
    .admin-text {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    li a.active {
        background-color: #04AA6D;
        color: white;
    }

    li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
</style>

<script>
    // Get all links
    const links = document.querySelectorAll('li a');

    // Add click event listener to each link
    links.forEach(link => {
        link.addEventListener('click', () => {
            // Remove active class from all links
            links.forEach(l => l.classList.remove('active'));

            // Add active class to the clicked link
            link.classList.add('active');
        });
    });
</script>

</x-app-layout>
