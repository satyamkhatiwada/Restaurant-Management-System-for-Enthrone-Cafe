<x-guest-layout>
    <!-- Background Image with Darker Blur -->
    <div class="relative min-h-screen bg-cover bg-top" style="background-image: url('{{ asset('img/res.jpg') }}'); filter: blur(2px);">
        <div class="absolute inset-0" style="background: black; opacity: 0.7;"></div> <!-- Increased opacity for a darker overlay -->
    </div>

    <!-- Custom Login Card Container -->
    <div class="absolute inset-0 flex items-center justify-center" style="margin-top: 60px;">
        <div class="flex p-8 rounded-lg shadow-lg" style="width: 60%; height: 65%;">
            <!-- Image and Form Container -->
            <div class="flex justify-between w-full">
                <!-- Image Container -->
                <div style="flex: 2;">
                    <img src="{{ asset('img/res2.avif') }}" style="height: 100%; width: 100%; object-fit: cover;" alt="">
                </div>
                <!-- Form Container -->
                <div style="flex: 1; padding: 30px; background: black; opacity: 0.65; display: flex; flex-direction: column; justify-content: center;">
                    <div name="logo">
                        <!-- Your logo or branding here -->
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </div>

                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ isset($guard) ? url($guard.'/login') :  route('login') }}">

                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email Address') }}" class="text-white" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Enter your email" />
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Password') }}" class="text-white" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                        </div>

                        <div class="block">
                            <label for="remember_me" class="flex items-center text-white">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <a class="underline text-sm text-white hover:text-white-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                                {{ __('Not registered? Register Now') }}
                            </a>    

                            <x-button class="ms-4">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
