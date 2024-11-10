<x-guest-layout class="h-[400px] flex flex-col justify-center bg-gradient-to-r from-blue-500 to-indigo-600">
    <!-- Image Header -->
    <div class="relative w-full h-32 bg-cover bg-center" style="background-image: url('https://example.com/your-image.jpg');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
    </div>

    <!-- Form Container -->
    <div class="relative z-10 flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg mx-4 flex">

            <!-- Icon on the right -->
            <div class="hidden lg:block w-1/4 bg-indigo-500 p-4 rounded-lg text-white flex justify-center items-center">
                <i class="fas fa-user-circle text-6xl"></i>
            </div>

            <!-- Form Content -->
            <div class="w-full lg:w-3/4">
                <h2 class="text-center text-3xl font-semibold mb-6 text-indigo-700">Welcome Back</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-center text-green-500" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-lg font-semibold text-gray-800" />
                        <x-text-input
                            id="email"
                            class="block mt-1 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="text-lg font-semibold text-gray-800" />
                        <x-text-input
                            id="password"
                            class="block mt-1 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between items-center mt-4">
                        <div class="flex items-center">
                            <label for="remember_me" class="inline-flex items-center">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember"
                                >
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a
                                class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold"
                                href="{{ route('password.request') }}"
                            >
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <x-primary-button class="w-full mt-6 text-lg py-2">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>

                <!-- Register Link -->
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Register Here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
