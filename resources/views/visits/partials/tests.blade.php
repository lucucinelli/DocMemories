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
                    <thead class="text-base text-gray-700 uppercase dark:bg-gray-200 dark:text-gray-800 hidden sm:table-header-group">
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
                        @if(!$tests->isEmpty())        
                            @foreach ($tests as $test)
                                <tr class="bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none">
                                    <td class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Data'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $test->id }}][test_date]" type="date" value="{{ $test->test_date }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
                                        <select name="righe[{{ $test->id }}][test_type]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                            <option value="PRICK: pollini" {{ $test->test_type === 'PRICK: pollini' ? 'selected' : '' }}>PRICK: pollini</option>
                                            <option value="PRICK: alimenti" {{ $test->test_type === 'PRICK: alimenti' ? 'selected' : '' }}>PRICK: alimenti</option>
                                            <option value="PRICK BY PRICK" {{ $test->test_type === 'PRICK BY PRICK' ? 'selected' : '' }}>PRICK BY PRICK</option>
                                            <option value="CUTI: farmaci" {{ $test->test_type === 'CUTI: farmaci' ? 'selected' : '' }}>CUTI: farmaci</option>
                                            <option value="CUTI: imenotteri" {{ $test->test_type === 'CUTI: imenotteri' ? 'selected' : '' }}>CUTI: imenotteri</option>
                                            <option value="CUTI: PPL/MDM" {{ $test->test_type === 'CUTI: PPL/MDM' ? 'selected' : '' }}>CUTI: PPL/MDM</option>
                                            <option value="PATCH TEST: sidapa" {{ $test->test_type === 'PATCH TEST: sidapa' ? 'selected' : '' }}>PATCH TEST: sidapa</option>
                                            <option value="PATCH TEST: metalli" {{ $test->test_type === 'PATCH TEST: metalli' ? 'selected' : '' }}>PATCH TEST: metalli</option>
                                            <option value="PATCH TEST: alimenti" {{ $test->test_type === 'PATCH TEST: alimenti' ? 'selected' : '' }}>PATCH TEST: alimenti</option>
                                            <option value="PATCH TEST: gomma" {{ $test->test_type === 'PATCH TEST: gomma' ? 'selected' : '' }}>PATCH TEST: gomma</option>
                                            <option value="PATCH TEST: parrucchiera" {{ $test->test_type === 'PATCH TEST: parrucchiera' ? 'selected' : '' }}>PATCH TEST: parrucchiera</option>
                                            <option value="PATCH TEST: farmaci" {{ $test->test_type === 'PATCH TEST: farmaci' ? 'selected' : '' }}>PATCH TEST: farmaci</option>
                                            <option value="PCT" {{ $test->test_type === 'PCT' ? 'selected' : '' }}>PCT</option>
                                            <option value="TEO" {{ $test->test_type === 'TEO' ? 'selected' : '' }}>TEO</option>
                                            <option value="TSA" {{ $test->test_type === 'TSA' ? 'selected' : '' }}>TSA</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
                                        <input name="righe[{{ $test->id }}][test_result]" value="{{ $test->test_result }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
                                    </td>
                                    <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
                                        <textarea name="righe[{{ $test->id }}][test_note]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" rows="2" disabled>{{ $test->test_note }}</textarea>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" onclick="editTestRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"><i class="bi bi-pencil"></i></button>
                                    </td>
                                    <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
                                        <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-test-deletion')" onclick="openDeleteTestModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
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
                <x-input-label for="tipo" :value="__('Tipo')" class="mt-2"/>
                <x-select id="test_type" class="block mt-1 w-full" :options="['PRICK: pollini' => 'PRICK: pollini', 'PRICK: alimenti' => 'PRICK: alimenti', 'PRICK BY PRICK' => 'PRICK BY PRICK', 
                                                                            'CUTI: farmaci' => 'CUTI: farmaci', 'CUTI: imenotteri' => 'CUTI: imenotteri', 'CUTI: PPL/MDM' => 'CUTI: PPL/MDM', 
                                                                            'PATCH TEST: sidapa' => 'PATCH TEST: sidapa', 'PATCH TEST: metalli' => 'PATCH TEST: metalli', 'PATCH TEST: alimenti' => 'PATCH TEST: alimenti', 'PATCH TEST: gomma' => 'PATCH TEST: gomma', 'PATCH TEST: parrucchiera' => 'PATCH TEST: parrucchiera', 'PATCH TEST: farmaci' => 'PATCH TEST: farmaci',
                                                                            'PCT' => 'PCT', 'TEO' => 'TEO', 'TSA' => 'TSA' ]" name="tipo" required/>
                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                <x-input-label for="esito" :value="__('Esito')" class="mt-2"/>
                <x-text-input id="test_result" class="block mt-1 w-full" type="text" name="esito" required />
                <x-input-error :messages="$errors->get('esito')" class="mt-2" />
                <x-input-label for="nota" :value="__('Nota')" class="mt-2"/>
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

<!-- modal for deleting test row -->
<x-modal name="confirm-test-deletion" :show="$errors->testDeletion->isNotEmpty()" focusable>

    <input type="hidden" id="test_id" value="">


    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Sei sicuro di voler eliminare questo test?') }}
        </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Una volta che il test è stato eliminato, tutte le sue risorse e i dati saranno permanentemente eliminati. Desideri procedere comunque?') }}
    </p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Annulla') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" x-on:click="$dispatch('close')" onclick="deleteTestRow()">
            {{ __('Cancella test') }}
        </x-danger-button>
    </div>
</x-modal>

@vite('resources/js/tests-dynamic-table.js')

