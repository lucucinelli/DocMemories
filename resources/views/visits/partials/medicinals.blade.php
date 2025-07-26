<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" id = "medicinals-toggle">
            <h2 class="flex justify-between items-center text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Medicinali') }} <i class="bi bi-caret-down-fill" id="medicinals-toggle-Down"></i> 

            </h2>
        </div>
        <div id="medicinals-list" class="mt-4 hidden">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-300">
                    <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-800">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Nome') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Qta') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Assunzione') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Periodo') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="tabella-dinamica">
                    </tbody>
                </table>
            </div>
            <div class="my-4 text-center">
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-gray-700 dark:hover:bg-gray-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-medicinal-row')">
                    + Aggiungi Riga
                </button>
            </div>
        </div>
    </div>
</div>
<x-modal name="new-medicinal-row" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div  class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Aggiungi Medicinale') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Il medicinale verrà aggiunto alla lista.') }}
        </p>

        <div class="mt-4">
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="medicinal_name" class="block mt-1 w-full" type="text" name="nome" required />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            <x-input-label for="qta" :value="__('Quantità')" />
            <x-text-input id="medicinal_quantity" class="block mt-1 w-full" type="text" name="qta" required />
            <x-input-error :messages="$errors->get('qta')" class="mt-2" />
            <x-input-label for="assunzione" :value="__('Assunzione')" />
            <x-text-input id="medicinal_usage" class="block mt-1 w-full" type="text" name="assunzione" required />
            <x-input-error :messages="$errors->get('assunzione')" class="mt-2" />
            <x-input-label for="periodo" :value="__('Periodo')" />
            <x-text-input id="medicinal_period" class="block mt-1 w-full" type="text" name="periodo" required />  
            <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')" id="cancel-button">
                {{ __('Annulla') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" x-on:click="newRow()">
                {{ __('Aggiungi') }}
            </x-primary-button>
        </div>
    </div>
</x-modal>

@vite('resources/js/medicinals-dynamic-table.js')
