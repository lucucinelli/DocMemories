<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Anagrafica') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Qui trovi le informazioni anagrafiche del paziente.") }}
        </p>
    </header>

    <div class="mt-6">
        <dl class="space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Nome') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->name }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Cognome') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->surname }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Data di nascita') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->birthdate->format('d/m/Y') }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Genere') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->gender === 'M' ? 'Maschio' : 'Femmina' }}
                    </dd>
                </div>
            </div>
        </dl>
    </div>
    <div class="mt-6">
        <dl class="space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Nazionalità') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->nationality }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Luogo di nascita') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->birthplace }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Provincia di nascita') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->province }}
                    </dd>
                </div>
                <div >
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Indirizzo') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->address }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Numero civico') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->street_number }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('CAP') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->zip_code }}
                    </dd>
                </div>
            </div>
        </dl>
    </div>
    <div class="mt-6">
        <dl class="space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Codice fiscale') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->tax_code }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Telefono') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->telephone }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Email') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->email }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Occupazione') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $patient->occupation }}
                    </dd>
                </div>
            </div>
        </dl>
    </div>
</section>
