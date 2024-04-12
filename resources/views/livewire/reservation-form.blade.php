<form action="{{ route('reservation.store') }}" 
    method="post" 
    enctype="multipart/form-data"
    x-data="reservationForm()"
    x-cloak>
    @csrf

    <div class="flex flex-col items-center">
        <h2 class="forms-heading-text" x-text="step == 3 ? 'Reservation Summary' : 'Reservation Details'"></h2>
    </div>

    <div x-show="step == 1">
        <x-form-divider value="Personal Information & Event Details" />

        <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-16">
            <div class="mt-5">
                <x-label for="name" required>Name:</x-label>
                <x-input type="text" name="name" class="w-full" id="name" x-model="name" readonly />
                <x-input-error for="name" />
            </div>

            <div class="mt-5">
                <x-label for="theme" required>Theme:</x-label>
                <select x-model.fill="theme" name="theme" class="w-full input-field" id="theme">
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
                <input x-model="address" name="address" class="w-full input-field" id="address" /> 
                <x-input-error for="address" />
            </div>
            
            <div class="mt-5">
                <x-label for="occasion" required>Occasion:</x-label>
                <select x-model.fill="occasion" name="occasion" class="w-full input-field" id="occasion">
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

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>
    </div>

    
    <div x-show="step == 2">
        <x-form-divider value="Package Details" />
        
        <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 gap-x-16">
            <div class="mt-5">
                <x-label for="package" required>Package:</x-label>
                <select x-model.fill="package" name="package" class="w-full input-field" id="package">
                    <option selected disabled>{{ __('Select Package') }}</option>
                    <option value="1">{{ __('1') }}</option>
                    <option value="2">{{ __('2') }}</option>
                    <option value="3">{{ __('3') }}</option>
                </select>
                <x-input-error for="package" />
            </div>
            
            <div class="mt-5">
                <x-label for="meat" required>Meat:</x-label>
                <select name="meat" class="w-full input-field" id="meat">
                    <option selected disabled>{{ __('Select Meat') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="meat" />
            </div>

            <div class="mt-5">
                <x-label for="dishes" required>Dishes:</x-label>
                <select name="dishes" class="w-full input-field" id="dishes">
                    <option selected disabled>{{ __('Select Dishes') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="dishes" />
            </div>

            <div class="mt-5">
                <x-label for="side_dish" required>Side Dish:</x-label>
                <select name="side_dish" class="w-full input-field" id="side_dish">
                    <option selected disabled>{{ __('Select Side Dish') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="side_dish" />
            </div>

            <div class="mt-5">
                <x-label for="appetizer" required>Appetizer:</x-label>
                <select name="appetizer" class="w-full input-field" id="appetizer">
                    <option selected disabled>{{ __('Select Appetizer') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="appetizer" />
            </div>

            <div class="mt-5">
                <x-label for="dessert" required>Dessert:</x-label>
                <select name="dessert" class="w-full input-field" id="dessert">
                    <option selected disabled>{{ __('Select Dessert') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="dessert" />
            </div>

            <div class="mt-5">
                <x-label for="beverages" required>Beverages:</x-label>
                <select name="beverages" class="w-full input-field" id="beverages">
                    <option selected disabled>{{ __('Select Beverages') }}</option>
                    <option value="Formal ">{{ __('Formal ') }}</option>
                </select>
                <x-input-error for="beverages" />
            </div>
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>    
    </div>

    <div x-show="step == 3">
        <x-form-divider />
        <h2 class="m-0 lg:mx-10 text-md md:text-xl font-noticia">Finalize your Order </h2>
        <x-form-divider value="Personal Information & Event Details" />

        <ul class="m-0 text-base lg:mx-10 font-noticia">
            <li>
                <p>Name: <span x-text="name"></span></p>
            </li>
            <li>
                <p>Address: <span x-text="address"></span></p>
            </li>
            <li>
                <p>Theme: <span x-text="theme"></span></p>
            </li>
            <li>
                <p>Occasion: <span x-text="occasion"></span></p>
            </li>
        </ul>

        <x-form-divider value="Time and Date" />

        <ul class="m-0 text-base lg:mx-10 font-noticia" x-data="{ date: @entangle('selectedDate'), time: @entangle('selectedTime') }">
            <li>
                <p>Date: <span>{{ $date }}</span></p>
            </li>
            <li>
                <p>Time: <span>{{ $time }}</span></p>
            </li>
        </ul>

        <x-form-divider value="Package Details" />

        <ul class="grid grid-cols-2 m-0 text-base lg:mx-10 font-noticia">
            <div>
                <li>
                    <p>Package: <span x-text="package"></span></p>
                </li>
                <li>
                    <p>Meat: <span></span></p>
                </li>
                <li>
                    <p>Dessert: <span></span></p>
                </li>
                <li>
                    <p>Appetizer: <span></span></p>
                </li>
            </div>
            <div>
                <li>
                    <p>Dishes: <span></span></p>
                </li>
                <li>
                    <p>Side dish: <span></span></p>
                </li>
                <li>
                    <p>Beverages: <span></span></p>
                </li>
            </div>
        </ul>

        <x-form-divider />
        
        <div class="flex justify-end w-full px-10 font-noticia">
            <p>Total Cost:</p>
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>    
    </div>
    
    <div x-show="step == 4">
        <x-form-divider value="Payment Details" />

        <div class="flex flex-col w-full mx-auto my-5 lg:w-2/3">
            <x-label for="payment_percent" required>Payment Percent:</x-label>
            <select name="payment_percent" class="w-full input-field" id="payment_percent">
                <option selected disabled>{{ __('Select Payment Percent') }}</option>
                <option value="20">{{ __('20') }}</option>
                <option value="60">{{ __('60') }}</option>
                <option value="90">{{ __('90') }}</option>
                <option value="100">{{ __('Full') }}</option>
            </select>
            <x-input-error for="payment_percent" />

            <h2 class="my-3 text-center text-md md:text-xl font-noticia">Select Payment Method </h2>
            <div class="flex justify-center mb-5">
                <button type="button" wire:click="showGcash" class="px-3 py-1 rounded-lg shadow max-w-32 bg-[#087cfc] hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
                    <img src="{{ asset('assets/images/gcash-fill-logo.jpg') }}" alt="gcash logo">
                </button>
                <div class="mx-4 border-l-2 border-gray-400"></div>
                <button type="button" wire:click="showMaya" class="px-6 py-3 bg-[#50b16b] rounded-lg shadow max-w-32 hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
                    <img src="{{ asset('assets/images/maya-fill-logo.png') }}" alt="maya logo">
                </button>

                <!-- gcash modal -->
                <x-dialog-modal footerPosition="center" maxWidth="md" wire:model="showingGcash">
                    <x-slot name="title">
                        <div class="mx-auto">
                            <div class="flex items-end my-2 ">
                                <x-application-mark class="block" />
                                <x-brand-name class="ml-2" />
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <div class="flex flex-col items-center">
                            <div class="max-w-36">
                                <img src="{{ asset('assets/images/gcash-logo.png') }}" alt="gcash logo">
                            </div>

                            <p class="mt-5 font-semibold uppercase text-md">send your payment here</p>
                            
                            <div class="size-64">
                                <img src="{{ asset('assets/images/qr.png') }}" alt="gcash qr code">
                            </div>

                            <h3 class="title-primary !text-xl !font-bold">RO***T C.</h3>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button wire:click="showGcash" type="button">back</x-button>
                    </x-slot>
                </x-dialog-modal>

                <!-- maya modal -->
                <x-dialog-modal footerPosition="center" maxWidth="md" wire:model="showingMaya">
                    <x-slot name="title">
                        <div class="mx-auto">
                            <div class="flex items-end my-2 ">
                                <x-application-mark class="block" />
                                <x-brand-name class="ml-2" />
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <div class="flex flex-col items-center">
                            <div class="max-w-36">
                                <img src="{{ asset('assets/images/maya-logo.jpg') }}" alt="maya logo">
                            </div>

                            <p class="mt-5 font-semibold uppercase text-md">send your payment here</p>
                            
                            <div class="size-64">
                                <img src="{{ asset('assets/images/qr.png') }}" alt="maya qr code">
                            </div>

                            <h3 class="title-primary !text-xl !font-bold">RO***T C.</h3>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button wire:click="showMaya" type="button">back</x-button>
                    </x-slot>
                </x-dialog-modal>
            </div>


            <x-label for="receipt-img" required>Receipt Photo:</x-label>
            <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img"/>
            <x-input-error for="receipt-img" />
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <button type="submit" class="btn-success">Reserve</button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationForm', () => ({
                name: '{{ auth()->user()->name  }}',
                address: '{{ auth()->user()->address }}',
                theme: null,
                occasion: null,
                package: null,
                step: 4,

                nextStep() {
                    this.step++;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                },
                prevStep() {
                    this.step--;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                }
            }));
        });
    
    </script>
@endpush