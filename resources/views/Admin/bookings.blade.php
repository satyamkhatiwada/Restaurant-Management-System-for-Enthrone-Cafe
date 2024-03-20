<div class="flex">
    @include('admin/adminNavbar')
    
    <div class="content mt-16" style="margin-left: 20%;">
        <div class="flex">
            <a href="{{ route('admin.booking') }}" class="tab-btn {{ request()->routeIs('admin.booking') ? 'active' : '' }}" data-tab="bookings">User Bookings</a>
            <a href="{{ route('admin.table') }}" class="tab-btn {{ request()->routeIs('admin.table') ? 'active' : '' }}" data-tab="tables">Tables</a>
            <a href="{{ route('admin.timeslot') }}" class="tab-btn {{ request()->routeIs('admin.timeslot') ? 'active' : '' }}" data-tab="timeslots">Timeslots</a>
        </div>
    </div>

</div>

<script>
    // Get all links
    const links = document.querySelectorAll('div a');

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

<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .content a {
        width:100%;
        text-align: center;
        display: inline-block;
        margin: 2px;
        background-color: lightgray;
        padding: 10px;
        margin-top: 0.5%;
        border-radius: 10px;
        color: black;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .content a.active {
        background-color: #04AA6D;
        border: 1px solid lightgray;
        color: white;
    }

    .content a:hover {
        background-color: #04AA6D;
        border: 1px solid #04AA6D;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .emp-text {
        margin-top: 2%;
        font-size: 25px;
        color: gray;
    }
</style>
