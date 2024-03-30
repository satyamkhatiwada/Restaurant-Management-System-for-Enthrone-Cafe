<div class="flex">
    @include('admin/adminNavbar')
    
    <div class="content mt-16" style="height:1000px;">
        <div style="margin-left:18%; margin-bottom: 2%;">
            <a href="{{ route('admin.menu') }}" class="back">
                <img src="{{ asset('img/back.png') }}" alt="back">
                <span>BACK</span>
            </a>
        </div>

        <div style="margin-left:20%;">
            <h1 class="emp-text">Add Menu</h1>
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Item Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category">Item Category:</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="" disabled selected>-- Select category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Item Price:</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Item Description:</label>
                    <input type="text" id="description" name="description" class="form-control" max-length="170" required>
                </div>

                <div class="form-group">
                    <label for="image">Item Image:</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Item</button>
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
        width: 50px;
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
        width:20%;
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