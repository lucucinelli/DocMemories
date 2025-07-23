<div>
    
   <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Elenco dei pazienti') }}
            </h2>
        </x-slot> 
        
        <div class="max-w-4xl mx-auto mt-10">
            <form class="w-full sm:mx-6">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white 2-4"> Cerca </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digita qui il nome e il cognome del paziente..." required />
                    <button type="submit" class="text-white w-24 absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Cerca </button>
                </div>
            </form>
        </div>

        <div class="py-9">
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
                                        <td class="px-6 py-4 whitespace-nowrap ">
                                            <form action="{{ route('deletePatient', $patient->id) }}" method="POST" class="" onsubmit="return confirm('{{ __('Sei sicuro di voler eliminare questo paziente?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" text-red-600 hover:text-red-900 dark:text-red-600 dark:hover:text-red-900">{{ __('Elimina') }}</button>
                                            </form>
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
                    <div class="ml-4 mr-4 bg-gray-300 dark:bg-gray-200 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold">{{ $patient->name }} {{ $patient->surname }}</h3>
                        <p>{{ __('Data di nascita: ') . $patient->birthdate->format('d/m/Y') }}</p>
                        <p>{{ __('Genere: ') . ($patient->gender === 'M' ? 'Maschio' : 'Femmina') }}</p>
                        <p>{{ __('Telefono: ') . $patient->telephone }}</p>
                        <p>{{ __('Email: ') . $patient->email }}</p>
                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('showPatient', $patient->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-600 dark:hover:text-blue-900">{{ __('Visualizza') }}</a>
                            <form action="{{ route('deletePatient', $patient->id) }}" method="POST" class="" onsubmit="return confirm('{{ __('Sei sicuro di voler eliminare questo paziente?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" text-red-600 hover:text-red-900 dark:text-red-600 dark:hover:text-red-900">{{ __('Elimina') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</div>
