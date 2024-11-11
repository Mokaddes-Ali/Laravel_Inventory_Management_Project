<x-guest-layout class="h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 relative overflow-hidden">
    <!-- Background Shapes for Depth -->
    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 opacity-40"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-300 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 opacity-30 rounded-full blur-3xl"></div>

    <!-- Centered Form -->
    <div class="relative z-10 w-full max-w-md p-10 bg-white bg-opacity-90 rounded-lg shadow-2xl">
        <!-- Side Shape Decoration -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-300 opacity-25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-300 opacity-25 rounded-full blur-3xl"></div>

        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Forgot Your Password?</h2>

        <!-- Divider Below Headline -->
        <div class="mb-6 border-t border-gray-300"></div>

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('No worries! Just enter your email address, and we will send you a password reset link.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-500 text-sm font-medium" :status="session('status')" />

        <!-- Password Reset Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                />
                <!-- Email Icon on the Right -->
                <div class="absolute right-3 top-3 text-gray-500">
                    <i class="fas fa-envelope"></i> <!-- Email Icon -->
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Send Reset Link Button -->
            <div class="flex justify-center mt-4">
                <x-primary-button class="w-full py-3 text-white font-semibold bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 ease-in-out">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>

