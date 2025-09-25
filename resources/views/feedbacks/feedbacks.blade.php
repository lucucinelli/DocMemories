<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border-2 border-red-500  dark:border-orange-600 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <!-- Form for creating a new patient -->
                    <form method="POST" action="{{ route('sendFeedback') }}">
                        @csrf
                        <!-- Include form fields here -->

                        <div class="flex flex-col gap-3">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Feedback') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Compila il modulo per lasciare un suggerimento anonimo.') }}
                            </p>
                            <x-select name="feedback_type" class="block mt-1 w-full" :options="['Problema' => 'Problema', 'Suggerimento' => 'Suggerimento']"  />
                            <x-input-error :messages="$errors->get('feedback_type')" class="mt-2" />
                            <x-input-label for="note" :value="__('Tipo di feedback')" />
                            <textarea id="note" rows="4" name="note" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Scrivi il tuo feedback qui..."></textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            <div>
                                <x-primary-button id="submit-button" class="mt-4">
                                    {{ __('Invia') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script> 
    document.addEventListener('DOMContentLoaded', function () {
        const note = document.getElementById('note');
        if (note.value.trim() === '') {
            document.getElementById('submit-button').disabled = true;
        } else {
            document.getElementById('submit-button').disabled = false;
        }
    });
</script>