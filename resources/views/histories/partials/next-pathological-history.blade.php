<div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" id="next-history-form">
                @csrf
                <!-- Include form fields here -->

                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Problematiche del paziente') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni del paziente.") }}
                    </p>

                    <x-input-label for="next_date" :value="__('Data')" />
                    <x-text-input id="next_date" class="block mt-1 w-full" type="date" name="next_date" value="{{ now()->format('Y-m-d') }}" required  /> 
                    <x-input-error :messages="$errors->get('next_date')" class="mt-2" />


                    <x-input-label for="next_type" :value="__('Tipo di patologia')" />
                    <x-select name="next_type" id="next_type" class="block mt-1 w-full" :options="['Respiratoria' => 'respiratoria', 'Dermatologica' => 'dermatologica', 'Alimentare' => 'alimentare', 'Farmacologica' => 'farmacologica', 'Veleno di imenotteri' => 'veleno di imenotteri', 'Altro' => 'ALTRO']" required />
                    <x-input-error :messages="$errors->get('next_type')" class="mt-2" />

                    <x-input-label for="next_problem" id="next_problem-label" :value="__('Problematica')" class="hidden"/>
                    <x-text-input id="next_problem" class=" mt-1 w-full hidden" type="text" name="next_problem" value="{{ old('next_problem') }}" />
                    <x-input-error :messages="$errors->get('next_problem')" class="mt-2" />

                    <x-input-label for="next_name" :value="__('Nome')" />
                    <x-text-input id="next_name" class="block mt-1 w-full" type="text" name="next_name" required value="{{ old('next_name') }}" />
                    <x-input-error :messages="$errors->get('next_name')" class="mt-2" />

                    <x-input-label for="next_cause" :value="__('Causa')" />
                    <x-text-input id="next_cause" class="block mt-1 w-full" type="text" name="next_cause" required value="{{ old('next_cause') }}" />
                    <x-input-error :messages="$errors->get('next_cause')" class="mt-2" />

                    <x-input-label for="next_effect" :value="__('Effetto')" />
                    <x-text-input id="next_effect" class="block mt-1 w-full" type="text" name="next_effect" required value="{{ old('next_effect') }}" />
                    <x-input-error :messages="$errors->get('next_effect')" class="mt-2" />

                    <x-input-label for="next_note" :value="__('Nota')" />
                    <textarea name="next_note" id="next_note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('next_note') }}</textarea>
                    <x-input-error :messages="$errors->get('next_note')" class="mt-2" />
                </div>
                <div>
                    <x-primary-button class="mt-4" id="submit-next-history">
                        {{ __('Registra anamnesi') }}
                    </x-primary-button>
                    <x-secondary-button class="mt-4 hidden" type="reset" id="cancel-next-history" onclick="cancelUpdatedNextHistoryRow()">
                        {{ __('Annulla') }}
                    </x-secondary-button>
                    <x-primary-button class="mt-4 hidden" type="button" id="save-next-history" onclick="saveUpdatedNextHistoryRow()">
                        {{ __('Salva') }}
                    </x-primary-button>
                    <input type="hidden" name="next_history_id" id="next_history_id" value="">
                </div>
            </form>
        </div>
        <div class="my-4 bg-white dark:bg-gray-800 ">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-700">
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800 hidden sm:table-header-group">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Data') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Tipo') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Nome') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Causa') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Effetto') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Nota') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Modifica') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="dynamic-table-next-history">
                        @if(!$next_histories->isEmpty())
                            @foreach ($next_histories as $next_history)
                                <tr class="bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none">
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Data'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $next_history->id }}][date]" value="{{ $next_history->date->format('Y-m-d') }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $next_history->id }}][type]" value="{{ $next_history->type }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Nome'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $next_history->id }}][name]" value="{{ $next_history->name }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Causa'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $next_history->id }}][cause]" value="{{ $next_history->cause }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Effetto'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $next_history->id }}][effect]" value="{{ $next_history->effect }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
                                        <textarea name="righe[{{ $next_history->id }}][note]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" rows="2" disabled>{{ $next_history->note }}</textarea>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="editNextHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"><i class="bi bi-pencil"></i></button>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-history-deletion')" onclick="openDeleteNextModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
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
