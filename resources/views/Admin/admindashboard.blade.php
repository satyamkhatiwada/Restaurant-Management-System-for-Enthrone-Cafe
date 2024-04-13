<div class="flex">
    @include('admin.adminNavbar')

    <div class="content mt-16" style="margin-left:18%; height:1000px;">

        <h1 class="emp-text">Admin Panel</h1>
           
        <div class="flex" style="justify-content: center;">
            <div class="card">
                <h2 class="card-header">Total Orders: <span class="card-body">{{ $totalOrders }}</span></h2>
            </div>

            <div class="card">
                <h2 class="card-header">Total Earnings: <span class="card-body">${{ $totalEarnings }}</span></h2>
            </div>

            <div class="card">
                <h2 class="card-header">Total Users: <span class="card-body">{{ $totalUsers }}</span></h2>
            </div>

            <div class="card">
                <h2 class="card-header">Total Employees: <span class="card-body">{{ $totalEmployee }}</span></h2>
            </div>
        </div>

        <div class="users">
            <h1 class="emp-text">Users</h1>

            @if(count($Users) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Total Orders till date</th>
                        <!-- <th colspan='2'>Actions</th>  -->
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = $Users->firstItem(); // Initialize the serial number
                    @endphp
                    @foreach($Users as $user)
                        <tr>
                            <td>{{$sn++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ $user->orders()->count() }}</td>
                            <!-- <td>
                                <a href="#">
                                    <img src="{{ asset('img/edit.png') }}" alt="Edit" style="width: 20px;">
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('deleteUser', $user->id) }}" method="post" class="form-center">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">
                                        <img src="{{ asset('img/delete.png') }}" alt="Delete" style="width: 20px;">
                                    </button>
                                </form>
                            </td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-items">No Tables present</p>
        @endif
        </div>
        <br>
        {{ $Users->links() }}
    </div>
</div>

<style>
    .flex {
        display: flex;
    }

    .users{
        margin-top: 6%;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 10px;
        padding: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f0f0f0;
        padding: 8px;
        border-bottom: 1px solid #ccc;
        font-weight: bold;
    }

    .card-body {
        padding: 8px;
    }

    .no-items{
        width: 100%;
        text-align: center;
        padding-top: 10%;
        font-size: 30px;
        color: lightgray;
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

    .form-center{
        margin: auto;
    }
</style>
