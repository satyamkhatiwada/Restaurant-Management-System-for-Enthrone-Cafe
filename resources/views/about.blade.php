<div class="flex" style="text-decoration: none;">
    @if (auth()->check())
        @include('user.dashboard')
  
    @else
        @include('guestdashboard')

    @endif

    <div class="content mt-16">
        <h1 class="emp-text">About Us</h1>
    </div>
</div>