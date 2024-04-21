<x-admin-layout>
    <x-slot name="title">
        {{ __('Inventory | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center">
                        <p class="mr-3 text-xl">Inventory  </p>
     
                        @livewire('inventory.add-item-form')
                         
                     </div>
                     <form action="{{ route('inventory.index') }}" method="get">
                         <x-input type="text" name="search" class="input-field" placeholder="Search" id="search field" />
                     </form>
                </div>
                <div class="relative">
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
                                <tr class="rounded-lg">
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
