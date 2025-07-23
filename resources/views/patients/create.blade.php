<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crea un nuovo paziente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Form for creating a new patient -->
                    <form method="POST" action="{{ route('newPatient') }}">
                        @csrf
                        <!-- Include form fields here -->

                        <div class="flex flex-col gap-3">
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <x-input-label for="surname" :value="__('Cognome')" />
                            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" required />
                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            <x-input-label for="birthdate" :value="__('Data di nascita')" />
                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" required /> 
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                            <x-input-label for="gender" :value="__('Genere')" />
                            <x-select name="gender" class="block mt-1 w-full" :options="['M' => 'Maschio', 'F' => 'Femmina']" />
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <x-input-label for="nationality" :value="__('Nazionalità')" />
                            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" required />
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                            <x-input-label for="birthplace" :value="__('Luogo di nascita')" />
                            <x-text-input id="birthplace" class="block mt-1 w-full" type="text" name="birthplace" required />
                            <x-input-error :messages="$errors->get('birthplace')" class="mt-2" />
                            <x-input-label for="province" :value="__('Provincia di nascita')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            <x-input-label for="address" :value="__('Indirizzo')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            <x-input-label for="street_number" :value="__('Numero civico')" />
                            <x-text-input id="street_number" class="block mt-1 w-full" type="text" name="street_number" required />
                            <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
                            <x-input-label for="zip_code" :value="__('CAP')" />
                            <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" required />
                            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                        </div>
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <x-input-label for="tax_code" :value="__('Codice fiscale')" />
                            <x-text-input id="tax_code" class="block mt-1 w-full" type="text" name="tax_code" required />
                            <x-input-error :messages="$errors->get('tax_code')" class="mt-2" />
                            <x-input-label for="telephone" :value="__('Telefono')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" required />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <x-input-label for="occupation" :value="__('Occupazione')" />
                            <x-text-input id="occupation" class="block mt-1 w-full" name="occupation" required></x-text-input>
                            <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button class="mt-4">
                                {{ __('Crea Paziente') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

