<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Your analytics content goes here -->
                    <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                        <li class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-1-indicator" class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Tipo</h3>
                                <p class="text-sm">Scegli il tipo di grafico</p>
                            </span>
                        </li>
                        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-2-indicator" class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                2
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Periodo</h3>
                                <p class="text-sm">Scegli il periodo di analisi</p>
                            </span>
                        </li>
                        <li class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-3-indicator" class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Parametri</h3>
                                <p class="text-sm">Scegli i parametri di analisi</p>
                            </span>
                        </li>
                    </ol>
                    <div class="mt-6" id="step-1">
                        <x-input-label for="chart-type" :value="__('Tipo di grafico')" />
                        <x-select id="chart-type" class="block mt-1 w-full" name="chart_type" :options="['Linea' => 'line', 'Istogramma' => 'bar', 'Torta' => 'pie', 'Ciambella' => 'doughnut']" />
                        <x-primary-button type="button" class="mt-4" id="next-step-1" onclick="showStep(2)">
                            {{ __('Passo successivo') }}
                        </x-primary-button>
                    </div>
                    <div class="mt-6" id="step-2">
                        <x-input-label for="period" :value="__('Periodo di analisi')" />
                        <x-text-input id="period" class="block mt-1 w-full" type="date" name="period" autofocus />
                        <x-secondary-button class="mt-4" id="prev-step-2" onclick="showStep(1)">
                            {{ __('Indietro') }}
                        </x-secondary-button>
                        <x-primary-button type="button" class="mt-4" id="next-step-2" onclick="showStep(3)">
                            {{ __('Passo successivo') }}
                        </x-primary-button>
                    </div>
                    <div class="mt-6" id="step-3">
                        <x-input-label for="param" :value="__('Parametri di analisi')" />
                        <x-text-input id="param" class="block mt-1 w-full" type="date" name="param" autofocus />
                        <x-secondary-button class="mt-4" id="prev-step-3" onclick="showStep(2)">
                            {{ __('Indietro') }}
                        </x-secondary-button>
                        <x-primary-button type="button" class="mt-4" id="next-step-3">
                            {{ __('Crea grafico') }}
                        </x-primary-button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite('resources/js/analytics.js')