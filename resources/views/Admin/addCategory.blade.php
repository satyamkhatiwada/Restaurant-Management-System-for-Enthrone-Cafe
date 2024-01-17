<div class="flex">
    @include('admin/admindashboard')
    
    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        
        <h1 class="emp-text">Add Category</h1>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Category:</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

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

    input{
        width: 100%;
        margin-bottom:2%;
    }

    label{
        margin-top:1%;
    }
</style>
