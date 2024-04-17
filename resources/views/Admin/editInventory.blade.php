<div class="flex">
    @include('admin/adminNavbar')
    
    <div class="content mt-16" style="height:1000px;">
        <div style="margin-left:18%; margin-bottom: 2%;">
            <a href="{{ route('admin.inventory') }}" class="back">
                <img src="{{ asset('img/back.png') }}" alt="back">
                <span>BACK</span>
            </a>
        </div>
        <div style="margin-left:20%;">

            <h1 class="emp-text">Edit Menu</h1>
            <form action="{{ route('updateInventory', $inventory->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Use the PUT method for updating -->

                <div class="form-group">
                    <label for="item">Item Name:</label>
                    <input type="text" id="item" name="item" class="form-control" value="{{ $inventory->item }}" required>
                </div>

                <div class="form-group">
                    <label for="unit">Available(unit):</label>
                    <input type="number" name="unit" id="category" class="form-control" value="{{$inventory->unit}}" required>
                </div>

                <div class="form-group">
                    <label for="name">Vendor name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$inventory->vendorName}}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Vendor Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" max-length="10" value="{{$inventory->vendorPhone}}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Item</button>
            </form>

        </div>
    </div>
</div>


<style>
    .flex {
        display: flex;
    }

    .back {
        display: flex;
        align-items: center; /* Center items vertically */
        text-decoration: none; /* Remove underline from the link */
    }
    .back img {
        width: 30px;
    }
    
    .back span {
        margin-left: 5px; 
        font-size: 18px; 
        color: #4B49Ac; 
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    .content button {
        width:20%;
        background-color: #4B49Ac;
        border: 1px solid #4B49Ac;
        padding: 10px;
        margin-top: 1%;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .content button:hover {
        background-color: white;
        color: black;
    }

    form{
        margin-top: 2%;
    }

    input, select{
        width: 100%;
        margin-bottom:2%;
    }

    label{
        margin-top:1%;
    }
</style>