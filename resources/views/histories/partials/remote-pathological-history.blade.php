<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" id="remote-history-form" >
                @csrf
                <!-- Include form fields here -->
                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Storico del paziente: interventi e malattie') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni del paziente.") }}
                    </p>
                    <x-input-label for="remote_date" :value="__('Data dell\'intervento')" />
                    <x-text-input id="remote_date" class="block mt-1 w-full" type="date" name="remote_date" required autofocus value="{{ old('remote_date') }}"/>
                    <x-input-error :messages="$errors->get('remote_date')" class="mt-2" />
                    <x-input-label for="remote_type" :value="__('Tipo')" />
                    <x-select id="remote_type" name="remote_type" class="block mt-1 w-full anagrafica" :options="['intervento' => 'Intervento', 'malattia' => 'Malattia']" :selected="old('remote_type')" required />
                    <x-input-error :messages="$errors->get('remote_type')" class="mt-2" />
                    <x-input-label for="remote_description" :value="__('Descrizione')" />
                    <x-text-input id="remote_description" class="block mt-1 w-full" type="text" name="remote_description" required value="{{ old('remote_description') }}" />
                    <x-input-error :messages="$errors->get('remote_description')" class="mt-2" />
                    <x-input-label for="remote_note" :value="__('Nota')" />
                    <textarea name="remote_note" id="remote_note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('remote_note') }}</textarea>
                    <x-input-error :messages="$errors->get('remote_note')" class="mt-2" />
                </div>
                <div>
                    <x-primary-button class="mt-4" id="submit-remote-history">
                        {{ __('Registra anamnesi') }}
                    </x-primary-button>
                    <x-secondary-button class="mt-4 hidden" type="reset" id="cancel-remote-history" onclick="cancelUpdatedRemoteHistoryRow()">
                        {{ __('Annulla') }}
                    </x-secondary-button>
                    <x-primary-button class="mt-4 hidden" type="button" id="save-remote-history" onclick="saveUpdatedRemoteHistoryRow()">
                        {{ __('Salva') }}
                    </x-primary-button>
                    <input type="hidden" name="remote_history_id" id="remote_history_id" value="">
                </div>
            </form>
        </div>
        <div class="my-4 bg-white dark:bg-gray-800 ">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-700">
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800 hidden sm:table-header-group">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Data') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Tipo') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Descrizione') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Nota') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Modifica') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="dynamic-table-remote-history">
                        @if(!$remote_histories->isEmpty())
                            @foreach ($remote_histories as $remote_history)
                                <tr class="bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:table-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none">
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Data'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $remote_history->id }}][date]" value="{{ $remote_history->date->format('Y-m-d') }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $remote_history->id }}][type]" value="{{ $remote_history->type }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Descrizione'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $remote_history->id }}][description]" value="{{ $remote_history->description }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
                                        <textarea name="righe[{{ $remote_history->id }}][note]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" rows="2" disabled>{{ $remote_history->note }}</textarea>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="editRemoteHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"><i class="bi bi-pencil"></i></button>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="deleteRemoteHistoryRow(this)" class="text-red-600 hover:text-red-800 font-bold dark:text-red-300">✕</button>
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