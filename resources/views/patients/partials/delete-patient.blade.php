<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cancella paziente') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una volta che il paziente è stato eliminato, tutte le sue risorse e i dati saranno permanentemente eliminati. Prima di eliminare il paziente, si prega di scaricare eventuali dati o informazioni che si desidera conservare.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-patient-deletion')"
    >{{ __('Cancella paziente') }}</x-danger-button>

    <x-modal name="confirm-patient-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('deletePatient', $patient->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Sei sicuro di voler eliminare questo paziente?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Una volta che il paziente è stato eliminato, tutte le sue risorse e i dati saranno permanentemente eliminati. Desideri procedere comunque?') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annulla') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Cancella paziente') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
