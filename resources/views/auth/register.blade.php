<x-guest-layout>
    <!-- Background Wrapper with Image -->
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20220112/pngtree-glass-morphim-effect-registration-banner-with-gradient-blue-image_934693.jpg');">
        <!-- Shape and Form Container -->
        <div class="bg-white bg-opacity-80 w-96 p-8 md:p-10 rounded-lg shadow-2xl max-w-md mx-auto backdrop-blur-md relative">
            <!-- Decorative Shape -->
            <div class="absolute w-96 inset-0 bg-gradient-to-br from-indigo-600 to-purple-600 opacity-30 rounded-lg transform rotate-3 scale-105 -z-10"></div>

            <!-- Form Title -->
            <h2 class="text-4xl font-extrabold text-center text-indigo-800 mb-8">{{ __('Register') }}</h2>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name Input -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
                    <x-text-input id="name" class="block w-full mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                </div>

                <!-- Email Address Input -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="block w-full mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password Input with Toggle -->
                <div class="relative">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password" class="block w-full mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 pr-10" type="password" name="password" required autocomplete="new-password" />
                    <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 mt-7 pr-3 flex items-center text-gray-600">
                        <svg id="password-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.944 9.542 7-1.274 4.056-5.064 7-9.542 7-4.477 0-8.268-2.944-9.542-7z"/>
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Confirm Password Input with Toggle -->
                <div class="relative">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block w-full mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 pr-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 mt-7 pr-3 flex items-center text-gray-600">
                        <svg id="password_confirmation-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.944 9.542 7-1.274 4.056-5.064 7-9.542 7-4.477 0-8.268-2.944-9.542-7z"/>
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                </div>

                <!-- Submit Button and Redirect Link -->
                <div class="flex items-center justify-between mt-8">
                    <a class="text-lg text-fuchsia-600 hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="ml-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Toggle Password Visibility -->
    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = '<path d="M13.875 18.825a9.99 9.99 0 01-7.75-7.5H4.3c1.344 3.308 4.775 5.714 8.925 5.714 4.35 0 7.643-2.407 9.1-5.714h-1.625a9.988 9.988 0 01-7.75 7.5z"/>';
            } else {
                field.type = 'password';
                icon.innerHTML = '<path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.944 9.542 7-1.274 4.056-5.064 7-9.542 7-4.477 0-8.268-2.944-9.542-7z"/>';
            }
        }
    </script>
</x-guest-layout>
