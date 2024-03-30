<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        <h1 class="emp-text">In-house Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Order No.</th>
                    <th>Table</th>
                    <th>Waiter code</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = $waiterOrders->firstItem();
                @endphp
                @foreach($waiterOrders as $waiterOrder)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$waiterOrder->id}}</td>
                        <td>{{$waiterOrder->table->name}}</td>
                        <td>{{$waiterOrder->waiter->code}}</td>
                        <td>
                            @foreach(json_decode($waiterOrder->items) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </td>
                        <td>{{ $waiterOrder->total_amount }}</td>
                        <td>
                            <form action="{{ route('updateWaiterOrderStatus', $waiterOrder->id) }}" method="POST" id="statusForm_{{ $waiterOrder->id }}">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="updateOrderStatus(this.value, '{{ $waiterOrder->id }}')">
                                    <option value="confirmed" {{ $waiterOrder->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $waiterOrder->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>

                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <br>
        {{ $waiterOrders->links() }}
    </div>
</div>

<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    /* Add some styling for the table, adjust as needed */
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

<script>
    function updateOrderStatus(status, orderId) {
        // Get the form by ID
        let form = document.getElementById('statusForm_' + orderId);
        // Set the selected status value
        form.querySelector('select[name="status"]').value = status;
        // Submit the form
        form.submit();
    }
</script>


