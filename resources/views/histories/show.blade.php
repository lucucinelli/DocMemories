<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Anamnesi di :patient', ['patient' => $patient->name]) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="tabs" class="flex flex-wrap gap-2 justify-center sm:justify-start mb-4">
                <button data-tab="physiological" class="tab-btn text-gray-700 bg-orange-400 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-orange-200 transition">
                    Fisiologia
                </button>
                <button data-tab="familiar" class="tab-btn  text-gray-700 bg-orange-400 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-orange-200 transition">
                    Familiare
                </button>
                <button data-tab="remote-pathological" class="tab-btn  text-gray-700 bg-orange-400 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-orange-200 transition">
                    Patologica Remota
                </button>
                <button data-tab="next-pathological" class="tab-btn  text-gray-700 bg-orange-400 border border-gray-300 rounded-full px-4 py-1.5 text-lg hover:bg-orange-200 transition">
                    Patologica Prossima
                </button>
            </div>
            <!-- Tab Contents -->
            <div data-content="physiological" class="contenuto hidden border-2 bg-white dark:border-gray-800 dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @include('histories.partials.physiological-history')
            </div>
            <div data-content="familiar" class="contenuto hidden border-2 dark:border-gray-600 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
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

@vite('resources/js/history.js')