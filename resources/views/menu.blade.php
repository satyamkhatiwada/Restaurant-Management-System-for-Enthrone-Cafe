<div class="flex">
    @include('admindashboard')

    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        <h1 class="emp-text">Menu</h1>
        <div class="add-employee">
            <button><a href="{{route('addMenu')}}">Create Menu</a></button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($menuItems as $menuItem)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{ $menuItem->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" style="width: 100px;">
                        </td>
                        <td>{{ $menuItem->price }}</td>
                        <td>{{ $menuItem->description }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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

    .add-employee {
        text-align: right; /* Align the button to the right */
        margin-top: 20px; /* Add margin for spacing */
    }

    .add-employee button {
        width:20%;
        background-color: #04AA6D;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .add-employee button:hover {
        width:20%;
        background-color: white;
        border: 1px solid #04AA6D;
        padding: 10px;
        border-radius: 10px;
        color: black;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    /* Add some styling for the table, adjust as needed */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #04AA6D;
        color: white;
    }
</style>


