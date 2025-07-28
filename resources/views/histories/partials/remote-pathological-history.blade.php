<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" >
                @csrf
                <!-- Include form fields here -->
                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Storico del paziente: interventi e malattie') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni del paziente.") }}
                    </p>
                    <x-input-label for="type" :value="__('Tipo')" />
                    <x-select name="type" class="block mt-1 w-full anagrafica" :options="['intervento' => 'Intervento', 'malattia' => 'Malattia']" :selected="old('type')" required />
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    <x-input-label for="description" :value="__('Descrizione')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required value="{{ old('description') }}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    <x-input-label for="note" :value="__('Nota')" />
                    <textarea name="note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('note') }}</textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
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