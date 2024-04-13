
@include('admin/bookings')
    <div class="mt-0" style="margin-left:18%; flex: 1; padding: 16px;">
        <h1 class="emp-text">Create Timeslot</h1>

            <div class="card-body">
                <form method="POST" action="{{route('storeTimeslot')}}">
                    @csrf

                    <div class="form-group">
                        <label for="start">Start time:</label>
                        <input type="time" id="start" name="start" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end">End time:</label>
                        <input type="time" id="end" name="end" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary" id="add-table">Create Timeslot</button>
                </form>
            </div>
        </div>
    </div>


<style>

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

    #add-table {
        width:20%;
        background-color: #7978E9;
        border: 1px solid #7978E9;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    #add-table:hover {
        background-color: white;
        color: black;
    }

</style>
