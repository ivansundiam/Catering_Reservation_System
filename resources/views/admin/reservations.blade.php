<x-admin-layout>
    <x-slot name="title">
        {{ __('Reservations | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between mb-5 align-baseline">
                    <div class="flex">
                        <p class="text-xl">Reservations</p>
                        <a href="{{ route('generate-pdf') }}" type="button" class="flex btn-info">print</a>
                    </div>
    
                    <form action="{{ route('admin.reservations') }}" method="get">
                        <x-input type="text" name="search" class="input-field" placeholder="Search" id="search field" />
                    </form>
                </div>

                <div class="relative">
                    <x-table>
                        <x-slot name="thead">
                            <tr>
                                <th>
                                    Client Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th class="text-center">
                                    Package
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Time
                                </th>
                                <th>
                                    Status
                                </th>
                                <th class="text-center">
                                </th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($reservations as $index => $reservation)
                                @php
                                    $userArchived = $reservation->user == null;
                                    if ($userArchived) {
                                        $rowColor = '!bg-red-100';
                                    } else {
                                        $rowColor = 'bg-white';
                                    }
                    
                                    $statusClasses = $reservation->payment_percent == 100 ? 'text-green-500 bg-green-100 py-1 px-2 rounded-full' : 'text-primary bg-amber-100 py-1 px-2 rounded-full';
                                @endphp
                                <tr class="rounded-lg {{ $rowColor }}">
                                    <td @if($userArchived) colspan="2" @endif scope="row" class=" font-medium whitespace-nowrap {{ $userArchived ? '!text-gray-500' : 'text-gray-900' }}">
                                        {{ optional($reservation->user)->name ?: 'User Archived' }}
                                    </td>
                                    <td class=" {{ $userArchived ? 'hidden' : '' }}">
                                        {{ optional($reservation->user)->email ?: 'N/A' }}
                                    </td>
                                    <td class="text-center ">
                                        {{ $reservation->package->name }}
                                    </td>
                                    <td>
                                        {{ $reservation->date->format('M d, Y') }}
                                    </td>
                                    <td>
                                        {{ $reservation->time->format('g:i a') }}
                                    </td>
                                    <td class=" text-nowrap">
                                        <span class="{{ $statusClasses }}">{{ $reservation->payment_percent == 100 ? 'Paid' : 'Pending Payment' }}</span>
                                    </td>
                                    <td class="text-2xl text-right">
                                        <x-dropdown width="48" align="right">
                                            <x-slot name="trigger">
                                                <button type="button" class="font-bold text-gray-400 select-none">&#8942;</button>
                                            </x-slot>
                    
                                            <x-slot name="content" class="absolute z-50">
                                                <x-dropdown-link href="{{ route('admin.reservation.show', $reservation->id) }}">
                                                    {{ __('View') }}
                                                </x-dropdown-link>
                    
                                                <x-dropdown-link href="{{ route('admin.reservation.show', $reservation->id) }}">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                    
                                        </x-dropdown>
                                    </td>
                                </tr>
                
                            @empty
                                <tr class="bg-white border-b">
                                    <td colspan="6" class="py-2 text-xl text-center text-gray-400">No reservations</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>

                <x-pagination-links :model="$reservations" />
                
            </div>
        </div>
    </div>
</x-admin-layout>
