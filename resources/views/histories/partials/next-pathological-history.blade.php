<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="POST" >
                @csrf
                <!-- Include form fields here -->

                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Problematiche del paziente') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni del paziente.") }}
                    </p>

                    <x-input-label for="next-date" :value="__('Data')" />
                    <x-text-input id="next-date" class="block mt-1 w-full" type="date" name="date" value="{{ now()->format('Y-m-d') }}" required  /> 
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />


                    <x-input-label for="type" :value="__('Tipo di problematica')" />
                    <x-select name="type" id="type" class="block mt-1 w-full" :options="['respiratori' => 'Respiratori', 'dermatologici' => 'Dermatologici', 'alimenti' => 'Alimentari', 'farmaci' => 'Farmacologici', 'veleno' => 'Veleno di imenotteri', 'ALTRO' => 'Altro']" required />
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />

                    <x-input-label for="problem" id='problem-label' :value="__('Problematica')" class="hidden"/>
                    <x-text-input id="problem" class=" mt-1 w-full hidden" type="text" name="problem" value="{{ old('problem') }}" />
                    <x-input-error :messages="$errors->get('problem')" class="mt-2" />

                    <x-input-label for="name" :value="__('Nome')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required value="{{ old('name') }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <x-input-label for="cause" :value="__('Causa')" />
                    <x-text-input id="cause" class="block mt-1 w-full" type="text" name="cause" required value="{{ old('cause') }}" />
                    <x-input-error :messages="$errors->get('cause')" class="mt-2" />

                    <x-input-label for="effect" :value="__('Effetto')" />
                    <x-text-input id="effect" class="block mt-1 w-full" type="text" name="effect" required value="{{ old('effect') }}" />
                    <x-input-error :messages="$errors->get('effect')" class="mt-2" />

                    <x-input-label for="note" :value="__('Nota')" />
                    <textarea name="note" placeholder="Inserisci una nota..." class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2">{{ old('note') }}</textarea>
                </div>
                <div>
                    <x-primary-button class="mt-4">
                        {{ __('Registra anamnesi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
