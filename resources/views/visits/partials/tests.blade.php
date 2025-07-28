<div class="max-w-8xl mx-auto sm:px-6 lg:px-8" >
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" id = "tests-toggle">
            <h2 class="flex justify-between items-center text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Test Allergologici') }} <i class="bi bi-caret-down-fill" id="tests-toggle-Down"></i> 

            </h2>
        </div>
        <div id="tests-list" class="mt-4 hidden">
            <div class="relative overflow-x-auto p-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  dark:bg-gray-700">
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800">
                        <tr class="bg-gray-100">
                            <th scope="col" class="px-6 py-3">{{ __('Data') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Tipo') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Esito') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Nota') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Modifica') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Rimuovi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-base" id="dynamic-table-tests">
                        @if (!$tests->isEmpty())
                            @foreach ($tests as $test)
                                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
                                        <input name="righe[{{ $test->id }}][test_date]" type="date" value="{{ $test->test_date }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <input name="righe[{{ $test->id }}][test_type]"  value="{{ $test->test_type }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <input name="righe[{{ $test->id }}][test_result]"  value="{{ $test->test_result }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" disabled>
                                    </td>
                                    <td class="px-6 py-4 dark:text-gray-500">
                                        <textarea name="righe[{{ $test->id }}][test_note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2" disabled>{{ $test->test_note }}</textarea>
                                    </td>
                                    <td class=" px-6 py-2 text-center ">
                                        <button type="button" onclick="editTestRow(this)" class="text-blue-600 hover:text-blue-800 font-bold"> <i class="bi bi-pencil"></i> </button>
                                    </td>
                                    <td class=" px-6 py-2 text-center ">
                                        <button type="button" onclick="deleteTestRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="my-4 text-center">
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-gray-700 dark:hover:bg-gray-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-test-row')">
                    + Aggiungi Riga
                </button>
            </div>
        </div>
    </div>
</div>
<x-modal name="new-test-row" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div  class="p-6"  id="modTests">
        <form method="POST" id="test-form">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Aggiungi Test') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Il test verrà aggiunto alla lista.') }}
            </p>

            <div class="mt-4">
                <x-input-label for="data" :value="__('Data')" />
                <x-text-input id="test_date" class="block mt-1 w-full" type="date" name="data" required />
                <x-input-error :messages="$errors->get('data')" class="mt-2" />
                <x-input-label for="tipo" :value="__('Tipo')" />
                <x-text-input id="test_type" class="block mt-1 w-full" type="text" name="tipo" required/>
                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                <x-input-label for="esito" :value="__('Esito')" />
                <x-text-input id="test_result" class="block mt-1 w-full" type="text" name="esito" required />
                <x-input-error :messages="$errors->get('esito')" class="mt-2" />
                <x-input-label for="nota" :value="__('Nota')" />
                <textarea id="test_note" rows="4" name="note" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 anagrafica" placeholder="Scrivi la tua nota qui..."> </textarea>
                <x-input-error :messages="$errors->get('nota')" class="mt-2" />
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

@vite('resources/js/tests-dynamic-table.js')
