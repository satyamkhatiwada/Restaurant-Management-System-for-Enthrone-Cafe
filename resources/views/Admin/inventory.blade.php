<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="height:1000px;">
        <div style="margin-left:20%;">
            <h1 class="emp-text">Inventory</h1>
            <div class="add-employee">
                <a href="{{route('addInventory')}}"><button>Add Item</button></a>
            </div>
            
            <br>
            <!-- Display validation errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(count($inventories) > 0)
                <h1 class="emp-text" style="margin-top: 10px; padding: 10px 0px 16px 0px;" >All Inventory items</h1>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>s.n</th>
                            <th>Item</th>
                            <th>Available(unit)</th>
                            <th>Vendor name</th>
                            <th>Vendor phone</th>
                            <th colspan='2'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = $inventories->firstItem();
                        @endphp
                        @foreach($inventories as $inventory)
                            <tr>
                                <td>{{$sn++}}</td>
                                <td>{{$inventory->item}}</td>
                                <td>{{$inventory->unit}}</td>
                                <td>{{$inventory->vendorName}}</td>
                                <td>{{$inventory->vendorPhone}}</td>
                                <td>
                                    <a href="{{ route('editInventory', $inventory->id) }}">
                                        <img src="{{ asset('img/edit.png') }}" alt="Edit" style="width: 20px;">
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('deleteInventory', ['id' => $inventory->id]) }}" method="post" class="form-center">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">
                                            <img src="{{ asset('img/delete.png') }}" alt="Delete" style="width: 20px;">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                {{ $inventories->links() }}
            @else
                <p class="no-items">No Items present</p>
            @endif
        </div>   
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
        width: 20%;
        background-color: #7978E9;
        border: 1px solid #7978E9;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .add-employee button:hover {
        background-color: white;
        color: black;
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
        background-color: white;
        color: #4B49AC;
    }


    .form-center{
        margin: auto;
    }

    .w-100{
        width:100%;
    }

</style>
