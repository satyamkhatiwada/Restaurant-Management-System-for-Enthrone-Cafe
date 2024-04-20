<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="margin-left:18%; height:1000px;">
        <h1 class="emp-text">Orders</h1>
        <div style="text-align: right;">
            <label for="statusFilter" style="font-weight: bolder;">Filter by Status:</label>
            <select id="statusFilter" onchange="filterOrders()">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="canceled">Canceled</option>
                <option value="confirmed">Confirmed</option>
                <option value="processing">Processing</option>
                <option value="dispatched">Dispatched</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Order Number</th>
                    <th>Items</th>
                    <th>Phone</th>
                    <th style="width:11.11%;">Total (inclusive of delivery and tax)</th>
                    <th colspan="2" style="text-align: center;">Delivery Address</th>
                    <th>Time</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                @php
                    $sn = $orders->firstItem();
                @endphp
                @foreach($orders as $order)
                    <tr class="orderRow {{ $order->status }}">
                        <td>{{$sn++}}</td>
                        <td>{{$order->id}}</td>
                        <td>
                            
                                @foreach(json_decode($order->items) as $item)
                                <li>
                                    <strong>{{ $item->{"Item name"} }}</strong> X {{ $item->Quantity }} X {{ $item->Price }} <br>
                                </li>
                                @endforeach
                            
                        </td>

                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->delivery_address }}</td>
                        <td>{{ $order->landmark }}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            {{($order->payment_method)}}
                        </td>
                        <td>
                            <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST" id="statusForm_{{ $order->id }}" style="margin:auto;">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="updateOrderStatus(this.value, '{{ $order->id }}')">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="dispatched" {{ $order->status === 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{ $orders->links() }}
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

    .orderRow {
        display: table-row;
    }

</style>

<script>
    function filterOrders() {
        const statusFilter = document.getElementById('statusFilter').value;
        const orderRows = document.querySelectorAll('.orderRow');
        
        orderRows.forEach(row => {
            if (statusFilter === 'all' || row.classList.contains(statusFilter)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    }
    
    function updateOrderStatus(status, orderId) {
        // Get the form by ID
        let form = document.getElementById('statusForm_' + orderId);
        // Set the selected status value
        form.querySelector('select[name="status"]').value = status;
        // Submit the form
        form.submit();
    }
</script>



