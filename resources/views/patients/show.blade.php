<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Il tuo paziente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-lg">
                    <!-- information about the patient -->
                    <div class="p-4 sm:p-8 border-2 border-red-500 dark:border-orange-600 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div>
                            @include('patients.partials.anagraphic-information')
                        </div>
                    </div>
                    <!-- Medical record -->
                    <div class="p-4 my-4 sm:p-8 border-2 border-red-500 dark:border-orange-600 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Visita') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                @switch($patient->visits->count())
                                    @case(0)
                                        {{ __("Il paziente non è stato ancora visitato.") }}
                                        @break
                                    @case(1)
                                        {{ __("Il paziente è stato visitato una volta.") }}
                                        @break
                                    @default
                                        {{ __("Il paziente è stato visitato " . $patient->visits->count() . " volte.") }}
                                @endswitch
                            </p>
                            <x-primary-button class="mt-4" onclick="window.location.href='{{ route('newVisitForm', $patient->id) }}'">
                                <i class="bi bi-plus-square-fill mr-2"></i> {{ __('Aggiungi visita') }}
                            </x-primary-button>
                            <x-secondary-button class="mt-4 ml-3" onclick="window.location.href='{{ route('showVisits', $patient->id) }}'">
                                <i class="bi bi-card-list mr-2"></i> {{ __('Visualizza visite') }}
                            </x-secondary-button>
                        </div>
                    </div>
                    <div class="p-4 my-4 sm:p-8 border-2 border-red-500 dark:border-orange-600 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Anamnesi') }}
                            </h2>
                            <x-primary-button class="mt-4" onclick="window.location.href='{{ route('showHistory', $patient->id) }}'">
                                <i class="bi bi-plus-square-fill mr-2"></i> {{ __('Visualizza tutte le anamnesi') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <!-- Deleting patient -->
                    <div class="p-4 my-4 sm:p-8 border-2 border-red-500 dark:border-orange-600 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div>
                            @include('patients.partials.delete-patient')
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
