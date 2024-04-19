<form action="{{ route('reservation.store') }}" 
    method="post" 
    enctype="multipart/form-data"
    x-data="reservationForm()"
    x-on:submit="buttonDisabled = true"
    x-cloak>
    @csrf

    <x-validation-errors class="mb-4" />

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
            
            <div class="mt-5">
                <x-label for="address" required>Address:</x-label>
                <input x-model="address" name="address" class="w-full input-field" id="address" /> 
                <x-input-error for="address" />
            </div>
            

            <div class="mt-5">
                <x-label for="package" required>Package:</x-label>
                <select x-model.fill="package"  x-on:change="packageText = $event.target.options[$event.target.selectedIndex].textContent; $wire.selectedPackage($event.target.value)" name="package_id" class="w-full input-field" id="package">
                    <option selected disabled>{{ __('Select Package') }}</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ __($package->name) }}</option>
                    @endforeach
                </select>
                <x-input-error for="package" />
            </div>

            <div class="mt-5">
                <x-label for="pax" required>Pax:</x-label>
                <input x-model="pax" wire:model.change="pax" x-on:change="$wire.setPax()" name="pax" type="number" min="1" max="300" class="w-full input-field" id="pax" placeholder="Enter Number of Attendees" /> 
                <x-input-error for="pax" />
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

        <div class="relative flex justify-center w-full mt-8 md:justify-end">
            <div x-show="incompleteFields" class="absolute p-2 mb-1 text-sm text-gray-400 bg-gray-100 rounded-md shadow-lg top-[-45px]" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
                {{ __('Fill required fields before proceeding') }}
            </div>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>
    </div>

    
    <div x-show="step == 2">
        <x-form-divider value="Menu Details" />

        <h2 class="text-md md:text-xl font-noticia">
            Choose Menus for 
            <span class="underline underline-offset-4" x-text="packageText"></span>:
        </h2>

        <div class="flex w-[85%] mx-auto flex-col justify-between pb-12 md:flex-row">
            <div class="w-full">
                <ul class="grid w-full gap-4 p-8 mt-5 overflow-y-scroll font-noticia no-scrollbar max-h-72 md:max-h-80 lg:max-h-96">
                    @if ($menus)
                        @foreach ($menus as $menu)
                            <li>
                                <input type="radio" x-model="menu" x-on:click="menuName = '{{ $menu->name }}'; $wire.selectedMenu({{ $menu->price }})" id="menu-{{ $menu->name }}" name="menu_id" value="{{ $menu->id }}" class="hidden peer" />
                                <label for="menu-{{ $menu->name }}" class="menu-card">                           
                                    <div class="flex justify-between w-full">
                                        <div class="text-lg font-semibold ">Menu {{ $menu->name }}</div>
                                        <div class="">₱{{ $menu->price }} / HEAD + 12%</div>
                                    </div>
                                </label>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="flex flex-col items-center w-full lg:w-72">
                @if ($packageName)
                    <h2 class="mb-3 text-md md:text-lg font-noticia">View full menu</h2>
                    <a href="{{ asset('assets/packages/' . $packageName . '.pdf') }}" target="_blank" class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer max-w-72 hover:shadow-xl hover:scale-105">
                        <img src="{{ asset('assets/web-images/low/package-' . $packageName . '.webp') }}" class="package-service"  fetchpriority="high" alt="package sapphire">
                    </a>
                @endif
            </div>
        </div>

        <div class="relative flex justify-center w-full mt-8 md:justify-end">
            <div x-show="incompleteFields" class="absolute p-2 mb-1 text-sm text-gray-400 bg-gray-100 rounded-md shadow-lg top-[-45px]" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
                {{ __('Fill required fields before proceeding') }}
            </div>
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
                <p>Occasion: <span x-text="occasion"></span></p>
            </li>
            <li>
                <p>Pax: <span x-text="pax"></span></p>
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
                    <p>Package: <span x-text="packageText"></span></p>
                </li>
                <li>
                    <p>Menu: <span x-text="menuName"></span></p>
                </li>
                <li>
                    <p>Price: ₱<span>{{ $menuPrice }}.00</span></p>
                </li>
                
            </div>
            <div>
                
            </div>
        </ul>

        <x-form-divider />
        
        <div class="flex justify-end w-full px-10 font-semibold font-noticia">
            <p>Total Cost: ₱{{ $totalCost }}</p>
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>    
    </div>
    
    <div x-show="step == 4">
        <x-form-divider value="Payment Details" />

        <div class="flex flex-col w-full mx-auto my-5 lg:w-2/3">
            <h2 class="text-md md:text-lg font-noticia">
                Total Cost: ₱{{ $totalCost }}
                <input type="text" name="total_cost" value="{{ $totalCost }}" class="hidden" />
            </h2>

            <x-label for="payment_percent" required>Payment Percent:</x-label>
            <select name="payment_percent" x-on:change="$wire.calculateAmountToPay($event.target.value)" class="w-full input-field" id="payment_percent">
                <option selected disabled>{{ __('Select Payment Percent') }}</option>
                <option value="20">{{ __('20') }}</option>
                <option value="60">{{ __('60') }}</option>
                <option value="90">{{ __('90') }}</option>
                <option value="100">{{ __('Full') }}</option>
            </select>
            <x-input-error for="payment_percent" />

            <h2 x-show="$wire.amountToPay" class="mt-5 text-md md:text-lg font-noticia">
                Amount to pay: ₱{{ $amountToPay }}
                <input type="text" name="amount_paid" value="{{ $amountToPay }}" class="hidden" />

            </h2>

            <h2 class="my-3 text-center text-md md:text-xl font-noticia">Select Payment Method </h2>
            <div class="flex justify-center mb-5">
                <button type="button" wire:click.layz="showGcash" wire:loading.class="opacity-75" class="px-3 py-1 rounded-lg shadow w-32 bg-[#087cfc] hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
                    <div class="w-full" wire:loading wire:target="showGcash">
                        <svg class="mx-auto animate-spin" width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                    </div>
                    <img src="{{ asset('assets/images/gcash-fill-logo.jpg') }}" alt="gcash logo" wire:loading.remove wire:target="showGcash">
                </button>
                <div class="mx-4 border-l-2 border-gray-400"></div>
                <button type="button" wire:click.layz="showMaya"  wire:loading.class="opacity-75" class="px-6 py-3 bg-[#50b16b] rounded-lg shadow w-32 hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
                    <div class="w-full" wire:loading wire:target="showMaya">
                        <svg class="mx-auto animate-spin" width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                    </div>
                    <img src="{{ asset('assets/images/maya-fill-logo.png') }}" alt="maya logo" wire:loading.remove wire:target="showMaya">
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
            <button class="min-w-24 btn-success" x-bind:disabled="buttonDisabled">
                <div role="status" x-show="buttonDisabled" class="w-full">
                    <svg class="mx-auto animate-spin" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                </div>
                <span x-show="!buttonDisabled">{{ __('Reserve') }}</span>
            </button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationForm', () => ({
                name: '{{ auth()->user()->name  }}',
                address: '{{ auth()->user()->address }}',
                pax: '',
                occasion: '',
                packageText: '',
                package: '',
                menu: '',
                menuName: '',
                buttonDisabled: false,
                incompleteFields: false,
                step: 1,

                fieldsValidated(){
                    if(this.step === 1){
                        return this.address 
                        && this.occasion != "Select Occasion" 
                        && this.package != "Select Package" 
                        && this.pax;
                    }
                    else if(this.step === 2){
                        return this.menu
                    }
                    else{
                     return true;   
                    }
                },

                nextStep() {
                    if (this.fieldsValidated()) {
                        this.step++;
                        this.incompleteFields = false;
                        window.scrollTo({ top: 180, behavior: 'smooth' });
                    }
                    else
                    {
                        this.incompleteFields = true;
                    }
                },
                prevStep() {
                    this.step--;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                }
            }));
        });
    
    </script>
@endpush