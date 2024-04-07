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
                        <p>Total Amount: ${{ $order->total_amount }}</p>
                        <p>Status: {{ $order->status }}</p>
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