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
    <div class="">
        <a href="{{ route('exportPatients') }}" target="_blank" id="export_button_patients" class="inline-block px-4 py-2 text-sm bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportVisits') }}" target="_blank" id="export_button_visits" class=" px-4 py-2 text-sm hidden bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportPhysiologicalHistories') }}" target="_blank" id="export_button_physiological_histories" class=" px-4 py-2 text-sm hidden bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportFamiliarHistories') }}" target="_blank" id="export_button_familiar_histories" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportRemotePathologicalHistories') }}" target="_blank" id="export_button_remote_pathological_histories" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportNextPathologicalHistories') }}" target="_blank" id="export_button_next_pathological_histories" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        </button>
        <a href="{{ route('exportMedicinals') }}" target="_blank" id="export_button_medicinals" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}    
        </a>
        <a href="{{ route('exportTests') }}" target="_blank" id="export_button_tests" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
        <a href="{{ route('exportExams') }}" target="_blank" id="export_button_exams" class=" px-4 py-2 text-sm hidden  bg-green-400 dark:bg-green-800 border border-green-300 dark:border-green-500 font-semibold rounded  transition text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-green-50 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25  ease-in-out duration-150">
            <i class="bi bi-file-earmark-arrow-down"></i>
            {{ __('Esporta') }}
        </a>
    </div>
</div>