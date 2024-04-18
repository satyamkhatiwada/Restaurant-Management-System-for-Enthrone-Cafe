<x-guest-layout>
    <!-- Background Image with Darker Blur -->
    <div class="relative min-h-screen bg-cover bg-top" style="background-image: url('{{ asset('img/res.jpg') }}'); filter: blur(2px);">
        <div class="absolute inset-0" style="background: black; opacity: 0.7;"></div> <!-- Increased opacity for a darker overlay -->
    </div>

    <!-- Custom Register Card Container -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="flex p-8 rounded-lg shadow-lg" style="width: 60%; height: 85%; margin-top: 60px;">
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

                    <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                        @csrf

                        <div>
                            <x-label for="name" value="{{ __('Name') }}" class="text-white" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name" />
                        </div>

                        <div>
                            <x-label for="email" value="{{ __('Email Address') }}" class="text-white" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Enter your email" />
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Password') }}" class="text-white" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password" />
                        </div>

                        <div>
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-white" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div>
                                <x-label for="terms" class="flex items-center text-white">
                                    <x-checkbox name="terms" id="terms" required />
                                    <span class="ms-2">{{ __('I agree to the :terms_of_service and :privacy_policy', ['terms_of_service' => '<a href="'.route('terms.show').'" class="underline hover:text-gray-300">'.__('Terms of Service').'</a>', 'privacy_policy' => '<a href="'.route('policy.show').'" class="underline hover:text-gray-300">'.__('Privacy Policy').'</a>']) }}</span>
                                </x-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-center mt-4">
                            <a class="underline text-sm text-white hover:text-white-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ms-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>