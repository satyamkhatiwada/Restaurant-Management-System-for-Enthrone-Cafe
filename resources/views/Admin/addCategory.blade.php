<div class="flex">
    @include('admin/adminNavbar')
    
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

        <table>
            <thead>
                <tr>
                    <th>s.n</th>
                    <th>Categories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($category as $categories)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$categories->category}}</td>
                        <td><form action="{{ route('deleteCategory', ['id' => $categories->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" id="delete-button" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form></td>
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

    .content button {
        width:100%;
        margin:auto;
        background-color: #04AA6D;
        padding: 10px;
        margin-top: 0.5%;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .content button:hover {
        width:100%;
        background-color: lightgray;
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

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 50px;
    }

    .table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 20px;
        text-align: left;
    }

    th {
        background-color: #04AA6D;
        color: white;
    }

    #delete-button{
        width: 100%;
    }

    #delete-button:hover{
        width: 100%;
        background-color: white;
        border: 1px solid #04AA6D;
    }
</style>
