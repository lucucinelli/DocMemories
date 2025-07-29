<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" >
                @csrf
                <!-- Include form fields here -->

                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Informazioni fisiologiche') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni fisiologiche.") }}
                    </p>
                    <x-input-label for="birth" :value="__('Nascita')" />
                    <x-text-input id="birth" class="block mt-1 w-full" type="text" name="birth" required autofocus value="{{ old('birth') }}"/>
                    <x-input-error :messages="$errors->get('birth')" class="mt-2" />
                    <x-input-label for="atopy" :value="__('Atopia')" />
                    <x-text-input id="atopy" class="block mt-1 w-full" type="text" name="atopy" required autofocus value="{{ old('atopy') }}"/>
                    <x-input-error :messages="$errors->get('atopy')" class="mt-2" />
                    <x-input-label for="nursing" :value="__('Allattamento')" />
                    <x-text-input id="nursing" class="block mt-1 w-full" type="text" name="nursing" required autofocus value="{{ old('nursing') }}"/>
                    <x-input-error :messages="$errors->get('nursing')" class="mt-2" />
                    <x-input-label for="diet" :value="__('Dieta')" />
                    <x-text-input id="diet" class="block mt-1 w-full" type="text" name="diet" required value="{{ old('diet') }}" />
                    <x-input-error :messages="$errors->get('diet')" class="mt-2" />
                    <x-input-label for="habits" :value="__('Abitudini')" />
                    <x-text-input id="habits" class="block mt-1 w-full" type="text" name="habits" required value="{{ old('habits') }}" />
                    <x-input-error :messages="$errors->get('habits')" class="mt-2" />
                    <x-input-label for="note" :value="__('Nota')" />
                    <textarea name="note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('note') }}</textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    @if($patient->gender === 'F')
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ciclo mestruale') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Altre informazioni") }}
                            </p>
                            <x-input-label for="period" :value="__('Inizio ciclo')" />
                            <x-text-input id="period" class="block mt-1 w-full" type="text" name="period" value="{{ old('period') }}" />
                            <x-input-error :messages="$errors->get('period')" class="mt-2" />
                            <x-input-label for="period_regularity" :value="__('Regolarità ciclo')" />
                            <x-text-input id="period_regularity" class="block mt-1 w-full" type="text" name="period_regularity" value="{{ old('period_regularity') }}" />
                            <x-input-error :messages="$errors->get('period_regularity')" class="mt-2" />
                        </div>
                    @endif
                    
                </div>
                <div>
                    <x-primary-button class="mt-4">
                        {{ __('Registra anamnesi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
