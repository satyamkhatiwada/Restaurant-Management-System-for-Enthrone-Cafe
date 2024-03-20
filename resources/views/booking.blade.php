@auth
<div class="flex" style="text-decoration: none;">
    @include('user.dashboard')
    <div class="content mt-16">
        <h1 class="emp-text">Table reservation</h1>
        <div class="flex">
            <img src="img/reserve.jpg" style="width:50%; height:82vh; object-fit: cover; filter: brightness(50%); position: relative;">
    
            <form method="POST" class="reservation-form m-0" action="{{ route('bookings.store') }}">
                @csrf
                <h1 style="font-size: 30px; padding-bottom: 15; text-align: center; color:red;">Book a Table now!</h1>
                <div class="flex">
                    <div class="form-group w-50">
                        <label for="name" class="label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control input" autocomplete="off" required>
                    </div>
                    <div class="form-group w-50">
                        <label for="phone" class="label">Phone:</label>
                        <input type="tel" id="phone" name="phone" class="form-control input" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control input" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="table_id" class="label">Select Table:</label>
                    <select id="table_id" name="table_id" class="form-control input" required>
                        <option value="">Select Table</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }}, {{$table->capacity}} people</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="time_slot_id" class="label">Select Time Slot:</label>
                    <select id="time_slot_id" name="time_slot_id" class="form-control input" required>
                        <option value="">Select Time Slot</option>
                        @foreach($timeslots as $timeSlot)
                            <option value="{{ $timeSlot->id }}">{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date" class="label">Date:</label>
                    <input type="date" id="date" name="date" class="form-control input" required
                           min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}">
                </div>
                <button type="submit" class="btn btn-primary book-btn">Book Table</button>
            </form>
        </div>
    </div>
</div>

@endauth

@push('scripts')
    <script>
        const bookedDates = @json($bookedDates);

        const dateInput = document.getElementById('date');
        dateInput.addEventListener('input', function () {
            const selectedDate = new Date(this.value);
            const selectedDateString = selectedDate.toISOString().slice(0, 10);

            if (bookedDates.includes(selectedDateString)) {
                dateInput.value = ''; // Clear the input if the date is booked
                alert('This date is already booked. Please choose another date.');
            }
        });

        dateInput.addEventListener('focus', function () {
            const today = new Date();
            const todayString = today.toISOString().slice(0, 10);

            // Disable past dates
            dateInput.setAttribute('min', todayString);

            // Disable booked dates
            bookedDates.forEach(bookedDate => {
                const bookedDateElement = document.querySelector(`input[type="date"][value="${bookedDate}"]`);
                if (bookedDateElement) {
                    bookedDateElement.setAttribute('disabled', true);
                }
            });
        });

        // Ensure that the initial state of the date picker is set correctly
        dateInput.dispatchEvent(new Event('focus'));
    </script>
@endpush


<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding-left: 120px; /* Add padding to the content */
        padding-right: 120px; /* Add padding to the content */
        padding-top: 20px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
        margin-bottom: 1%;
    }

    .reservation-form{
        width:50%;
        padding:0% 1% 0% 1%;
        height:82vh;
        margin: 0;
    }

    .label {
        padding:5px;
        display: block;
        font-size: 16px;
        font-weight:bold;
        color: #555;
        margin-bottom: 5px;
    }

    .input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom:10px;
    }
    .book-btn {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 2px;
        width:100%;
        cursor: pointer;
    }

    .book-btn:hover {
        background-color: #45a049;
    }

    .w-50{
        margin: auto;
        width: 49%;
    }
</style>