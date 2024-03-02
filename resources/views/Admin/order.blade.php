<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        <h1 class="emp-text">Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Order Number</th>
                    <th>Items</th>
                    <th>Phone</th>
                    <th style="width:11.11%;">Total (inclusive of delivery and tax)</th>
                    <th colspan="2" style="text-align: center;">Delivery Address</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($order as $order)
                    <tr>
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
                        <td>
                            @if($order->payment_method === 'Cash On Delivery')
                                Unpaid
                            @else
                                Paid 
                            @endif
                        </td>
                        <!-- <td></td> -->

                    </tr>
                @endforeach
            </tbody>
        </table>
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
        background-color: #04AA6D;
        color: white;
    }
</style>


