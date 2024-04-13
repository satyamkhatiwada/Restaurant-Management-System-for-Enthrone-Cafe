<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="height:1000px;">
        <div style="margin-left:18%; margin-bottom: 2%;">
            <a href="{{ route('admin.booking') }}" class="back">
                <img src="{{ asset('img/back.png') }}" alt="back">
                <span>BACK</span>
            </a>
        </div>

        <div style="margin-left:20%;">
            <h1 class="emp-text">Reschedule reservation</h1>

            <form action="{{ route('rescheduleBooking', $bookings->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="flex">
                    <div class="form-group w-50">
                        <label for="name" class="label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control input" value="{{$bookings->name}}" required readonly>
                    </div>
                    <div class="form-group w-50">
                        <label for="phone" class="label">Phone:</label>
                        <input type="tel" id="phone" name="phone" class="form-control input" value="{{$bookings->phone}}" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control input" value="{{$bookings->email}}" required readonly>
                </div>
                <div class="form-group">
                    <label for="table_id" class="label">Select Table:</label>
                
                    <select id="table_id" name="table_id" class="form-control input" required>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}"{{ $table->id == $bookings->table_id ? 'selected' : '' }}>
                                {{ $table->name }}, {{ $table->capacity }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="time_slot_id" class="label">Select Time Slot:</label>

                    <select id="time_slot_id" name="time_slot_id" class="form-control input" required>
                        @foreach($timeslots as $timeSlot)
                            <option value="{{ $timeSlot->id }}"{{ $timeSlot->id == $bookings->timeslot_id ? 'selected' : '' }}>
                                {{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="date" class="label">Date:</label>
                    <input type="date" id="date" name="date" class="form-control input" value="{{$bookings->date}}" required
                           min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}">
                </div>
                <button type="submit" class="btn btn-primary book-btn">Reschedule</button>
            </form>
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

    .content button {
        width:20%;
        background-color: #4B49Ac;
        border: 1px solid #4B49Ac;
        padding: 10px;
        margin-top: 1%;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .content button:hover {
        background-color: white;
        color: black;
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

    .w-50{
        margin: auto;
        width: 49%;
    }

    .input[readonly] {
        background-color: #f0f0f0; /* Grey background color */
        color: #333; /* Text color */
        border: 1px solid #ccc; /* Border color */
        cursor: not-allowed; /* Change cursor to not-allowed */
    }
</style>