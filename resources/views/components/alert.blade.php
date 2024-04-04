@props(['id', 'type'])

@php
  $colors = [
    'success' => 'green',
    'danger' => 'red',
    'warning' => 'yellow',
    'info' => 'blue',
];
$color = $colors[$type] ?? 'green';
@endphp

@if(session($type))
  <div id="alert-{{ $id }}" class="z-100 flex bg-{{ $color }}-100 items-center p-4 mb-4 text-{{ $color }}-800 rounded-lg w-[96%] md:w-[70%] lg:w-[40%] mx-auto fixed top-5 left-[calc(50%-48vw)] md:left-[calc(50%-35vw)] lg:left-[calc(50%-20vw)] " role="alert">
      <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <div class="text-sm font-medium ms-3">
        {{ session($type) }}
      </div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-{{ $color }}-50 text-{{ $color }}-500 rounded-lg focus:ring-2 focus:ring-{{ $color }}-400 p-1.5 hover:bg-{{ $color }}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-{{ $color }}-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-{{ $id }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
      </button>
    </div>
@endif 