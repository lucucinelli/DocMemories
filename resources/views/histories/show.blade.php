<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Anamnesi di ' . $patient->name . ' ' . $patient->surname . ', età ' . $eta . ' anni') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div id="tabs" class="flex flex-wrap gap-2 justify-center sm:justify-start mb-4">
                <button data-tab="physiological" class="tab-btn text-gray-700 bg-red-600 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-red-400 transition">
                    Fisiologica
                </button>
                <button data-tab="familiar" class="tab-btn  text-gray-700 bg-red-600 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-red-400 transition">
                    Familiare
                </button>
                <button data-tab="remote-pathological" class="tab-btn  text-gray-700 bg-red-600 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-red-400 transition">
                    Patologica Remota
                </button>
                <button data-tab="next-pathological" class="tab-btn  text-gray-700 bg-red-600 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-red-400 transition">
                    Patologica Prossima
                </button>
            </div>
            <!-- Tab Contents -->
            <div data-content="physiological" class="contenuto hidden border-2 bg-white dark:border-gray-800 dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @include('histories.partials.physiological-history')
            </div>
            <div data-content="familiar" class="contenuto hidden border-2 dark:border-gray-800 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @include('histories.partials.familiar-history')
            </div>
            <div data-content="remote-pathological" class="contenuto hidden border-2 dark:border-gray-800 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @include('histories.partials.remote-pathological-history')
            </div>
            <div data-content="next-pathological" class="contenuto hidden border-2 dark:border-gray-800 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @include('histories.partials.next-pathological-history')
            </div>
        </div>
    </div>

</x-app-layout>
<!-- modal for deleting familiar history row -->
<x-modal name="confirm-history-deletion" :show="$errors->familiarDeletion->isNotEmpty()" focusable>

    <input type="hidden" id="history_id" value="">
    <input type="hidden" id="history_type" value="">


    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Sei sicuro di voler eliminare questa anamnesi?') }}
        </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Una volta che l\'anamnesi è stata eliminata, tutte le sue risorse e i dati saranno permanentemente eliminati. Desideri procedere comunque?') }}
    </p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close', 'confirm-familiar-deletion')">
            {{ __('Annulla') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" x-on:click="$dispatch('close')" onclick="deleteRow()">
            {{ __('Cancella anamnesi') }}
        </x-danger-button>
    </div>
</x-modal>

@vite('resources/js/history.js')