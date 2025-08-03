<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualizza e modifica la visita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-red-500  dark:border-orange-600  bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Form for creating a new patient -->
                    <form method="POST" action="{{ route('editVisit', $visit->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- Include form fields here -->

                        <div class="flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Visita') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Queste sono le informazioni della visita.') }}
                            </p>
                            <x-input-label for="visit_date" :value="__('Data')" />
                            <x-text-input id="visit_date" class="block mt-1 w-full anagrafica" type="date" name="visit_date" :value="old('visit_date', $visit->visit_date->format('Y-m-d'))"  autofocus disabled/>
                            <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                            <x-input-label for="reason" :value="__('Motivazione della visita')" />
                            <x-text-input id="reason" class="block mt-1 w-full anagrafica" type="text" name="reason" :value="old('reason', $visit->reason)" autofocus disabled />
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                            <x-input-label for="diagnosis" :value="__('Diagnosi')" />
                            <x-text-input id="diagnosis" class="block mt-1 w-full anagrafica" type="text" name="diagnosis" :value="old('diagnosis', $visit->diagnosis)"  autofocus disabled/>
                            <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                            <x-input-label for="reservation" :value="__('Prenotazione')" />
                            <x-select name="reservation" class="block mt-1 w-full anagrafica" :options="['Istituzionale' => 'Istituzionale', 'Intramoenia' => 'Intramoenia']"  :selected="old('reservation', $visit->reservation)" disabled/>
                            <x-input-error :messages="$errors->get('reservation')" class="mt-2" />
                            <x-input-label for="note" :value="__('Nota')" />
                            <textarea id="note" rows="4" name="note" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 anagrafica" placeholder="Scrivi la tua nota qui..." disabled> {{ old('note', $visit->note) }} </textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            <div class="flex items-center gap-4">
                                <x-secondary-button id="edit-button" onclick="toggleEditMode()">{{ __('Modifica') }}</x-secondary-button>
                                <x-secondary-button id="cancel-button" type="reset" onclick="toggleEditMode()" class="hidden">{{ __('Annulla') }}</x-secondary-button>
                                <x-primary-button id="save-button" class="hidden">{{ __('Salva') }}</x-primary-button>
                                @if (session('status') === 'visit-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-green-600 dark:text-gray-400"
                                    >{{ __('La visita è stata aggiornata.') }}</p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        @include('visits.partials.tests')
    </div>

    <div class="py-3">
        @include('visits.partials.medicinals')
    </div>

    <div class="py-3">
        @include('visits.partials.exams')
    </div> 
</x-app-layout>

@vite('resources/js/exams.js')
@vite('resources/js/tests.js')
@vite('resources/js/medicinals.js')