<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="height:1000px;">
        <div style="margin-left:18%; margin-bottom: 2%;">
            <a href="{{ route('employee') }}" class="back">
                <img src="{{ asset('img/back.png') }}" alt="back">
                <span>BACK</span>
            </a>
        </div>
        <div style="margin-left:20%;">
            <h1 class="emp-text">Add Waiter</h1>

            <div class="card-body">
                <form method="POST" action="{{ route('createWaiter') }}">
                    @csrf

                    <div class="form-group">
                        <label for="code">Waiter Code:</label>
                        <input type="text" id="code" name="code" class="form-control" autocomplete="off" required>
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" id="add-waiter">Add Waiter</button>
                </form>
            </div>
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

    #add-waiter {
        width:20%;
        margin:auto;
        background-color: #4B49Ac;
        border: 1px solid #4B49Ac;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
    }

    #add-waiter:hover {
        background-color: #7978E9;
    }

</style>
