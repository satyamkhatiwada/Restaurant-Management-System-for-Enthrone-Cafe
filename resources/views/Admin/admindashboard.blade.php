@if (auth('admin')->check())
<div class="flex">
    @include('admin.adminNavbar')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <div>
            <canvas id="monthlySalesChart" width="400" height="170"></canvas>
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
@else
    <div class="error-404">
        <p>No data found.</p>
    </div>
@endif


<style>
    .error-404 {
    text-align: center;
    padding: 50px;
    font-size: 24px;
    color: #666;
    }

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlySales->keys()) !!},
                datasets: [{
                    label: 'Total Sales',
                    data: {!! json_encode($monthlySales->values()) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
