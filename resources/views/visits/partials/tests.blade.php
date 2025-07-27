<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
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
<style>
  .form-table {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 800px;
    margin: auto;
  }

  .form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: flex-start;
  }

  .form-field {
    flex: 1;
    min-width: 150px;
  }

  .form-field.large {
    flex: 2;
    min-width: 300px;
  }

  input, textarea {
    width: 100%;
    padding: 8px;
    font-size: 1rem;
  }

  .form-actions {
    display: flex;
    gap: 0.5rem;
  }

  button {
    padding: 8px 12px;
    font-size: 1rem;
    cursor: pointer;
  }
</style>

<div class="form-table">
  <div class="form-row">
    <div class="form-field"><input type="text" placeholder="Campo 1"></div>
    <div class="form-field"><input type="text" placeholder="Campo 2"></div>
  </div>

  <div class="form-row">
    <div class="form-field"><input type="text" placeholder="Campo 3"></div>
    <div class="form-field large"><textarea placeholder="Campo 4 (grande)"></textarea></div>
  </div>

  <div class="form-row form-actions">
    <button>Salva</button>
    <button>Cancella</button>
  </div>
</div>


@vite('resources/js/tests-dynamic-table.js')
