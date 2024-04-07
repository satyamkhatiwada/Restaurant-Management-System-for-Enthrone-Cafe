@auth
<div class="flex" style="text-decoration: none;">
    @include('user.dashboard')
    <div class="content mt-16">
        <h1 class="emp-text">Order history</h1>
        <div class="history">
            @if($orders->isEmpty())
                <p class="no-items">No Orders placed yet.</p>
            @else
                @foreach($orders as $order)
                <div class="card">
                    <div class="card-header">
                        Order #{{ $order->id }}
                    </div>
                    <div class="card-body">
                        <p class="p-2">Total Amount: ${{ $order->total_amount }}</p>
                        <p class="flex p-2">Status:
                            @if($order->status == 'pending')
                                <img src="{{ asset('img/pending.png') }}" alt="Pending" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #8B8000;">Pending</span>
                            @elseif($order->status == 'completed')
                                <img src="{{ asset('img/completed.png') }}" alt="Completed" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: green;">Completed</span>
                            @elseif($order->status == 'canceled')
                                <img src="{{ asset('img/cancelled.png') }}" alt="Cancelled" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: red;">Cancelled</span>
                            @elseif($order->status == 'confirmed')
                                <img src="{{ asset('img/confirmed.png') }}" alt="Confirmed" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold;">Confirmed</span>
                            @elseif($order->status == 'processing')
                                <img src="{{ asset('img/processing.png') }}" alt="Processing" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #80FF00;">Processing</span>

                            @elseif($order->status == 'dispatched')
                                <img src="{{ asset('img/dispatched.png') }}" alt="Dispatched" style="width: 30px; height: 30px;">
                                <span style="font-weight: bold; color: #FF00FF;">Dispatched</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endauth



@push('scripts')
    <script>
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

    .history{
        padding:2.5%;
    }

    .card {
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 10px;
    padding: 10px;
    width: 100%;; /* Adjust width as needed */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f0f0f0;
        padding: 8px;
        border-bottom: 1px solid #ccc;
        font-weight: bold;
    }

    .card-body {
        padding: 8px;
    }

    .no-items{
    width: 100%;
    text-align: center;
    padding-top: 10%;
    padding-bottom:8%;
    font-size: 30px;
    color: lightgray;
    }

</style>

@extends('footer')