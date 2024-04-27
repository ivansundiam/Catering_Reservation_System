<div>
    <button wire:click="show" type="button" class="flex size-8 btn-info justify-center items-center !p-1">
        <svg width="18" height="18" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M4.35254 9.38456V10.3518H9.79316V9.38456H4.35254ZM4.35254 7.77034V8.73758H9.79316V7.77034H4.35254ZM1.08817 8.73758H2.17629V11.321C2.17266 12.1055 2.37506 12.2889 3.26442 12.2889H10.8813C11.7706 12.2889 11.9694 12.1429 11.9694 11.321V8.73758H13.0575C13.9824 8.75049 14.1562 8.56744 14.1457 7.7697V4.21842C14.1457 3.45974 14.0078 3.24925 13.0575 3.24925H11.9694V1.63568C11.9799 0.838256 11.8062 0.666504 10.8813 0.666504H3.26442C2.39392 0.666504 2.17266 0.85117 2.17629 1.63568V3.24925H1.08817C0.152381 3.24925 4.36559e-05 3.43069 4.36559e-05 4.21842V7.7697C-0.00358342 8.5542 0.217668 8.75049 1.08817 8.73758ZM10.8813 11.3203H3.26442V7.12336H10.8813V11.3203ZM11.5632 5.34837C11.5632 5.05781 11.8243 4.82569 12.1508 4.82569C12.4772 4.82569 12.7383 5.05781 12.7383 5.34837C12.7383 5.63893 12.4772 5.87138 12.1508 5.87138C11.8243 5.87138 11.5632 5.63893 11.5632 5.34837ZM3.26442 1.63503H10.8813V3.25054H3.26442V1.63503Z"
                fill="white" />
            <title>Print</title>
        </svg>
    </button>

    <x-modal wire:model="showing" maxWidth="5xl">
        <div class="px-6 py-2 text-lg font-medium bg-blue-500 text-gray-50 dark:text-gray-100">
            Sales Report
        </div>

        <div class="px-6 py-4 overflow-x-scroll text-sm text-gray-600 bg-gray-100 dark:text-gray-400 no-scrollbar">
            <div class="grid gap-2 py-2 sm:grid-cols-2 lg:grid-cols-4 sm:ml-0">
                <div class="w-full">
                    <x-label for="package">Package</x-label>
                    <select wire:model.change="selectedPackage" name="package" id="package"
                        class="w-full input-field">
                        <option value="all" {{ request('package') == 'all' ? 'selected' : '' }}>All</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}"
                                {{ request('package') == $package->id ? 'selected' : '' }}>{{ __($package->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full">
                    <x-label for="date">Date</x-label>
                    <select wire:model.change="selectedDate" name="date" id="date" class="w-full input-field">
                        <option value="all">All</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="annually">Annually</option>
                    </select>
                </div>

                <div class="w-full">
                    <x-label for="month">Month</x-label>
                    <select wire:model.change="selectedMonth" name="month" id="month" class="w-full input-field">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="w-full">
                    <x-label for="year">Year</x-label>
                    <select wire:model.change="selectedYear" name="year" id="year" class="w-full input-field">
                        <option value="all">All</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid mx-auto">
                <span class="mx-auto my-5 text-lg font-semibold capitalize">Report preview</span>

                <div class="w-[8.5in] h-[11in] p-[1in] bg-white mx-auto relative"
                    wire:loading.class="bg-gray-200 opacity-25" wire:loading.class.remove="bg-white">
                    <div wire:loading class="absolute flex m-auto top-5 left-5">
                        <svg class="animate-spin" width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612"
                                    stroke="#64748b" stroke-width="3.55556" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>

                    <header class="flex justify-between pb-2 border-b-2 border-black">
                        <div class="flex items-center text-black">
                            <x-application-mark />
                            <x-brand-name />
                        </div>

                        <div class="font-roman">
                            <h3 class="text-xl font-bold text-black">Sales Report</h3>
                            <span class="text-base text-gray-700">{{ date('M d, Y') }}</span>
                        </div>
                    </header>

                    <div class="font-roman flex flex-col items-center h-full pb-[1in] justify-between text-black">
                        <div class="w-full">
                            <h2 class="my-5 text-2xl font-bold text-center capitalize">
                                @if ($selectedDate == 'weekly')
                                    Weekly Report - {{ now()->startOfWeek()->format('F Y') }}
                                @elseif ($selectedDate == 'monthly')
                                    Monthly Report - {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }}
                                    {{ $selectedYear }}
                                @elseif ($selectedDate == 'annually')
                                    Annual Report - {{ $selectedYear }}
                                @else
                                    Overall Report
                                @endif
                            </h2>
                            <div class="overflow-y-scroll max-h-[4.6in] no-scrollbar">
                                <table class="w-full text-base text-left table-auto">
                                    <thead>
                                        <tr class="uppercase">
                                            <th class="pr-3">date</th>
                                            <th class="px-3">customer</th>
                                            <th class="px-3">menu</th>
                                            <th class="px-3">package</th>
                                            <th class="px-3">pax</th>
                                            <th class="pl-3">total cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reservations as $reservation)
                                            <tr>
                                                <td class="pr-3">
                                                    {{ $reservation->date->format('m-d-Y') }}
                                                </td>
                                                <td class="px-3">
                                                    {{ $reservation->user->name }}
                                                </td>
                                                <td class="px-3">
                                                    {{ $reservation->menu->name }}
                                                </td>
                                                <td class="px-3">
                                                    {{ str_replace(['Elegant', 'Package', 'Dinner / Lunch'], '', $reservation->package->name) }}
                                                </td>
                                                <td class="px-3">
                                                    {{ $reservation->pax }}
                                                </td>
                                                <td class="pl-3">
                                                    {{ number_format($reservation->total_cost, 2, '.', ',') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-3 text-center">No reservation</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <footer class="flex flex-col w-full mt-5 text-base text-black">
                            <div class="flex w-full">
                                @if ($selectedDate == 'annually')
                                    <div>
                                        <p class="font-bold">TOTAL - of All <span>{{ $selectedYear }}</span></p>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">RESERVATIONS: </p>
                                            <span class="font-normal"> {{ $reservationsCount }}</span>
                                        </div>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">BEST SELLER PACKAGE: </p>
                                            <div>
                                                @if ($mostChosenPackageYear)
                                                    <p class="font-normal">
                                                        {{ $mostChosenPackageYear->package->name }}
                                                        <span>({{ $mostChosenPackageYear->package_count }})</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="font-bold">
                                            BEST MONTH:
                                            <span
                                                class="font-normal">{{ date('F', mktime(0, 0, 0, $mostReservedMonth->month, 1)) }}
                                                ({{ $mostReservedMonth->reservation_count }})</span>
                                        </p>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">TOTAL EARNINGS: </p>
                                            <div>
                                                <p class="font-normal">
                                                    ₱{{ number_format($totalEarnings, 2, '.', ',') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <p class="font-bold">TOTAL - Month of
                                            <span>{{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }}</span>
                                        </p>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">RESERVATIONS: </p>
                                            <span class="font-normal"> {{ $reservationsCount }}</span>
                                        </div>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">BEST SELLER PACKAGE: </p>
                                            @if ($mostChosenPackageMonth)
                                                <p class="font-normal">
                                                    {{ $mostChosenPackageMonth->package->name }}
                                                    <span>({{ $mostChosenPackageMonth->package_count }})</span>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex">
                                            <p class="mr-1 font-bold">TOTAL EARNINGS: </p>
                                            <div>
                                                <p class="font-normal">
                                                    ₱{{ number_format($totalEarnings, 2, '.', ',') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>

                            <div class="flex justify-end mt-24">
                                <div class="text-center">
                                    <p class="px-3 font-bold border-t border-black">APPROVED BY: Robert Camba</p>
                                    <p class="uppercase">Owner</p>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-end">
            <x-secondary-button wire:click="show">cancel</x-secondary-button>
            <form action="{{ route('report-pdf') }}" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="reportDetails" value="{{ json_encode($reportDetails) }}">
                <button type="submit" class="ml-2 btn-info">Print</button>
            </form>
        </div>
    </x-modal>
</div>
