<x-app-layout> 

    <div class="py-12 max-w-7xl mx-auto grid lg:grid-cols-3 lg:px-8 md:px-4 gap-5">
        <div class="lg:col-span-2">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">

                <form action="{{ route('reservation.update', $reservation->id) }}" 
                    method="post" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center flex-col">
                        <h2 class="forms-heading-text">Reservation Details</h2>
                    </div>

                    <x-form-divider value="Personal Information & Event Details" />

                    <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                        <div class="mt-5">
                            <x-label for="name">Name:</x-label>
                            <x-input type="text" name="name" class="w-full" id="" value="{{ auth()->user()->name }}" disabled />
                            <x-input-error for="name" />
                        </div>

                        <div class="mt-5">
                            <x-label for="theme">Theme:</x-label>
                            <x-input type="text" name="theme" class="w-full input-field" value="{{ $reservation->theme }}" id="" disabled />
                            <x-input-error for="theme" />
                        </div>

                        <div class="mt-5">
                            <x-label for="address">Address:</x-label>
                            <x-input type="text" name="address" class="w-full input-field" id="" value="{{ auth()->user()->address }}" disabled /> 
                            <x-input-error for="address" />
                        </div>
                        
                        <div class="mt-5">
                            <x-label for="occasion">Occasion:</x-label>
                            <x-input type="text" name="occasion" class="w-full input-field" value="{{ $reservation->occasion }}" id="" disabled />
                            <x-input-error for="occasion" />
                        </div>
                    </div>

                    <x-form-divider value="Time and Date" />

                    <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                        <div class="mt-5">
                            <x-label for="date">Date:</x-label>
                            <x-input type="text" name="date" class="w-full" id="" value="{{ $reservation->date->format('M d, Y') }}" disabled />
                            <x-input-error for="date" />
                        </div>

                        <div class="mt-5">
                            <x-label for="time">Time:</x-label>
                            <x-input type="text" name="time" class="w-full" id="" value="{{ $reservation->time->format('g:i A') }}" disabled />
                            <x-input-error for="time" />
                        </div>
                    </div>

                    <x-form-divider value="Package Details" />

                    <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                        <div class="mt-5">
                            <x-label for="package">Package:</x-label>
                            <x-input type="text" name="package" class="w-full input-field" value="package {{ $reservation->package }}" id="" disabled />
                            <x-input-error for="package" />
                        </div>
                        
                        <div class="mt-5">
                            <x-label for="meat">Meat:</x-label>
                            <x-input name="meat" class="w-full input-field" id="" disabled />
                            <x-input-error for="meat" />
                        </div>

                        <div class="mt-5">
                            <x-label for="dishes">Dishes:</x-label>
                            <x-input name="dishes" class="w-full input-field" id="" disabled />
                            <x-input-error for="dishes" />
                        </div>

                        <div class="mt-5">
                            <x-label for="side_dish">Side Dish:</x-label>
                            <x-input name="side_dish" class="w-full input-field" id="" disabled />
                            <x-input-error for="side_dish" />
                        </div>

                        <div class="mt-5">
                            <x-label for="appetizer">Appetizer:</x-label>
                            <x-input name="appetizer" class="w-full input-field" id="" disabled />
                            <x-input-error for="appetizer" />
                        </div>

                        <div class="mt-5">
                            <x-label for="dessert">Dessert:</x-label>
                            <x-input name="dessert" class="w-full input-field" id="" disabled />
                            <x-input-error for="dessert" />
                        </div>

                        <div class="mt-5">
                            <x-label for="beverages">Beverages:</x-label>
                            <x-input name="beverages" class="w-full input-field" id="" disabled />
                            <x-input-error for="beverages" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="p-5 overflow-hidden bg-white shadow-lg md:p-10 sm:rounded-lg">

                <div class="flex items-center flex-col">
                    <h2 class="forms-heading-text">Payment Details</h2>
                </div>

                    <div class="flex flex-col w-full mx-auto my-5">
                        @php
                            $percent = $reservation->payment_percent;
                            $completed = $percent == 100;
                        @endphp

                        <div class="w-full bg-gray-200 inline-block rounded-full dark:bg-gray-700 my-5">
                            <div class="{{ $completed ? 'bg-green-500' : 'bg-primary' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $percent }}%">
                                {{ $completed ? 'Completed' : $percent . '%' }}
                            </div>
                        </div>

                        <x-label for="payment_percent">Payment Percent:</x-label>
                        <select name="payment_percent" class="w-full input-field" id="">
                            <option selected disabled>{{ __('Select Payment Percent') }}</option>
                            <option value="40">{{ __('40') }}</option>
                            <option value="50">{{ __('50') }}</option>
                            <option value="75">{{ __('75') }}</option>
                            <option value="100">{{ __('Full') }}</option>
                        </select>
                        <x-input-error for="payment_percent" />

                        <x-label for="receipt-img">Receipt Photo:</x-label>
                        <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img"/>
                        <x-input-error for="receipt-img" />
                    </div>

                    <div class="flex w-full">
                        <button type="submit" class="self-center mx-auto btn-primary">Reserve</button>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>