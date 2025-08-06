<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistiche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-white-500  dark:border-gray-800  bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <!-- STEPPER -->
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Crea il tuo grafico personalizzato') }}
                    </h2>
                    <ol class="mt-6 items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                        <li class="stepper flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-1-indicator" class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Tipo</h3>
                                <p class="text-sm">Scegli il tipo di grafico</p>
                            </span>
                        </li>
                        <li class="stepper flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-2-indicator" class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                2
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Periodo</h3>
                                <p class="text-sm">Scegli il periodo di analisi</p>
                            </span>
                        </li>
                        <li class="stepper flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                            <span id="step-3-indicator" class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            <span>
                                <h3 class="font-medium leading-tight">Parametri</h3>
                                <p class="text-sm">Scegli i parametri di analisi</p>
                            </span>
                        </li>
                    </ol>
                    <form method="POST" id="analytics-form-stepper">
                        @csrf

                        <div class="mt-6 flex flex-col gap-3" id="step-1">
                            <x-input-label  for="chart-type-stepper" :value="__('Seleziona il tipo di grafico dalla tendina')" />
                            <x-select id="chart-type-stepper" class="block mt-1 w-full" name="chart-type-stepper" :options="[ 'Torta' => 'pie', 'Istogramma' => 'bar', 'Ciambella' => 'doughnut','Linea' => 'line']" />
                            <div class="flex justify-end">
                                <x-primary-button type="button" class="mt-4 " id="next-step-1" onclick="showStep(2)">
                                    {{ __('Passo successivo') }}
                                </x-primary-button>
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col gap-3" id="step-2">
                            <x-input-label  for="subtitle2" :value="__('Scegli come raggruppare i dati')" />
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex my-2">
                                        <div class="flex items-center ps-3 h-5">
                                            <input id="gender" name="groupBy" aria-describedby="helper-radio-text" type="radio" value="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </div>
                                        <div class="ms-2 text-sm">
                                            <label for="helper-radio" class="text-base font-medium text-gray-900 dark:text-gray-300"> {{ __('Genere') }}</label>
                                            <p id="helper-radio-text" class="text-md font-normal text-gray-500 dark:text-gray-300"> Potrai analizzare i dati facendo la distinzione tra 'Uomo', 'Donna' e 'Altro'. </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex">
                                        <div class="flex items-center ps-3 h-5">
                                            <input id="year" name="groupBy" aria-describedby="helper-radio-text" type="radio" value="year" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </div>
                                        <div class="ms-2 text-sm">
                                            <label for="helper-radio" class="text-base font-medium text-gray-900 dark:text-gray-300"> {{__('Anno')}} </label>
                                            <p id="helper-radio-text" class="text-md font-normal text-gray-500 dark:text-gray-300"> Potrai mettere a confronto i dati per anno. </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Seleziona il periodo da analizzare") }}
                            </p>
                            <x-input-label  for="date_from-stepper" :value="__('Da')" />
                            <x-text-input id="date_from-stepper" class="block mt-1 w-full" type="date" name="date_from-stepper" autofocus  value="{{now()->format('Y') . '-01-01'}}" />
                            <x-input-label  for="date_to-stepper" :value="__('A')" />
                            <x-text-input id="date_to-stepper" class="block mt-1 w-full" type="date" name="date_to-stepper" autofocus value="{{now()->format('Y-m-d')}}" />
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
                            <x-input-label  for="subtitle3" :value="__('Range di età')" />
                            <x-select id="age-range" class="block mt-1 w-full" name="age-range" :options="[ 'non specificato' => '%', 'compreso' => 'compreso', 'maggiore di' => '>', 'minore di' => '<']" />
                            <div id="compreso" class="hidden ml-20">
                                <x-input-label  for="age-value-min" :value="__('Età minima')" />
                                <x-text-input id="age-value-min" class="block mt-1 w-full" type="number" name="age-value-min" min="1" />
                                <x-input-label  for="age-value-max" :value="__('Età massima')" />
                                <x-text-input id="age-value-max" class="block mt-1 w-full" type="number" name="age-value-max" min="1" />
                            </div>
                            <div id="maggiore-minore" class="hidden ml-20">
                                <x-input-label  for="age-value" :value="__('Età')" />
                                <x-text-input id="age-value" class="block mt-1 w-full" type="number" name="age-value" min="1" />
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="group">
                                    <h3 class="mt-5 mb-2 block font-medium text-md text-gray-700 dark:text-gray-300"> {{__('Allergie')}} </h3>
                                    <ul class="flex flex-col items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="allergia1" name="allergy[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="allergia2" name="allergy[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="allergia3" name="allergy[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="allergia4" name="allergy[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="group">
                                    <h3 class="mt-5 mb-2 block font-medium text-md text-gray-700 dark:text-gray-300"> {{__('Allergie da farmaci')}} </h3>
                                    <ul class="flex flex-col items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="aspirina" name="medicine[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Aspirina </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="antibiotici" name="medicine[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Antibiotici </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="farmaco3" name="medicine[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="farmaco4" name="medicine[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Toggle me</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="group">
                                    <h3 class="mt-5 mb-2 block font-medium text-md text-gray-700 dark:text-gray-300"> {{__('Veleno di imenotteri')}} </h3>
                                    <ul class="flex flex-col items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="ape" name="venom[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Ape </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="vespa" name="venom[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Vespa </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="polistes dominulus" name="venom[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Polistes Dominulus </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="vespa cabro" name="venom[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Vespa Cabro </span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="group">
                                    <h3 class="mt-5 mb-2 block font-medium text-md text-gray-700 dark:text-gray-300"> {{__('Dermatiti')}} </h3>
                                    <ul class="flex flex-col items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="nichel" name="dermatitis[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Nichel </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="irritativa" name="dermatitis[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Irritativa </span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="w-full dark:border-gray-600">
                                            <div class="flex items-center ps-3 py-3">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" value="altro" name="dermatitis[]" class="sr-only peer">
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600 dark:peer-checked:bg-red-600"></div>                                        
                                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Altro </span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <x-secondary-button class="mt-4" id="prev-step-3" onclick="showStep(2)">
                                    {{ __('Indietro') }}
                                </x-secondary-button>
                                <x-primary-button class="mt-4" id="create-chart-stepper">
                                    {{ __('Crea grafico') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-4 hidden" id="error-message-stepper">
                        <h2 class="text-red-500 text-center font-medium"> Non ci sono dati da analizzare </h2>
                    </div>
                    <div id="analytics-chart-container-stepper">
                        <canvas id="analytics-chart-stepper" class="mt-6 hidden"></canvas>
                    </div>
                </div>
            </div>
            <div class="border-2 border-white-500 mt-6 dark:border-gray-800  bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <!-- FAQs -->
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Your analytics content goes here -->
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('FAQs') }}
                    </h2>
                    <div class="mt-6 flex flex-col gap-3">
                        <x-input-label  for="chart-type" :value="__('Seleziona il tipo di grafico dalla tendina')" />
                        <x-select id="chart-type" class="block mt-1 w-full" name="chart-type" :options="[ 'Torta' => 'pie', 'Istogramma' => 'bar', 'Ciambella' => 'doughnut', 'Linea' => 'line']" />
                        <x-input-label  for="chart-type" :value="__('Seleziona il periodo da analizzare')" />
                        <x-input-label  for="date_from" :value="__('Da')" />
                        <x-text-input id="date_from" class="block mt-1 w-full" type="date" name="date_from" autofocus  value="{{now()->format('Y') . '-01-01'}}" />
                        <x-input-label  for="date_to" :value="__('A')" />
                        <x-text-input id="date_to" class="block mt-1 w-full" type="date" name="date_to" autofocus value="{{now()->format('Y-m-d')}}" />
                        <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
                                {{ __("Cliccando sulla FAQ di interesse potrai visualizzarne il grafico") }}
                        </p>
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
                                <a id="question-7" href="#analytics-chart">Quanti pazienti sono allergici ad <span class="font-semibold text-gray-900 dark:text-white" value="alimenti">alimenti</span>?</a>
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
                        <div class="mt-4 hidden" id="error-message">
                            <h2 class="text-red-500 text-center font-medium"> Non ci sono dati da analizzare </h2>
                        </div>
                        <div class="lg:w-2/3 lg:mx-auto sm:w-full sm:mx-0 hidden" id="analytics-chart-container">
                            <canvas id="analytics-chart" class="mt-6" ></canvas>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

@vite('resources/js/analytics.js')

