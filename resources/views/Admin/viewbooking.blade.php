
@include('admin/bookings')

<div class="mt-0" style="margin-left:20%; flex: 1;
    padding: 16px;">
    <h1 class="emp-text">User bookings</h1>

    @if(count($bookings) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Table</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->email}}</td>
                        <td>{{$booking->phone}}</td>
                        <td>{{$booking->table_id}}</td>
                        <td>{{$booking->time_slot_id}}</td>
                        <td>{{$booking->date}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
    
    @else
    <p class="no-items">No Timeslot present</p>
@endif


<style>
#add-employee {
    text-align: right; /* Align the button to the right */
    margin-top: 20px; /* Add margin for spacing */
}


#add-employee a {
    width:20%;
    background-color: #04AA6D;
    padding: 10px;
    border-radius: 10px;
    color: white;
    cursor: pointer; /* Add a pointer cursor on hover */
}

#add-employee a:hover {
    width:20%;
    background-color: white;
    border: 1px solid #04AA6D;
    padding: 10px;
    border-radius: 10px;
    color: black;
    cursor: pointer; /* Add a pointer cursor on hover */
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
    background-color: #04AA6D;
    color: white;
}

</style>
