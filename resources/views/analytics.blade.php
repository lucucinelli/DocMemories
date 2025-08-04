<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistiche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-white-500  dark:border-gray-800  bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
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
                    <div class="mt-6 flex flex-col gap-3" id="step-1">
                        <x-input-label  for="chart-type" :value="__('Seleziona il tipo di grafico dalla tendina')" />
                        <x-select id="chart-type" class="block mt-1 w-full" name="chart-type" :options="['Linea' => 'line', 'Istogramma' => 'bar', 'Torta' => 'pie', 'Ciambella' => 'doughnut']" />
                        <div class="flex justify-end">
                            <x-primary-button type="button" class="mt-4 " id="next-step-1" onclick="showStep(2)">
                                {{ __('Passo successivo') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col gap-3" id="step-2">
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Seleziona il periodo da analizzare") }}
                        </p>
                        <x-input-label  for="date_from" :value="__('Da')" />
                        <x-text-input id="date_from" class="block mt-1 w-full" type="date" name="date_from" autofocus  value="{{now()->format('Y') . '-01-01'}}" />
                        <x-input-label  for="date_to" :value="__('A')" />
                        <x-text-input id="date_to" class="block mt-1 w-full" type="date" name="date_to" autofocus value="{{now()->format('Y-m-d')}}" />
                        <div class="flex justify-between">
                            <x-secondary-button class="mt-4" id="prev-step-2" onclick="showStep(1)">
                                {{ __('Indietro') }}
                            </x-secondary-button>
                            <x-primary-button type="button" class="mt-4" id="next-step-2" onclick="showStep(3)">
                                {{ __('Passo successivo') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col gap-3 " id="step-3">
                        <x-input-label  for="param" :value="__('Parametri di analisi')" />
                        <x-text-input id="param" class="block mt-1 w-full" type="date" name="param" autofocus />
                        <div class="flex justify-between">
                            <x-secondary-button class="mt-4" id="prev-step-3" onclick="showStep(2)">
                                {{ __('Indietro') }}
                            </x-secondary-button>
                            <x-primary-button type="button" class="mt-4" id="create-chart">
                                {{ __('Crea grafico') }}
                            </x-primary-button>
                        </div>
                        <div class="mt-4 hidden" id="error-message">
                            <h2 class="text-red-500 text-center font-medium"> Non ci sono dati da analizzare </h2>
                        </div>
                        <div>
                            <canvas id="analytics-chart" class="mt-6 hidden"></canvas>
                        </div>
                        <div class="mt-6">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('FAQs') }}
                            </h2>
                            <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
                                {{ __("Cliccando sulla FAQ di interesse potrai visualizzarne il grafico") }}
                            </p>
                            <div class="mt-4">
                                <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-1" href="#analytics-chart">Quanti pazienti ho visitato?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-2" href="#analytics-chart">Quanti pazienti hanno  l'<span class="font-semibold text-gray-900 dark:text-white" id="patology-2">asma</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-3" href="#analytics-chart">Quanti pazienti hanno la <span class="font-semibold text-gray-900 dark:text-white" id="patology-3">rinite</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-4" href="#analytics-chart">Quanti pazienti hanno la <span class="font-semibold text-gray-900 dark:text-white" id="patology-4">poliposi nasale</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-5" href="#analytics-chart">Quanti pazienti hanno la <span class="font-semibold text-gray-900 dark:text-white" id="patology-5">congiuntivite</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-6" href="#analytics-chart">Quanti pazienti hanno la <span class="font-semibold text-gray-900 dark:text-white" id="patology-6">dermatite</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-7" href="#analytics-chart">Quanti pazienti sono <span class="font-semibold text-gray-900 dark:text-white">allergici ad alimenti</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-8" href="#analytics-chart">Quanti pazienti sono <span class="font-semibold text-gray-900 dark:text-white">allergici a beta-lattamici</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-9" href="#analytics-chart">Quanti pazienti sono <span class="font-semibold text-gray-900 dark:text-white">allergici ad antibiotici</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-10" href="#analytics-chart">Quanti pazienti sono <span class="font-semibold text-gray-900 dark:text-white">allergici ad antinfiammatori</span>?</a>
                                    </li>
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <i class="bi bi-question-circle shrink-0 text-red-500 dark:text-red-400"></i>
                                        <a id="question-11" href="#analytics-chart">Quanti pazienti sono <span class="font-semibold text-gray-900 dark:text-white">allergici al veleno di imenotteri</span>?</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite('resources/js/analytics.js')

