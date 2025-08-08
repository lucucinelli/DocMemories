<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Monitora dalla pagina dashboard i tuoi dati e appunta quello che desideri.") }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- report -->
                    @include('dashboard-report')
                </div>
            </div>
        </div>
        <div class="mt-14 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Exports -->
                    @include('dashboard-exports')
                </div>
            </div>
        </div>
        <div class="mt-3 max-w-7xl mx-auto sm:px-6">
            <div class="p-3 text-gray-900 dark:text-gray-100">
                <!-- Block notes -->
                <div class="w-full max-w-7xl mx-auto mt-8">
                    <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 shadow-md rounded-xl overflow-hidden transition-all duration-300">
                    
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-orange-500 to-red-700 text-white px-6 py-4 flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 6H21M8 12H21M8 18H21M3 6H3.01M3 12H3.01M3 18H3.01" />
                                </svg>
                                <h2 class="text-lg font-semibold tracking-wide"> Promemoria </h2>
                            </div>
                            <button onclick="clearNotes()" class="text-base font-medium hover:underline hover:text-red-200"><i class="bi bi-trash3-fill"></i> Cancella</button>
                        </div>

                        <!-- Body -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-800 transition-colors">
                            <textarea id="notes"
                                    class="w-full h-72 max-h-[400px] bg-white dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 border border-gray-300 dark:border-gray-700 rounded-md p-4 text-gray-800 resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none leading-relaxed placeholder-gray-400"
                                    placeholder="Scrivi qui le tue annotazioni, idee, promemoria, attività della giornata..."></textarea>
                        </div>

                        <!-- Footer -->
                        <div class="bg-gray-100 dark:bg-gray-800 px-6 py-3 text-right text-sm text-gray-600 dark:text-gray-400">
                            <span id="saveStatus" class="hidden text-green-600 dark:text-green-400"><i class="bi bi-hand-thumbs-up-fill"></i> Salvato</span>
                        </div>
                    </div>
                </div>
                <!-- Modal conferma -->
                <div id="confirmModal" class="fixed flex inset-0 z-50 hidden bg-black bg-opacity-50 items-center justify-center">
                    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg w-full max-w-md border dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Sei sicuro?</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Questa azione cancellerà definitivamente le tue note salvate.</p>
                        <div class="flex justify-end gap-3">
                        <button onclick="hideModal()" class="px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Annulla
                        </button>
                        <button onclick="confirmClearNotes()" class="px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-600 transition">
                            Cancella
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/dashboard-report.js')
@vite('resources/js/dashboard-export.js')
@vite('resources/js/block-notes.js')