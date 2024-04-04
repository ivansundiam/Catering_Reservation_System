<x-app-layout>

    @if(session('success'))
      <x-alert id="success" message="{{ session('success') }}" type='success' />
    @endif    

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-10 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <a href="{{ route('reservation.create') }}" class="px-6 py-3 m-10 btn-primary-outline">book reservation</a>
            </div>
        </div>
    </div>
</x-app-layout>
