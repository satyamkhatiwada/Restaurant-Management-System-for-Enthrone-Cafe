<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed w-full z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
    
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth('admin')->check())
                        <x-nav-link href="{{ route('admindashboard') }}" :active="request()->routeIs('admindashboard')">
                            Dashboard
                        </x-nav-link>

                    @elseif (auth('waiter')->check())
                        <x-nav-link href="{{ route('waiter.dashboard') }}" :active="request()->routeIs('waiter.dashboard')">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link href="{{ route('waiter.order') }}" :active="request()->routeIs('waiter.order')">
                            Take order
                        </x-nav-link>

                    @else
                        @if (auth()->check()&& !auth('waiter')->check())
                            <!-- Display these links for authenticated users -->
                            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>
                            <x-nav-link href="{{ route('booking') }}" :active="request()->routeIs('booking')">
                                Reservation
                            </x-nav-link>
                        @else
                            <x-nav-link href="/" :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>
                        @endif
                        <x-nav-link href="{{ route('menu') }}" :active="request()->routeIs('menu')">
                            Menu
                        </x-nav-link>

                        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                            About
                        </x-nav-link>

                    @endif
                </div>

                <div class="flex space-x-8 sm:ms-10">
                    @guest
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            Login
                        </x-nav-link>
                        
                        @if (Route::has('register'))    
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            Register
                        </x-nav-link>
                        @endif
                    @endguest
                </div>
            </div>

            
        
            <div class="hidden sm:flex sm:items-center sm:ms-6">

            @if (Auth::user() && !auth('admin')->check() && !auth('waiter')->check())
                <div class="ms-3 relative">
                    <a href="{{ route('cart.view') }}" :active="request()->routeIs('cart.view')">
                        <div class="relative" style="background-image: url('{{ asset('img/cart.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 40px; height: 40px;">
                            <!-- Calculate total quantities -->
                            @php
                                $cartItems = Auth::user()->cartItems;
                                $totalQuantities = $cartItems->sum('quantity');
                            @endphp
                            <!-- Display counter badge if total quantities is greater than 0 -->
                            @if ($totalQuantities > 0)
                                <span class="absolute top-0 left-full -mt-1 ml-1 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ $totalQuantities }}</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endif








                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                        
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                @if ((auth('admin')->check()) || (auth()->check()))
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <!-- <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link> -->

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            @if(auth('waiter')->check())
                                <!-- Waiter Logout Form -->
                                <form method="POST" action="{{ route('waiter.logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('waiter.logout') }}" @click.prevent="$root.submit();">
                                        <button type="submit">{{ __('Log Out') }}</button>
                                    </x-dropdown-link>
                                </form>
                            @else
                                <!-- Default Logout Form -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endif

                        </x-slot>
                    </x-dropdown>
                </div>
                @endif
            </div>

            <!-- Hamburger -->
            <!-- <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('menu') }}" :active="request()->routeIs('menu')">
                Menu
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @if ((auth('admin')->check()) || (auth()->check()))
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            
        </div>
        @endif
    </div>
</nav>
