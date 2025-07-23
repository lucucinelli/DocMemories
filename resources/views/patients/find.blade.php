
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elenco dei pazienti') }}
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="hidden sm:block">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-300 border-b border-gray-200 dark:border-gray-200">
                        <table class="min-w-full table-auto dark:bg-gray-300">
                            <thead  class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"  data-index="0" data-sort="text" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Nome') }} <i class="bi bi-arrow-down-up ml-3"></i>
                                    </th>
                                    <th scope="col" data-index="1" data-sort="text" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Cognome') }} <i class="bi bi-arrow-down-up ml-3"></i>
                                    </th>
                                    <th scope="col" data-index="2" data-sort="date"class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Data di nascita') }} <i class="bi bi-arrow-down-up ml-3"></i>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Genere') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Telefono') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Email') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Visualizza') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-white uppercase tracking-wider">
                                        {{ __('Elimina') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-300 divide-y">
                                @foreach($patients as $patient)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->surname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->birthdate->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->gender === 'M' ? 'Maschio' : 'Femmina' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->telephone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $patient->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('showPatient', $patient->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-600 dark:hover:text-blue-900">{{ __('Visualizza') }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap align-middle">

                                        <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-600 dark:hover:text-red-900" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-patient-deletion')">{{ __('Elimina') }}</button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirm Patient Deletion Modal -->
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
        {{-- Mobile view --}}
        <div class= "block sm:hidden  mt-2 space-y-6">
            @foreach($patients as $patient)
                <div class="ml-4 mr-4 bg-gray-300 dark:bg-gray-200 p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold">{{ $patient->name }} {{ $patient->surname }}</h3>
                    <p>{{ __('Data di nascita: ') . $patient->birthdate->format('d/m/Y') }}</p>
                    <p>{{ __('Genere: ') . ($patient->gender === 'M' ? 'Maschio' : 'Femmina') }}</p>
                    <p>{{ __('Telefono: ') . $patient->telephone }}</p>
                    <p>{{ __('Email: ') . $patient->email }}</p>
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('showPatient', $patient->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-600 dark:hover:text-blue-900">{{ __('Visualizza') }}</a>

                        <button type="submit" class=" text-red-600 hover:text-red-900 dark:text-red-600 dark:hover:text-red-900" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-patient-deletion')">{{ __('Elimina') }}</button>

                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</x-app-layout>
