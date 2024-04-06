<x-app-layout> 
    <x-slot name="header">
        {{ __('Add reservation') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">

                <form action="{{ route('reservation.store') }}" 
                    method="post" 
                    enctype="multipart/form-data">
                @csrf

                    <div class="flex flex-col items-center">
                        <h2 class="forms-heading-text">Reservation Details</h2>
                    </div>

                    <x-form-divider value="Personal Information & Event Details" />

                    {{-- <x-label class="!text-lg">
                        Select a package
                        <x-input-error for="package" />
                    </x-label>
                    <ul class="grid w-full gap-6 md:grid-cols-3">
                        <li>
                            <input type="radio" id="package-1" name="package" value="1" class="hidden peer" />
                            <label for="package-1" class="package-card">                           
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 1</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="package-2" name="package" value="2" class="hidden peer">
                            <label for="package-2" class="package-card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 2</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="package-3" name="package" value="3" class="hidden peer">
                            <label for="package-3" class="package-card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 3</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                    </ul> --}}

                    <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-16">
                        <div class="mt-5">
                            <x-label for="name" required>Name:</x-label>
                            <x-input type="text" name="name" class="w-full" id="" value="{{ auth()->user()->name }}" />
                            <x-input-error for="name" />
                        </div>

                        <div class="mt-5">
                            <x-label for="theme" required>Theme:</x-label>
                            <select name="theme" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Theme') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                                <option value="Gold">{{ __('Gold Party') }}</option>
                                <option value="Kanto">{{ __('Kanto Style') }}</option>
                                <option value="Disney">{{ __('Disney') }}</option>
                            </select>
                            <x-input-error for="theme" />
                        </div>

                        <div class="mt-5">
                            <x-label for="address" required>Address:</x-label>
                            <input name="address" class="w-full input-field" id="" value="{{ auth()->user()->address }}" /> 
                            <x-input-error for="address" />
                        </div>
                        
                        <div class="mt-5">
                            <x-label for="occasion" required>Occasion:</x-label>
                            <select name="occasion" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Occasion') }}</option>
                                <option value="Wedding ">{{ __('Wedding ') }}</option>
                                <option value="Debut">{{ __('Debut Party') }}</option>
                                <option value="Christening">{{ __('Christening') }}</option>
                                <option value="Anniversarry">{{ __('Anniversarry') }}</option>
                                <option value="Birthday">{{ __('Birthday') }}</option>
                            </select>
                            <x-input-error for="occasion" />
                        </div>
                    </div>

                    <x-form-divider value="Time and Date" />

                    <div class="flex flex-col items-center mt-5 md:items-start md:flex-row ">
                        <div class="w-full mx-auto mr-2 md:w-8/12 lg:w-2/3">
                            <x-label for="date" required>
                                Choose date:
                            </x-label>
                            @livewire('calendar')
                            <x-input-error for="date" />
                        </div>
    
                        <div class="w-10/12 mt-5 ml-2 md:w-4/12 md:mt-0">
                            @livewire('time-picker')
                        </div>
                    </div>

                    <x-form-divider value="Package Details" />
 

                    <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-16">
                        <div class="mt-5">
                            <x-label for="package" required>Package:</x-label>
                            <select name="package" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Package') }}</option>
                                <option value="1">{{ __('1') }}</option>
                                <option value="2">{{ __('2') }}</option>
                                <option value="3">{{ __('3') }}</option>
                            </select>
                            <x-input-error for="package" />
                        </div>
                        
                        <div class="mt-5">
                            <x-label for="meat" required>Meat:</x-label>
                            <select name="meat" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Meat') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="meat" />
                        </div>

                        <div class="mt-5">
                            <x-label for="dishes" required>Dishes:</x-label>
                            <select name="dishes" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Dishes') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="dishes" />
                        </div>

                        <div class="mt-5">
                            <x-label for="side_dish" required>Side Dish:</x-label>
                            <select name="side_dish" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Side Dish') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="side_dish" />
                        </div>

                        <div class="mt-5">
                            <x-label for="appetizer" required>Appetizer:</x-label>
                            <select name="appetizer" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Appetizer') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="appetizer" />
                        </div>

                        <div class="mt-5">
                            <x-label for="dessert" required>Dessert:</x-label>
                            <select name="dessert" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Dessert') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="dessert" />
                        </div>

                        <div class="mt-5">
                            <x-label for="beverages" required>Beverages:</x-label>
                            <select name="beverages" class="w-full input-field" id="">
                                <option selected disabled>{{ __('Select Beverages') }}</option>
                                <option value="Formal ">{{ __('Formal ') }}</option>
                            </select>
                            <x-input-error for="beverages" />
                        </div>
                    </div>


                    <x-form-divider value="Payment Details" />

                    <div class="flex flex-col w-full mx-auto my-5 lg:w-2/3">
                        <x-label for="payment_percent" required>Payment Percent:</x-label>
                        <select name="payment_percent" class="w-full input-field" id="">
                            <option selected disabled>{{ __('Select Payment Percent') }}</option>
                            <option value="40">{{ __('40') }}</option>
                            <option value="50">{{ __('50') }}</option>
                            <option value="75">{{ __('75') }}</option>
                            <option value="100">{{ __('Full') }}</option>
                        </select>
                        <x-input-error for="payment_percent" />

                        <x-label for="receipt-img" required>Receipt Photo:</x-label>
                        <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img"/>
                        <x-input-error for="receipt-img" />
                    </div>

                    <div class="flex w-full">
                        <button type="submit" class="self-center mx-auto btn-primary">Reserve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>