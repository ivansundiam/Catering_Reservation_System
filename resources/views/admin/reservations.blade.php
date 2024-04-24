<x-admin-layout>
    <x-slot name="title">
        {{ __('Reservations | ' . config('app.name')) }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="w-full px-6 py-3 bg-white rounded-t-lg shadow-md">
                    <div class="flex items-start">
                        <p class="text-xl font-semibold grow">Reservations</p>

                        <div class="relative flex items-center justify-between mt-5 divide-x-2 md:m-0">
                            <div class="relative">
                                @livewire('report.print-reservation')
                            </div>                           
                        </div>
                    </div>
                    <form method="GET" id="filter-form" action="{{ route('admin.reservations') }}" class="flex items-end justify-between overflow-x-scroll md:justify-between no-scrollbar">
                        <div class="relative flex divide-x-2"> 
                            <div class="pr-4">
                                <x-label for="package">Package</x-label>
                                <select name="package" id="package" class="w-auto input-field" onchange="submitForm()">
                                    <option value="all" {{ request('package') == 'all' ? 'selected' : '' }}>All</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" {{ request('package') == $package->id ? 'selected' : '' }}>{{ __($package->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="px-4">
                                <x-label for="status">Status</x-label>
                                <select name="status" id="status" class="w-auto input-field" onchange="submitForm()">
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>All</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending Payment</option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                    
                            <div class="px-4">
                                <x-label for="date">Date</x-label>
                                <select name="date" id="date" class="w-auto input-field" onchange="submitForm()">
                                    <option value="all" {{ request('date') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Week</option>
                                    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Month</option>
                                    <option value="year" {{ request('date') == 'year' ? 'selected' : '' }}>Year</option>
                                </select>
                            </div>

                        </div>
                        
                        <div class="relative">
                            <x-input type="text" name="search" class="w-auto mx-1 input-field md:my-1 md:ml-4" placeholder="Search" id="search field" />
                        </div>
                    </form>
                </div>

                <div class="relative pb-16 overflow-x-scroll no-scrollbar">
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
                                    Pax
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
                                        {{ $reservation->pax}}
                                    </td>
                                    <td>
                                        {{ $reservation->date->format('M d, Y') }}
                                    </td>
                                    <td>
                                        {{ $reservation->time->format('g:i a') }}
                                    </td>
                                    <td class="text-center text-nowrap">
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
                                    <td colspan="8" class="py-2 text-xl text-center text-gray-400">No reservations</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>

                <x-pagination-links :model="$reservations" />
                
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