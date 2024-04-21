<x-admin-layout>
    <x-slot name="title">
        {{ __('Inventory | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center">
                        <p class="mr-3 text-xl">Inventory  </p>
     
                        @livewire('inventory.add-item-form')
                         
                     </div>
                     <form action="{{ route('inventory.index') }}" method="get">
                         <x-input type="text" name="search" class="input-field" placeholder="Search" id="search field" />
                     </form>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                        <thead class="text-base text-gray-700 uppercase bg-primary-light">
                            <tr>
                                <th class="px-6 py-3">
                                    Id
                                </th>
                                <th class="px-6 py-3">
                                    Item Name
                                </th>
                                <th class="px-6 py-3">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Price
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventoryItems as $index => $item)
                                <tr class="border-b {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white'; }}">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->item_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $item->category }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ number_format($item->price, 2, '.', ',') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-1 ">
                                        <div class="flex justify-center">
                                            <a href="{{ route('inventory.show', $item) }}" class="size-8 !p-0 btn-info">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="6" class="px-6 py-4 text-xl text-center text-gray-400">
                                    No items
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <x-pagination-links :model="$inventoryItems" />            
  
            </div>
        </div>
    </div>
</x-admin-layout>
