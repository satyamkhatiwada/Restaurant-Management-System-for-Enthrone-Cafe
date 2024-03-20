
    @include('admin/bookings')

    <div class="mt-0" style="margin-left:20%; flex: 1;
        padding: 16px;">
        <h1 class="emp-text">Table list</h1>
        <div id="add-employee">
            <a href="{{route('addTable')}}"><button>Create Table</button></a>
        </div>
        @if(count($tables) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Table</th>
                        <th>Capacity</th>
                        <th>Action</th> <!-- Add a column for actions (e.g., remove item) -->
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sn = 1; // Initialize the serial number
                    @endphp
                    @foreach($tables as $table)
                        <tr>
                            <td>{{$sn++}}</td>
                            <td>{{$table->name}}</td>
                            <td>{{$table->capacity}}</td>
                            <td>
                            <form action="{{ route('deleteTable', $table->id) }}" method="POST">
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
        <p class="no-items">No Tables present</p>
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
