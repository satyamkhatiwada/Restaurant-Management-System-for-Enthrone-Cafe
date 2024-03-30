<div class="flex" style="text-decoration: none;">
    @include('waiter.dashboard')

    <div class="content mt-16">
        <h1 class="emp-text">Select table</h1>
        <div class="table-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
            @php
                $sortedTables = $tables->sortBy(function ($table) {
                    $tableNumber = (int)preg_replace('/[^0-9]/', '', $table->name);
                    return $tableNumber;
                });
            @endphp
            @foreach($sortedTables as $table)
                @php
                    $waiterOrder = App\Models\WaiterOrder::where('table_id', $table->id)->first();
                @endphp
                <div class="table-btn{{ $waiterOrder && $waiterOrder->status === 'confirmed' ? ' processing' : '' }}" style="width: 18%; height: 150px; margin: 10px; text-align: center; position: relative;">
                    <div class="table-info" data-table="{{ $table->id }}">
                        {{ $table->name }}
                        @if ($waiterOrder && $waiterOrder->status === 'confirmed')
                            <span class="status-text">Processing</span>
                            <!-- <form id="markAsCompletedForm-{{ $table->id }}" method="POST" action="{{ route('updateWaiterOrderStatus', ['id' => $table->id]) }}" style="position: absolute; bottom: 10px; right: 10px;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="mark-as-completed-btn" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 5px;">Mark as Completed</button>
                            </form> -->
                        @else
                            <span class="status-text">Take Order</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tableButtons = document.querySelectorAll('.table-btn');

        tableButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const tableId = button.querySelector('.table-info').getAttribute('data-table');
                window.location.href = "{{ route('makeOrder', ['id' => ':tableId']) }}".replace(':tableId', tableId);
            });
        });
    });
</script>

<style>
    .content {
        width: 100%;
        flex: 1;
        padding: 16px;
    }

    .emp-text {
        font-size: 25px;
        color: gray;
        margin-bottom: 1%;
    }

    .table-container {
        display: flex;
        gap: 30px; /* Adjust the gap as needed for equal spacing */
        justify-content: center; /* Center the categories horizontally */
        margin-top: 20px; /* Adjust the margin as needed */
    }

    .table-btn {
        display: inline-block;
        padding: 10px 20px; /* Adjust padding as needed */
        background-color: #fff; /* Set the background color */
        color: #333; /* Set the text color */
        text-decoration: none;
        border: 1px solid #ddd; /* Set the border color */
        border-radius: 8px; /* Adjust border-radius for rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow for a shadow effect */
        transition: transform 0.2s ease-in-out;
        position: relative;
    }

    .table-btn:hover {
        cursor: pointer;
        transform: scale(1.05); /* Add a slight scale effect on hover */
    }

    .table-info {
        cursor: pointer;
    }

    .status-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .processing {
        opacity: 0.5; /* Optionally reduce opacity for visual indication */
        pointer-events: none; /* Make the card unclickable */
    }

    .take-order {
        cursor: pointer; /* Ensure the card is clickable */
    }

    .mark-as-completed-btn {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
        border: none;
        cursor: pointer;
    }
</style>
