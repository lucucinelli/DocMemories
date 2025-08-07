<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <i class="mr-2 bi bi-database-up"></i> {{ __('Esporta dati') }}
</h2>
<p class="mt-1 mb-5 text-sm text-gray-600 dark:text-gray-400">
    {{ __("Esporta i tuoi dati in .csv per averli sempre con te!") }}
</p>
<div class="flex flex-row gap-10 mt-3">
    <x-select :label="__('Scegli il tipo di esportazione')" 
        :options="[
            'pazienti' => 'patients',
            'visite' => 'visits',
            'anamnesi fisiologiche' => 'physiologicalHistories',
            'anamnesi familiari' => 'familiarHistories',
            'anamnesi patologiche prossime' => 'nextPathologicalHistories',
            'anamnesi patologiche remote' => 'remotePathologicalHistories',
            'test allergologici' => 'tests',
            'medicinali somministrati' => 'medicinals',
            'esami' => 'exams',
        ]"
        name="export_file"
        id="export_file"
        class="mb-4"> </x-select>
    <div class="flex">
        <x-secondary-button class="mb-4 bg-green-500 dark:bg-green-700" id="export_button_patients"><a href="{{ route('exportPatients') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_visits"><a href="{{ route('exportVisits') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_physiological_histories"><a href="{{ route('exportPhysiologicalHistories') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_familiar_histories"><a href="{{ route('exportFamiliarHistories') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_remote_pathological_histories"><a href="{{ route('exportRemotePathologicalHistories') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_next_pathological_histories"><a href="{{ route('exportNextPathologicalHistories') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_medicinals"><a href="{{ route('exportMedicinals') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_tests"><a href="{{ route('exportTests') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
        <x-secondary-button class="mb-4 hidden bg-green-500 dark:bg-green-700" id="export_button_exams"><a href="{{ route('exportExams') }}" target="_blank" class="text-md text-gray-700 dark:text-gray-300">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
            </a>
        </x-secondary-button>
    </div>
</div>