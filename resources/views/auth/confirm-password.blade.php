<x-guest-layout class="h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-blue-600 relative overflow-hidden">
    <!-- Background Shapes for Depth -->
    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-indigo-500 to-blue-600 opacity-40"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-300 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400 opacity-30 rounded-full blur-3xl"></div>

    <!-- Centered Form -->
    <div class="relative z-10 w-full max-w-md p-10 bg-white bg-opacity-80 rounded-lg shadow-2xl overflow-hidden">
        <!-- Side Shape Decoration -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-300 opacity-25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-300 opacity-25 rounded-full blur-3xl"></div>

        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Confirm Your Password</h2>

        <!-- Divider Below Headline -->
        <div class="mb-6 border-t border-gray-300"></div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-500 text-sm font-medium" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

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
                    <i class="fas fa-lock"></i> <!-- Password Icon -->
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Confirm Button -->
            <div class="flex justify-center mt-4">
                <x-primary-button class="w-full py-3 text-white font-semibold bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-300 ease-in-out">
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-guest-layout>

