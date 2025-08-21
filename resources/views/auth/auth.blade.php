<x-guest-layout>
    @php
        // Se ci sono errori che riguardano i campi della registrazione
        $showRegister = $errors->has('name')
            || $errors->has('password_confirmation')
            || (old('name') || old('password_confirmation'));
    @endphp

    <div class="backgroundImage" style="background-image: url('{{ asset('images/white2.jpg') }}');"> </div>
    <!-- Toggle Tabs -->
    <nav class="relative z-10 pt-2 px-4 max-w-md bg-red-500 dark:bg-red-600 flex space-x-8 border border-gray-300 rounded-t-lg">
        <button class="pb-2 text-base font-medium text-black hover:text-blue-600 dark:hover:text-blue-200 dark:text-white border-b-2 border-transparent {{ $showRegister ? 'border-transparent text-gray-400' : 'text-blue-600 border-blue-600' }}" id="form1">
            Login
        </button>
        <button class="pb-2 text-base font-medium text-black hover:text-blue-600 dark:hover:text-blue-200 dark:text-white border-b-2 border-transparent {{ $showRegister ? 'text-blue-600 border-blue-600' : 'border-transparent text-gray-400' }}" id="form2">
            Registrazione
        </button>
    </nav>

    <div class="relative z-10 w-full max-w-md p-4 bg-white dark:bg-gray-800 shadow-lg rounded-b-md">

        {{-- LOGIN FORM --}}
        <div class="form1-content {{ $showRegister ? 'hidden' : '' }}">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="login_email" :value="__('Email')" />
                    <x-text-input id="login_email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    {{-- Mostra errori email solo se non ci sono errori registrazione --}}
                    <x-input-error :messages="(!$errors->has('name') && !$errors->has('password_confirmation')) ? $errors->get('email') : []" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="login_password" :value="__('Password')" />
                    <x-text-input id="login_password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
                    {{-- Mostra errori password solo se non ci sono errori registrazione --}}
                    <x-input-error :messages="(!$errors->has('name') && !$errors->has('password_confirmation')) ? $errors->get('password') : []" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ricordami') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Hai dimenticato la password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Accedi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- REGISTER FORM --}}
        <div class="form2-content {{ $showRegister ? '' : 'hidden' }}">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="register_email" :value="__('Email')" />
                    <x-text-input id="register_email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="register_password" :value="__('Password')" />
                    <x-text-input id="register_password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Conferma Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Registrati') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

@vite('resources/js/access.js')
@vite('resources/css/access.css')