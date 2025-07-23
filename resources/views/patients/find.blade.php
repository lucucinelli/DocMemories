<div>
    
   <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Elenco dei pazienti') }}
            </h2>
        </x-slot> 
        

        <div>
            <form class="max-w-lg mx-auto">
                <div class="flex">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg></button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mockups</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Templates</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Design</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button>
                        </li>
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Mockups, Logos, Design Templates..." required />
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>


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
