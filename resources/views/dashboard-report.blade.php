<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <i class="mr-2 bi bi-clipboard2-data-fill"></i> {{ __('Reports') }} 
</h2>
<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
    {{ __("Scegli il periodo da analizzare, poi, clicca su 'Pazienti', 'Visite' o 'Prenotazioni' per visualizzare i report corrispondenti.") }}
</p>

<div class="flex flex-row my-2">
    <x-select id="report-period" :options="[ 'Anni' => 'years', 'Mesi' => 'months']" />
    <div id="years-range" class="px-3 flex justify-between gap-3">
        <x-text-input id="from-year" placeholder="Da" type="number" />
        <x-text-input id="to-year" placeholder="A" type="number" />
    </div>
    <div id="months-range" class="px-3 flex justify-between gap-3">
        <x-select id="from-month" :options="[ 'Gennaio' => '01', 'Febbraio' => '02', 'Marzo' => '03', 'Aprile' => '04', 'Maggio' => '05', 'Giugno' => '06', 'Luglio' => '07', 'Agosto' => '08', 'Settembre' => '09', 'Ottobre' => '10', 'Novembre' => '11', 'Dicembre' => '12']" />
        <x-select id="to-month" :options="[ 'Gennaio' => '01', 'Febbraio' => '02', 'Marzo' => '03', 'Aprile' => '04', 'Maggio' => '05', 'Giugno' => '06', 'Luglio' => '07', 'Agosto' => '08', 'Settembre' => '09', 'Ottobre' => '10', 'Novembre' => '11', 'Dicembre' => '12']" />
        <x-text-input id="reference-year" placeholder="Anno di riferimento" type="number" />
    </div>
</div>
<div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="sm:hidden">
        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-base font-medium rounded-t-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
            <option value="" disabled> Seleziona un report </option>
            <option value="Patients">Pazienti</option>
            <option value="Visits">Visite</option>
            <option value="Reservations">Prenotazioni</option>
        </select>
    </div>
    <ul class="hidden text-lg font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
        <li class="w-full">
            <button id="patients-tab" type="button" role="tab" class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600"> Pazienti </button>
        </li>
        <li class="w-full">
            <button id="visits-tab"  type="button" role="tab"  class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600"> Visite </button>
        </li>
        <li class="w-full">
            <button id="reservations-tab" type="button" role="tab" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600"> Prenotazioni </button>
        </li>
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="p-4 bg-white hidden rounded-lg md:p-8 dark:bg-gray-800" id="patients-report" role="tabpanel">
            <div class="flex justify-center">
                <p class="mt-1  text-sm text-gray-600 dark:text-gray-400">
                    {{ __("I valori numerici sottostanti sono stati calcolati a partire dal primo utilizzo dell'applicazione.") }}
                </p>
            </div>
            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-3 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $m }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400"><i class="bi bi-gender-male mr-2 text-blue-600 text-xl"></i> Uomini</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $f }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400"><i class="bi bi-gender-female mr-2 text-pink-600 text-xl"></i> Donne</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $notSpecified }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400"><i class="bi bi-gender-neuter mr-2 text-gray-600 text-xl"></i> Non specificato</dd>
                </div>
            </dl>
            <div class="lg:w-2/3 lg:mx-auto sm:w-full sm:mx-0 hidden" id="patients-report-chart-container">
                <canvas id="patients-report-chart" class="mt-6" ></canvas>
            </div>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="visits-report" role="tabpanel" >
            <div class="flex justify-center">
                <p class="mt-1  text-sm text-gray-600 dark:text-gray-400">
                    {{ __("I valori numerici sottostanti fanno riferimento all'anno corrente.") }}
                </p>
            </div>
            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-4 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <a href={{route('dailyReportVisits')}}><dt class="mb-2 text-3xl font-extrabold">{{$dailyVisits}}</dt></a>
                    <dd class="text-gray-500 dark:text-gray-400">Visite giornaliere</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <a href={{route('weeklyReportVisits')}}><dt class="mb-2 text-3xl font-extrabold">{{$weeklyVisits}}</dt></a>
                    <dd class="text-gray-500 dark:text-gray-400">Visite settimanali</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <a href={{route('monthlyReportVisits')}}><dt class="mb-2 text-3xl font-extrabold">{{$monthlyVisits}}</dt></a>
                    <dd class="text-gray-500 dark:text-gray-400">Visite mensili</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <a href={{route('annualReportVisits')}}><dt class="mb-2 text-3xl font-extrabold">{{$annualVisits}}</dt></a>
                    <dd class="text-gray-500 dark:text-gray-400">Visite annuali</dd>
                </div>
            </dl>
            <div class="lg:w-2/3 lg:mx-auto sm:w-full sm:mx-0 hidden" id="visits-report-chart-container">
                <canvas id="visits-report-chart" class="mt-6" ></canvas>
            </div>
        </div>
        <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="reservations-report" role="tabpanel">
            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-2 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Prenotazioni istituzionali</h2>
                    <!-- List -->
                    <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('dailyReportReservations', 'institutionals')}}><span class="leading-tight">{{"giornaliere: $dailyIstituzionali"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('weeklyReportReservations', 'institutionals')}}><span class="leading-tight">{{"settimanali: $weeklyIstituzionali"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('monthlyReportReservations', 'institutionals')}}><span class="leading-tight">{{"mensili: $monthlyIstituzionali"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('annualReportReservations', 'institutionals')}}><span class="leading-tight">{{"annuali: $annualIstituzionali"}}</span></a>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Prenotazioni intramoenia</h2>
                    <!-- List -->
                    <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('dailyReportReservations', 'intramoenia')}}><span class="leading-tight">{{"giornaliere: $dailyIntramoenia"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('weeklyReportReservations', 'intramoenia')}}><span class="leading-tight">{{"settimanali: $weeklyIntramoenia"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('monthlyReportReservations', 'intramoenia')}}><span class="leading-tight">{{"mensili: $monthlyIntramoenia"}}</span></a>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <a href={{route('annualReportReservations', 'intramoenia')}}><span class="leading-tight">{{"annuali: $annualIntramoenia"}}</span></a>
                        </li>
                    </ul>
                </div>
            </dl>
            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-2 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <div class="lg:w-2/3 lg:mx-auto sm:w-full sm:mx-0 hidden" id="reservationIs-report-chart-container">
                        <canvas id="reservationIs-report-chart" class="mt-6" ></canvas>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="lg:w-2/3 lg:mx-auto sm:w-full sm:mx-0 hidden" id="reservationIn-report-chart-container">
                        <canvas id="reservationIn-report-chart" class="mt-6" ></canvas>
                    </div>
                </div>
            </dl>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>