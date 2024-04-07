@php
    $thisMonth = date('F Y', strtotime($year . '-' . $month . '-01'));
@endphp

<div class="overflow-hidden calendar-container" 
    x-data="{ selectedDate: @entangle('selectedDate') }">
    <div class="mx-auto">        
        <h2 class="flex justify-between px-6 !pt-5 text-lg md:text-2xl text-center">
            {{ $thisMonth }}
            <div class="flex items-center">
                <button type="button" wire:click="previousMonth" class="calendar-btn" aria-label="calendar-btn" role="button">
                   <span class="sr-only">left arrow</span><svg class="size-[24px] lg:size-[28px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 7L10 12L15 17" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </button>
                <button type="button" wire:click="nextMonth" class="calendar-btn" aria-label="calendar-btn" role="button">
                   <span class="sr-only">right arrow</span><svg class="size-[24px] lg:size-[28px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 7L15 12L10 17" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </button>
            </div>
        </h2>

        <div class="pt-4">
            <div class="border-t border-gray-200"></div>
        </div>

        <div class="p-0 pt-0 md:p-5">
            <table>
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($calendar as $week)
                        <tr>
                            @foreach ($week as $day)
                                @php
                                    $isSelected = isset($selectedDate) && $selectedDate == $day['date'];
                                    $isToday = $day['day'] == date('d') && $thisMonth == date('F Y') ? 'today' : '' ;
                                @endphp
                                @if ($day['isCurrentMonth'])
                                    @if ($day['isPastDay'])
                                        <td>
                                            <span class="day disabled">
                                                {{ $day['day'] }}
                                            </span>
                                        </td>
                                    @elseif($day['isReserved'])
                                        <td>
                                            <span class="day reserved {{ $isToday }}">
                                                {{ $day['day'] }}
                                            </span>
                                        </td>
                                    @else
                                    {{-- <td wire:click="setReservationDate('{{ $day['date'] }}')"> --}}
                                        <td x-on:click="selectedDate = '{{ $day['date'] }}'; $wire.setReservationDate('{{ $day['date'] }}')">
                                            <span x-bind:class="{ 
                                                'day {{ $isToday }}' : true,
                                                'selected': selectedDate === '{{ $day['date'] }}' }">
                                                {{ $day['day'] }}
                                            </span>
                                        </td>
                                    @endif
                                @else
                                    <td class="hover:!bg-transparent"></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
    
                </tbody>
            </table>
        </div>
    </div>
    @if($selectedDate)
    <input type="text" name="date" hidden value="{{ date('Y-m-d', strtotime($selectedDate)) }}" id="">
    @endif

   
</div>
