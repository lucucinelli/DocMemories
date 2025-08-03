<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crea una nuova visita per ' . $patient->name . ' ' . $patient->surname) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-red-500  dark:border-orange-600 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Form for creating a new patient -->
                    <form method="POST" action="{{ route('newVisit', $patient->id) }}">
                        @csrf
                        <!-- Include form fields here -->

                        <div class="flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Visita') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Compila il modulo per creare una nuova visita.') }}
                            </p>
                            <x-input-label for="visit_date" :value="__('Data')" />
                            <x-text-input id="visit_date" class="block mt-1 w-full" type="date" name="visit_date" required autofocus value="{{now()->format('Y-m-d')}}" />
                            <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                            <x-input-label for="reason" :value="__('Motivazione della visita')" />
                            <x-text-input id="reason" class="block mt-1 w-full" type="text" name="reason" required />
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                            <x-input-label for="diagnosis" :value="__('Diagnosi')" />
                            <x-text-input id="diagnosis" class="block mt-1 w-full" type="text" name="diagnosis" />
                            <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                            <x-input-label for="reservation" :value="__('Prenotazione')" />
                            <x-select name="reservation" class="block mt-1 w-full" :options="['Istituzionale' => 'Istituzionale', 'Intramoenia' => 'Intramoenia']"  />
                            <x-input-error :messages="$errors->get('reservation')" class="mt-2" />
                            <x-input-label for="note" :value="__('Nota')" />
                            <textarea id="note" rows="4" name="note" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Scrivi la tua nota qui..."></textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            <div>
                                <x-primary-button class="mt-4">
                                    {{ __('Crea Visita') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
