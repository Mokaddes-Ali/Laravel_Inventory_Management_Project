<x-guest-layout class="h-screen bg-gradient-to-br from-indigo-500 to-blue-600 relative overflow-hidden">
    <div class=" flex items-center justify-center mt-24">
    <!-- Background Shapes for Depth -->
    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-indigo-500 to-blue-600 opacity-40"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-300 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400 opacity-30 rounded-full blur-3xl"></div>

    <!-- Centered Form -->
    <div class="relative z-10 w-full  max-w-md p-10 bg-white bg-opacity-80 rounded-lg shadow-lg overflow-hidden">
        <!-- Side Shape Decoration -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-300 opacity-25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-300 opacity-25 rounded-full blur-3xl"></div>

        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Login to Your Account</h2>

        <!-- Divider Below Headline -->
        <div class="mb-6 border-t border-gray-300"></div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-500 text-sm font-medium" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="relative">
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-600" />
                <x-text-input
                    id="email"
                    class="block w-full pr-10 pl-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 ease-in-out"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <!-- Email Icon on the Right -->
                <div class="absolute right-3 top-3 text-gray-500">
                    <i class="fas fa-envelope text-fuchsia-500 text-3xl mt-4"></i> <!-- Email Icon -->
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div class="relative">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-600" />
                <x-text-input
                    id="password"
                    class="block w-full pr-10 pl-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 ease-in-out"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                <!-- Password Icon on the Right -->
                <div class="absolute right-3 top-3 text-gray-500">
                    <i class="fas fa-lock  text-fuchsia-500 text-3xl mt-4"></i> <!-- Password Icon -->
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center text-sm">
                <label class="inline-flex items-center text-gray-600">
                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <x-primary-button class="w-24 ml-32 text-center py-3 mt-6 text-3xl text-white font-bold bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 ease-in-out">
                {{ __('Log in') }}
            </x-primary-button>
        </form>

        <!-- Register Link -->
        <div class="mt-4 text-center text-sm text-gray-600">
            <p>
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
                    Register Here
                </a>
            </p>
        </div>
    </div>
</div>
</x-guest-layout>
