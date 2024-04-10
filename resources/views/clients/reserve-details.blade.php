<x-app-layout> 

    <div class="grid gap-5 py-12 mx-auto max-w-7xl lg:grid-cols-3 lg:px-8 md:px-4">
        <div class="lg:col-span-2">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Reservation Details</h2>
                </div>

                <x-form-divider value="Personal Information & Event Details" />

                <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                    <div class="mt-5">
                        <x-label for="name">Name:</x-label>
                        <x-input type="text" name="name" class="w-full" id="name" value="{{ auth()->user()->name }}" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="theme">Theme:</x-label>
                        <x-input type="text" name="theme" class="w-full input-field" value="{{ $reservation->theme }}" id="theme" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="address">Address:</x-label>
                        <x-input type="text" name="address" class="w-full input-field" id="address" value="{{ auth()->user()->address }}" disabled /> 
                    </div>
                    
                    <div class="mt-5">
                        <x-label for="occasion">Occasion:</x-label>
                        <x-input type="text" name="occasion" class="w-full input-field" value="{{ $reservation->occasion }}" id="occasion" disabled />
                    </div>
                </div>

                <x-form-divider value="Time and Date" />

                <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                    <div class="mt-5">
                        <x-label for="date">Date:</x-label>
                        <x-input type="text" name="date" class="w-full" id="date" value="{{ $reservation->date->format('M d, Y') }}" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="time">Time:</x-label>
                        <x-input type="text" name="time" class="w-full" id="time" value="{{ $reservation->time->format('g:i A') }}" disabled />
                    </div>
                </div>

                <x-form-divider value="Package Details" />

                <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-5">
                    <div class="mt-5">
                        <x-label for="package">Package:</x-label>
                        <x-input type="text" name="package" class="w-full input-field" value="package {{ $reservation->package }}" id="package" disabled />
                    </div>
                    
                    <div class="mt-5">
                        <x-label for="meat">Meat:</x-label>
                        <x-input name="meat" class="w-full input-field" id="meat" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="dishes">Dishes:</x-label>
                        <x-input name="dishes" class="w-full input-field" id="dishes" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="side_dish">Side Dish:</x-label>
                        <x-input name="side_dish" class="w-full input-field" id="side_dish" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="appetizer">Appetizer:</x-label>
                        <x-input name="appetizer" class="w-full input-field" id="appetizer" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="dessert">Dessert:</x-label>
                        <x-input name="dessert" class="w-full input-field" id="dessert" disabled />
                    </div>

                    <div class="mt-5">
                        <x-label for="beverages">Beverages:</x-label>
                        <x-input name="beverages" class="w-full input-field" id="beverages" disabled />
                    </div>
                </div>  
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="p-5 overflow-hidden bg-white shadow-lg md:p-10 sm:rounded-lg">

                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Payment Details</h2>
                </div>

                <form action="{{ route('reservation.update', $reservation->id) }}" 
                    method="post" 
                    enctype="multipart/form-data"
                    class="flex flex-col w-full mx-auto my-5">
                    @csrf
                    @method('PUT')

                    @php
                        $percent = $reservation->payment_percent;
                        $completed = $percent == 100;
                    @endphp

                    <div class="inline-block w-full mt-5 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="{{ $completed ? 'bg-green-500' : 'bg-primary' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $percent }}%">
                            {{ $completed ? 'Completed' : $percent . '%' }}
                        </div>
                    </div>

                    @if (!$completed)
                        <div class="mt-5">
                            <x-label for="payment_percent">Payment Percent:</x-label>
                            <select name="payment_percent" class="w-full input-field" id="payment_percent">
                                <option selected disabled>{{ __('Select Payment Percent') }}</option>
                                @foreach ($payment_percentages as $percent)
                                    @if ($percent > $reservation->payment_percent)
                                    <option value="{{ $percent }}" {{ old('payment_percent') == $percent ? 'selected' : '' }}>
                                        {{ $percent == 100 ? 'Full' : $percent }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error for="payment_percent" />
                        </div>

                        <div class="mt-5">
                            <x-label for="receipt-img">Receipt Photo:</x-label>
                            <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img"/>
                            <x-input-error for="receipt-img" />
                        </div>

                        <div class="mx-auto mt-5">
                            <button type="submit" class="self-center mx-auto btn-primary">Pay</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>