<div class="flex" style="width: 100%;">
    @include('waiter.dashboard')
    <div class="content mt-16">
        <div class="flex">
            <div class="wi-50" style="box-sizing: border-box;">
                <div class="waiter-details" style="width: 100%;">
                    <h1><span style="font-size: 40px; font-weight: bolder; color: #6d2f44;">WELCOME, CONTINUE YOUR JOURNEY!!</span></h1>
                    <h1>Waiter code: <span>{{ Auth::user()->code}}</span></h1>
                    <h1>Total order taken: <span>{{ $totalOrders }}</span></h1>
                </div>
            </div>
            <div class="wi-50" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset('img/waiter3.avif') }}" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

<style>

    .content {
        width: 100%;
        flex: 1;
        padding: 16px;
    }

    .flex {
        display: flex;
    }

    .wi-50 {
        width: 50%;
    }


    .wi-50 img {
        max-width: 100%;
        height: auto;
    }

    .waiter-details{
      padding-top: 30%;
      padding-left: 18%;
      font-size: 20px;
      font-weight: bolder;
      color: red;
    }
</style>
