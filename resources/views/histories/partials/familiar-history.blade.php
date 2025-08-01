<div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" id="familiar-history-form">
                @csrf
                <!-- Include form fields here -->

                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Informazioni nucleo familiare') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni del nucleo familiare.") }}
                    </p>
                    <x-input-label for="allergy" :value="__('Allergia del familiare')" />
                    <x-text-input id="allergy" class="block mt-1 w-full" type="text" name="allergy" required autofocus value="{{ old('allergy') }}"/>
                    <x-input-error :messages="$errors->get('allergy')" class="mt-2" />
                    <x-input-label for="relative" :value="__('Familiare (grado di parentela)')" />
                    <x-text-input id="relative" class="block mt-1 w-full" type="text" name="relative" required value="{{ old('relative') }}" />
                    <x-input-error :messages="$errors->get('relative')" class="mt-2" />
                    <x-input-label for="note" :value="__('Nota')" />
                    <textarea id="note" name="note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('note') }}</textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                </div>
                <div>
                    <x-primary-button class="mt-4" id="submit-familiar-history">
                        {{ __('Registra anamnesi') }}
                    </x-primary-button>
                    <x-secondary-button class="mt-4 hidden" type="reset" id="cancel-familiar-history" onclick="cancelUpdatedFamiliarHistoryRow()">
                        {{ __('Annulla') }}
                    </x-secondary-button>
                    <x-primary-button class="mt-4 hidden" type="button" id="save-familiar-history" onclick="saveUpdatedFamiliarHistoryRow()">
                        {{ __('Salva') }}
                    </x-primary-button>
                    <input type="hidden" name="familiar_history_id" id="familiar_history_id" value="">
                </div>
            </form>
        </div>
        <div class="my-4 bg-white dark:bg-gray-800 ">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-700">
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800 hidden sm:table-header-group">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Allergia') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Familiare') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Nota') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Modifica') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="dynamic-table-familiar-history">
                        @if(!$familiar_histories->isEmpty())
                            @foreach ($familiar_histories as $familiar_history)
                                <tr class="bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none">
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $familiar_history->id }}][allergy]" value="{{ $familiar_history->allergy }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $familiar_history->id }}][relative]" value="{{ $familiar_history->relative}}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
                                        <textarea name="righe[{{ $familiar_history->id }}][note]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" rows="2" disabled>{{ $familiar_history->note }}</textarea>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="editFamiliarHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"><i class="bi bi-pencil"></i></button>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="deleteFamiliarHistoryRow(this)" class="text-red-600 hover:text-red-800 font-bold dark:text-red-300">✕</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
