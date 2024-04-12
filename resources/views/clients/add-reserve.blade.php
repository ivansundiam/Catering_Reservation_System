<x-app-layout> 
    <x-slot name="header">
        {{ __('Add reservation') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">

                @livewire('reservation-form')
                
            </div>
        </div>
    </div>
</x-app-layout>