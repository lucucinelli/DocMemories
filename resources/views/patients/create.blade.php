<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crea un nuovo paziente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-red-500 dark:border-orange-600 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Form for creating a new patient -->
                    <form method="POST" action="{{ route('newPatient') }}">
                        @csrf
                        <!-- Include form fields here -->

                        <div class="flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informazioni anagrafiche') }}
                            </h2>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus value="{{ old('name') }}"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <x-input-label for="surname" :value="__('Cognome')" />
                            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" required value="{{ old('surname') }}" />
                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            <x-input-label for="birthdate" :value="__('Data di nascita')" />
                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" required value="{{ old('birthdate') }}" /> 
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                            <x-input-label for="gender" :value="__('Genere')" />
                            <x-select name="gender" class="block mt-1 w-full" :options="['Maschio' => 'M', 'Femmina' => 'F', 'Altro' => 'O']"  />
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            <x-input-label for="birthplace" :value="__('Luogo di nascita')" />
                            <x-text-input id="birthplace" class="block mt-1 w-full" type="text" name="birthplace" required value="{{ old('birthplace') }}" />
                            <x-input-error :messages="$errors->get('birthplace')" class="mt-2" />
                            <x-input-label for="tax_code" :value="__('Codice fiscale')" />
                            <x-text-input id="tax_code" class="block mt-1 w-full" type="text" name="tax_code" required value="{{ old('tax_code') }}" />
                            <x-input-error :messages="$errors->get('tax_code')" class="mt-2" />
                            <x-input-label for="marital_status" :value="__('Stato civile')" />
                            <x-text-input id="marital_status" class="block mt-1 w-full" type="text" name="marital_status" required value="{{ old('marital_status') }}" />
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informazioni sulla residenza') }}
                            </h2>
                            <x-input-label for="nationality" :value="__('Nazionalità')" />
                            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" required value="{{ old('nationality') }}" />
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                            <x-input-label for="city" :value="__('Città')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" required value="{{ old('city') }}" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            <x-input-label for="province" :value="__('Provincia')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" required value="{{ old('province') }}" />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            <x-input-label for="address" :value="__('Indirizzo')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required value="{{ old('address') }}" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            <x-input-label for="street_number" :value="__('Numero civico')" />
                            <x-text-input id="street_number" class="block mt-1 w-full" type="text" name="street_number" required value="{{ old('street_number') }}" />
                            <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
                            <x-input-label for="zip_code" :value="__('CAP')" />
                            <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" required value="{{ old('zip_code') }}" />
                            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                        </div>
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informazioni sul domicilio') }}
                            </h2>
                            <x-input-label for="domicile_city" :value="__('Città')" />
                            <x-text-input id="domicile_city" class="block mt-1 w-full" type="text" name="domicile_city" value="{{ old('domicile_city') }}" />
                            <x-input-error :messages="$errors->get('domicile_city')" class="mt-2" />
                            <x-input-label for="domicile_province" :value="__('Provincia')" />
                            <x-text-input id="domicile_province" class="block mt-1 w-full" type="text" name="domicile_province" value="{{ old('domicile_province') }}" />
                            <x-input-error :messages="$errors->get('domicile_province')" class="mt-2" />
                            <x-input-label for="domicile_address" :value="__('Indirizzo')" />
                            <x-text-input id="domicile_address" class="block mt-1 w-full" type="text" name="domicile_address" value="{{ old('domicile_address') }}" />
                            <x-input-error :messages="$errors->get('domicile_address')" class="mt-2" />
                            <x-input-label for="domicile_street_number" :value="__('Numero civico')" />
                            <x-text-input id="domicile_street_number" class="block mt-1 w-full" type="text" name="domicile_street_number" value="{{ old('domicile_street_number') }}" />
                            <x-input-error :messages="$errors->get('domicile_street_number')" class="mt-2" />
                            <x-input-label for="domicile_zip_code" :value="__('CAP')" />
                            <x-text-input id="domicile_zip_code" class="block mt-1 w-full" type="text" name="domicile_zip_code" value="{{ old('domicile_zip_code') }}" />
                            <x-input-error :messages="$errors->get('domicile_zip_code')" class="mt-2" />
                        </div>
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informazioni di contatto') }}
                            </h2>
                            <x-input-label for="telephone" :value="__('Telefono')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" required value="{{ old('telephone') }}" />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required value="{{ old('email') }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <x-input-label for="occupation" :value="__('Occupazione')" />
                            <x-text-input id="occupation" class="block mt-1 w-full" name="occupation" required value="{{ old('occupation') }}"></x-text-input>
                            <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                            <x-input-label for="reservation" :value="__('Prenotazione')" />
                            <x-select name="reservation" class="block mt-1 w-full" :options="['Istituzionale' => 'Istituzionale', 'Intramoenia' => 'Intramoenia']"  />
                            <x-input-error :messages="$errors->get('reservation')" class="mt-2" />
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

