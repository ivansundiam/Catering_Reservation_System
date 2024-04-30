<x-admin-layout>
    <x-slot name="title">
        {{ __('Inventory | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="w-full px-6 py-3 bg-white rounded-t-lg shadow-md">
                    <div class="flex items-start">
                        <p class="text-xl font-semibold grow">Inventory</p>

                        <div class="relative flex items-center justify-between mt-5 divide-x-2 md:m-0">
                            <div class="relative">
                                @livewire('inventory.add-item-form')
                            </div>                           
                        </div>
                    </div>

                    <form method="GET" id="filter-form" action="{{ route('inventory.index') }}" class="flex items-end justify-between overflow-x-scroll md:justify-between no-scrollbar">
                        <div class="relative flex divide-x-2">
                            <div class="pr-1 md:py-1 md:pr-4">
                                <x-label for="category">Category</x-label>
                                <select name="category" id="category" class="w-auto input-field" onchange="submitForm()">
                                    <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="CATERING EQUIPMENT" {{ request('category') == 'CATERING EQUIPMENT' ? 'selected' : '' }}>CATERING EQUIPMENT</option>
                                    <option value="CHAIRS & TABLES" {{ request('category') == 'CHAIRS & TABLES' ? 'selected' : '' }}>CHAIRS & TABLES</option>
                                </select>
                            </div>

                            <div class="px-1 md:py-1 md:px-4">
                                <x-label for="quantity-status">Quantity Status</x-label>
                                <select name="quantity-status" id="quantity-status" class="w-auto input-field" onchange="submitForm()">
                                    <option value="all" {{ request('quantity-status') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="low" {{ request('quantity-status') == 'low' ? 'selected' : '' }}>low</option>
                                    <option value="very low" {{ request('quantity-status') == 'very low' ? 'selected' : '' }}>very low</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="self-end ">
                            <x-input type="text" name="search" class="w-auto mx-1 input-field md:my-1 md:ml-4" placeholder="Search" id="search field" />
                        </div>
                    </form>
                </div>

                <div class="relative pb-16 overflow-x-scroll no-scrollbar">
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
                    
                                                @livewire('inventory.cancel-modal', ['item' => $item])
                                            </x-slot>
                    
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="7" class="text-xl text-center text-gray-400">
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
    @push('scripts')
        <script>
            function submitForm() {
                document.getElementById('filter-form').submit();
            }
        </script>
    @endpush
</x-admin-layout>
