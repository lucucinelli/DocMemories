<div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 ">
            <!-- Form for creating a new patient -->
            <form method="post" id="physiological-history-form" action="{{ isset($physiologicalHistory) ? route('editPhysiologicalHistory', $patient->id) : route('newPhysiologicalHistory', $patient->id) }}">
                @csrf
                @if(isset($physiologicalHistory))
                    @method('PUT')
                @endif
        
                <div class="flex flex-col gap-3">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Informazioni fisiologiche') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Compila i campi per aggiornare le informazioni fisiologiche.") }}
                    </p>
                    <x-input-label for="birth" :value="__('Nascita')" />
                    <x-text-input id="birth" class="block mt-1 w-full anagrafica" type="text" name="birth"  autofocus value="{{ $physiologicalHistory->birth ?? '' }}" />
                    <x-input-error :messages="$errors->get('birth')" class="mt-2" />
                    <x-input-label for="atopy" :value="__('Atopia')" />
                    <x-select id="atopy" class="block mt-1 w-full anagrafica" name="atopy"  autofocus :options="['No' => false, 'Sì' => true]" :selected="$physiologicalHistory->atopy ?? 'false'" />
                    <x-input-error :messages="$errors->get('atopy')" class="mt-2" />
                    <x-input-label for="nursing" :value="__('Allattamento')" />
                    <x-text-input id="nursing" class="block mt-1 w-full anagrafica" type="text" name="nursing"  autofocus value="{{ $physiologicalHistory->nursing ?? '' }}"/>
                    <x-input-error :messages="$errors->get('nursing')" class="mt-2" />
                    <x-input-label for="diet" :value="__('Dieta')" />
                    <x-text-input id="diet" class="block mt-1 w-full anagrafica" type="text" name="diet"  value="{{ $physiologicalHistory->diet ?? '' }}" />
                    <x-input-error :messages="$errors->get('diet')" class="mt-2" />
                    <x-input-label for="habits" :value="__('Abitudini')" />
                    <x-text-input id="habits" class="block mt-1 w-full anagrafica" type="text" name="habits"  value="{{ $physiologicalHistory->habits ?? '' }}" />
                    <x-input-error :messages="$errors->get('habits')" class="mt-2" />
                    @if($patient->gender === 'F')
                        <div class="pt-4 pb-1 bordo-t-3 border-black dark:border-gray-600 mt-4 flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ciclo mestruale') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Altre informazioni") }}
                            </p>
                            <x-input-label for="period" :value="__('Inizio ciclo')" />
                            <x-text-input id="period" class="block mt-1 w-full anagrafica" type="text" name="period" value="{{ $physiologicalHistory->period ?? '' }}" />
                            <x-input-error :messages="$errors->get('period')" class="mt-2" />
                            <x-input-label for="period_regularity" :value="__('Regolarità ciclo')" />
                            <x-text-input id="period_regularity" class="block mt-1 w-full anagrafica" type="text" name="period_regularity" value="{{ $physiologicalHistory->period_regularity ?? '' }}" />
                            <x-input-error :messages="$errors->get('period_regularity')" class="mt-2" />
                        </div>
                    @endif
                    
                </div>
                <div class="mt-4">
                    @if (isset($physiologicalHistory))
                        <x-secondary-button id="edit-button" onclick="toggleEditMode()">{{ __('Modifica') }}</x-secondary-button>
                        <x-secondary-button id="cancel-button" type="reset" onclick="toggleEditMode()" class="hidden">{{ __('Annulla') }}</x-secondary-button>
                        <x-primary-button id="save-button" type="submit" class="hidden">{{ __('Salva') }}</x-primary-button>
                    @else
                        <x-primary-button >
                            {{ __('Registra anamnesi') }}
                        </x-primary-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
