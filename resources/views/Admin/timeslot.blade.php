@include('admin/bookings')

<div class="mt-0" style="margin-left:20%; flex: 1; padding: 16px;">
    <h1 class="emp-text">TimeSlot list</h1>
    <div id="add-employee">
        <a href="{{route('addTimeslot')}}"><button>Create Timeslot</button></a>
    </div>
    @if(count($timeslots) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($timeslots as $timeslot)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$timeslot->start_time}}</td>
                        <td>{{$timeslot->end_time}}</td>
                        <td>{{$timeslot->status}}</td>
                        <td>
                            <form action="{{ route('deleteTimeslot', $timeslot->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><img src="{{asset('img/delete.png')}}" alt="remove" class="w-4 h-4"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
    
    @else
    <p class="no-items">No Timeslot present</p>
    @endif
</div>


<style>

    .delete-icon {
        width: 20px; /* Adjust the size as needed */
        height: 20px;
        cursor: pointer;
    }

    #add-employee {
        text-align: right; /* Align the button to the right */
        margin-top: 20px; /* Add margin for spacing */
    }


    #add-employee a {
        width:20%;
        background-color: #7978E9;
        padding: 10px;
        border: 1px solid #7978E9;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    #add-employee a:hover {
        background-color: white;
        color: black;
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
