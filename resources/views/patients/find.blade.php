<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
<div>
   <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Elenco dei pazienti') }}
            </h2>
        </x-slot> 
    
        <div class="py-12">
            <div class="hidden sm:block">
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                            <table class="min-w-full table-auto border-separate border-spacing-x-6 divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Nome') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Cognome') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Data di nascita') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Genere') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Telefono') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Email') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Visualizza') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-s font-medium text-black dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Elimina') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
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
                                            <a href="{{ route('showPatient', $patient->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600">{{ __('Visualizza') }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('deletePatient', $patient->id) }}" class="text-red-600 hover:text-gray-600 dark:text-red-600 dark:hover:text-white">{{ __('Elimina') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Mobile view --}}
            <div class= "block sm:hidden  mt-2 space-y-6">
                @foreach($patients as $patient)
                    <div class="ml-4 mr-4 bg-gray-200 dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold">{{ $patient->name }} {{ $patient->surname }}</h3>
                        <p>{{ __('Data di nascita: ') . $patient->birthdate->format('d/m/Y') }}</p>
                        <p>{{ __('Genere: ') . ($patient->gender === 'M' ? 'Maschio' : 'Femmina') }}</p>
                        <p>{{ __('Telefono: ') . $patient->telephone }}</p>
                        <p>{{ __('Email: ') . $patient->email }}</p>
                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('showPatient', $patient->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600">{{ __('Visualizza') }}</a>
                            <a href="{{ route('deletePatient', $patient->id) }}" class="text-red-600 hover:text-gray-600 dark:text-red-600 dark:hover:text-white">{{ __('Elimina') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</div>
