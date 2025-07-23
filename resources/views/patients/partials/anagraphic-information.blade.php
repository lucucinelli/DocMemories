<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Anagrafica') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Aggiorna le informazioni anagrafiche del tuo account.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $patient->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            <x-input-label for="surname" :value="__('Cognome')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $patient->surname)" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            <x-input-label for="birthdate" :value="__('Data di nascita')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate', $patient->birthdate->format('Y-m-d'))" required /> 
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            <x-input-label for="gender" :value="__('Genere')" />
            <x-select name="gender" class="block mt-1 w-full" :options="['M' => 'Maschio', 'F' => 'Femmina']" :value="old('gender', $patient->gender)" />
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
            <x-input-label for="nationality" :value="__('Nazionalità')" />
            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality', $patient->nationality)" required />
            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
            <x-input-label for="birthplace" :value="__('Luogo di nascita')" />
            <x-text-input id="birthplace" class="block mt-1 w-full" type="text" name="birthplace" :value="old('birthplace', $patient->birthplace)" required />
            <x-input-error :messages="$errors->get('birthplace')" class="mt-2" />
            <x-input-label for="province" :value="__('Provincia di nascita')" />
            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province', $patient->province)" required />
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
            <x-input-label for="address" :value="__('Indirizzo')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $patient->address)" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
            <x-input-label for="street_number" :value="__('Numero civico')" />
            <x-text-input id="street_number" class="block mt-1 w-full" type="text" name="street_number" :value="old('street_number', $patient->street_number)" required />
            <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
            <x-input-label for="zip_code" :value="__('CAP')" />
            <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code', $patient->zip_code)" required />
            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
        </div>
        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
            <x-input-label for="tax_code" :value="__('Codice fiscale')" />
            <x-text-input id="tax_code" class="block mt-1 w-full" type="text" name="tax_code" :value="old('tax_code', $patient->tax_code)" required />
            <x-input-error :messages="$errors->get('tax_code')" class="mt-2" />
            <x-input-label for="telephone" :value="__('Telefono')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone', $patient->telephone)" required />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $patient->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-label for="occupation" :value="__('Occupazione')" />
            <x-text-input id="occupation" class="block mt-1 w-full" name="occupation" :value="old('occupation', $patient->occupation)" required></x-text-input>
            <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
