@props(['size' => '34', 'id', 'placement' => 'top', 'width' => 'auto'])

<button data-tooltip-target="{{ $id }}" data-tooltip-trigger="click" data-tooltip-placement="{{ $placement }}" data-tooltip-style="light" type="button" class="text-white">
    <svg fill="#8a8a8a" width="{{ $size }}px" height="{{ $size }}px" viewBox="0 0 36 36" version="1.1" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path class="clr-i-solid clr-i-solid-path-1" d="M18,6A12,12,0,1,0,30,18,12,12,0,0,0,18,6Zm-2,5.15a2,2,0,1,1,2,2A2,2,0,0,1,15.9,11.15ZM23,24a1,1,0,0,1-1,1H15a1,1,0,1,1,0-2h2V17H16a1,1,0,0,1,0-2h4v8h2A1,1,0,0,1,23,24Z"></path> <rect x="0" y="0" width="36" height="36" fill-opacity="0"></rect> </g></svg>                    
</button>
    <div id="{{ $id }}" role="tooltip" class="absolute z-10 flex flex-col invisible w-{{ $width }} px-3 py-2 text-xs font-medium text-gray-700 bg-gray-200 border-2 border-gray-300 rounded-lg shadow-sm opacity-0 transition-translate duration-300 md:text-sm tooltip">
    {{ $slot }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>