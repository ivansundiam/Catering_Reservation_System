<x-app-layout> 
    <x-slot name="header">
        {{ __('My reservations') }}
    </x-slot>
    
    <div class="pb-12 pt-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-5 overflow-hidden  md:px-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 p-5">
                    
                    @foreach ($reservations as $reservation)
                        @php
                            $percent = $reservation->payment_percent;
                            $completed = $percent == 100;
                        @endphp
                        
                        <a href="{{ route('reservation.show', $reservation->id) }}" class="rounded-lg shadow-lg flex overflow-hidden hover:scale-[1.02] transform ease-in-out duration-200">
                            <div class="bg-white w-[75%] border-r border-gray-200">
                                <div class="p-3 flex flex-col justify-center">
                                    <span class="text-sm {{ $completed ? 'text-green-500' : 'text-primary'}}">{{ $completed ? 'Payment Completed' : 'Pending Payment' }}</span>
                                    <p class="text-base">Package {{ $reservation->package }}</p>
                                    <div class="flex justify-between">
                                        <div>
                                            <span class="text-sm text-gray-500">Occasion</span>
                                            <p class="text-xl">{{ $reservation->occasion }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500">Time</span>
                                            <p class="text-xl">{{ $reservation->time->format('g: i a') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 pb-3 bg-white items-center">
                                    <p class="text-sm text-gray-500">Progress</p>
                                    <div class="w-full bg-gray-200 inline-block rounded-full dark:bg-gray-700">
                                        <div class="{{ $completed ? 'bg-green-500' : 'bg-primary' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $percent }}%">
                                            {{ $completed ? 'Completed' : $percent . '%' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-[25%] text-center uppercase flex flex-col justify-center font-semibold tracking-tight py-4 bg-white">
                                <span class="text-xl">{{ $reservation->date->format('M') }}</span>
                                <span class="text-4xl text-primary leading-8">{{ $reservation->date->format('d') }}</span>
                                <span class="text-md">{{ $reservation->date->format('Y') }}</span>

                            </div>
                        </a>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>