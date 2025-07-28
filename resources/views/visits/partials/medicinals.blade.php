<div class="max-w-8xl mx-auto sm:px-6 lg:px-8" >
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" id = "medicinals-toggle">
            <h2 class="flex justify-between items-center text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Medicinali') }} <i class="bi bi-caret-down-fill" id="medicinals-toggle-Down"></i> 

            </h2>
        </div>
        <div id="medicinals-list" class="mt-4 hidden">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-700">
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Nome') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Qta') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Assunzione') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Periodo') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Modifica') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="dynamic-table-medicinals">
                        @if($medicinals->isNotEmpty())
                            @foreach($medicinals as $medicinal)
                                <tr class="bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
                                        <input name="righe[{{$medicinal->id}}][med_name]" value="{{$medicinal->name}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <input name="righe[{{$medicinal->id}}][med_quantity]" value="{{$medicinal->quantity}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <input name="righe[{{$medicinal->id}}][med_usage]" value="{{$medicinal->usage}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <input name="righe[{{$medicinal->id}}][med_period]" value="{{$medicinal->period}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class=" px-6 py-2 text-center ">
                                        <button type="button" onclick="editMedicinalRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
                                    </td>
                                    <td class=" px-6 py-2 text-center ">
                                        <button type="button" onclick="deleteMedicinalRow(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
                                    </td>
                                </tr>
                            
                            @endforeach
                        @endif
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
    <div  class="p-6"  id="modMedicinals">
        <form method="POST" id="medicinal-form">
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
                <x-text-input id="medicinal_quantity" class="block mt-1 w-full" type="text" name="qta" />
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

                <x-primary-button class="ms-3">
                    {{ __('Aggiungi') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@vite('resources/js/medicinals-dynamic-table.js')
