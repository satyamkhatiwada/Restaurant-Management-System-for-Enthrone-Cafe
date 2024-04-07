
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
                        <td>{{$booking->table->name}}</td>
                        <td>{{$booking->timeSlot->start_time}} - {{$booking->timeSlot->end_time}}</td> 
                        <td>{{$booking->date}}</td>
                        <td>
                            <form action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" id="statusForm_{{ $booking->id }}">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="updateBookingStatus(this.value, '{{ $booking->id }}')">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="canceled" {{ $booking->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                </select>
                            </form>
                        </td>    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
    
    @else
    <p class="no-items">No Bookings present</p>
@endif

<script>
    function updateBookingStatus(status, orderId) {
    // Get the form by ID
    let form = document.getElementById('statusForm_' + orderId);
    // Set the selected status value
    form.querySelector('select[name="status"]').value = status;
    // Submit the form
    form.submit();
    }
</script>

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
    background-color: white;
    color: #4B49AC;
}

</style>
