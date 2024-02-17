<div class="flex">
    @include('admin/adminNavbar')
    
    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        <h1 class="emp-text">Edit Menu</h1>
        <form action="{{ route('updateMenu', $menuItem->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->

            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $menuItem->name }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Item Category:</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="" disabled>-- Select category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $menuItem->category_id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="price">Item Price:</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $menuItem->price }}" required>
            </div>

            <div class="form-group">
                <label for="description">Item Description:</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ $menuItem->description }}" required>
            </div>

            <div class="form-group">
                <label for="image">Item Image:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
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

    .content button {
        width:20%;
        background-color: #04AA6D;
        padding: 10px;
        margin-top: 1%;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .content button:hover {
        width:20%;
        background-color: white;
        border: 1px solid #04AA6D;
        padding: 10px;
        border-radius: 10px;
       
        color: black;
        cursor: pointer; /* Add a pointer cursor on hover */
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