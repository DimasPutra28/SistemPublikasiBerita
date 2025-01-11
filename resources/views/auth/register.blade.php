<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

          <!-- nama -->
          <div>
            <x-input-label for="user_nicename" :value="__('Name')" />
            <x-text-input id="user_nicename" class="block mt-1 w-full" type="text" name="user_nicename" :value="old('user_nicename')" required autofocus autocomplete="user_nicename" />
            <x-input-error :messages="$errors->get('user_nicename')" class="mt-2" />
        </div>

        <!-- username -->
        <div>
            <x-input-label for="user_login" :value="__('Username')" />
            <x-text-input id="user_login" class="block mt-1 w-full" type="text" name="user_login" :value="old('user_login')" required autofocus autocomplete="user_login" />
            <x-input-error :messages="$errors->get('user_login')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
