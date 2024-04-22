<x-admin-layout>
    <x-slot name="title">
        {{ __('Inventory | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="px-6 rounded-t-lg py-3 shadow-md w-full bg-white">
                    <div class="flex flex-col md:flex-row items-start md:justify-between divide-x-2 overflow-x-scroll no-scrollbar">
                        <p class="mr-3 text-xl font-semibold">Inventory  </p>

                        <div class="divide-x-2 flex justify-between items-center mt-5 md:m-0 relative">
                            <div class="relative md:pb-5">
                                <div class="flex md:before:content-['actions'] before:absolute before:bottom-0 before:text-sm mx-1 md:mx-4 before:text-gray-400 before:left-[30%]">
                                    
                                    @livewire('inventory.add-item-form')

                                    <a href="{{ route('generate-pdf') }}" type="button" class="flex mx-1 size-8 btn-info justify-center items-center !p-1 my-2">
                                        <svg width="18" height="18" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.35254 9.38456V10.3518H9.79316V9.38456H4.35254ZM4.35254 7.77034V8.73758H9.79316V7.77034H4.35254ZM1.08817 8.73758H2.17629V11.321C2.17266 12.1055 2.37506 12.2889 3.26442 12.2889H10.8813C11.7706 12.2889 11.9694 12.1429 11.9694 11.321V8.73758H13.0575C13.9824 8.75049 14.1562 8.56744 14.1457 7.7697V4.21842C14.1457 3.45974 14.0078 3.24925 13.0575 3.24925H11.9694V1.63568C11.9799 0.838256 11.8062 0.666504 10.8813 0.666504H3.26442C2.39392 0.666504 2.17266 0.85117 2.17629 1.63568V3.24925H1.08817C0.152381 3.24925 4.36559e-05 3.43069 4.36559e-05 4.21842V7.7697C-0.00358342 8.5542 0.217668 8.75049 1.08817 8.73758ZM10.8813 11.3203H3.26442V7.12336H10.8813V11.3203ZM11.5632 5.34837C11.5632 5.05781 11.8243 4.82569 12.1508 4.82569C12.4772 4.82569 12.7383 5.05781 12.7383 5.34837C12.7383 5.63893 12.4772 5.87138 12.1508 5.87138C11.8243 5.87138 11.5632 5.63893 11.5632 5.34837ZM3.26442 1.63503H10.8813V3.25054H3.26442V1.63503Z" fill="white"/>
                                            <title>Print</title>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                             
                            <div class="relative md:pb-5">
                                <div class="md:before:content-['filter'] before:absolute before:bottom-0 before:text-sm before:text-gray-400 before:left-[37%]">
                                    <select name="" id="" class="w-auto input-field mx-1 md:my-1 md:mx-4">
                                        <option value="">fasdf</option>
                                    </select>
                                </div>    
                            </div>
    
                            <div class="relative md:pb-5">
                                <form action="{{ route('inventory.index') }}" method="get" class="md:before:content-['search'] before:absolute before:bottom-0 before:text-sm before:text-gray-400 before:left-[45%]">
                                    <x-input type="text" name="search" class="w-auto input-field mx-1 md:my-1 md:ml-4" placeholder="Search" id="search field" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-scroll no-scrollbar pb-16">
                    <x-table>
                        <x-slot name="thead">
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Item Name
                                </th>
                                <th>
                                    Description
                                </th>
                                <th class="text-center">
                                    Category
                                </th>
                                <th class="text-center">
                                    Price
                                </th>
                                <th class="text-center">
                                    Quantity
                                </th>
                                <th class="text-center">
                                </th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($inventoryItems as $item)
                                @php
                                    $rowColor = '';
                                    if ($item->quantity <= 100 && $item->quantity >= 51) {
                                        $rowColor = '!bg-amber-100';
                                    } else if ($item->quantity <= 50) {
                                        $rowColor = '!bg-red-100';
                                    } else {
                                        $rowColor = '!bg-white';
                                    }
                                @endphp
                                <tr class="rounded-lg {{ $rowColor }}">
                                    <td class="font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->item_name }}
                                    </td>
                                    <td>
                                        {{ $item->description }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->category }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($item->price, 2, '.', ',') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-2xl text-right">
                                        <x-dropdown width="48" align="right">
                                            <x-slot name="trigger">
                                                <button type="button" class="font-bold text-gray-400 select-none">&#8942;</button>
                                            </x-slot>
                    
                                            <x-slot name="content" class="absolute z-50">
                                                <x-dropdown-link href="{{ route('inventory.show', $item->id) }}">
                                                    {{ __('View') }}
                                                </x-dropdown-link>
                    
                                                <x-dropdown-link href="{{ route('inventory.show', $item->id) }}">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                    
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="6" class="text-xl text-center text-gray-400">
                                    No items
                                </td>
                            </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>
                
                <x-pagination-links :model="$inventoryItems" />            
  
            </div>
        </div>
    </div>
</x-admin-layout>
