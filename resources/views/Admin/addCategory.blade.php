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
            
            @if(count($category) > 0)
                <h1 class="emp-text" style="margin-top: 10px; padding: 10px 0px 16px 0px;" >All Categories</h1>
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>s.n</th>
                            <th>Categories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = $category->firstItem();
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
                <br>
                {{ $category->links() }}
            @else
                <p class="no-items">No Categories present</p>
            @endif
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
        width:100%;
        margin:auto;
        background-color: #4B49Ac;
        border: 1px solid #4B49Ac;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
    }

    .content button:hover {
        background-color: #7978E9;
    }

    form{
        margin-top: 2%;
    }

    .w-100{
        width: 100%;
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

    #delete-button{
        width: 20%;
    }

    #delete-button:hover{
        background-color: #7978E9;
    }

    .no-items{
        width: 100%;
        text-align: center;
        padding-top: 10%;
        font-size: 30px;
        color: lightgray;
    }
</style>
