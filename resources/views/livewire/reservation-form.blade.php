<form action="{{ route('reservation.store') }}" 
    method="post" 
    enctype="multipart/form-data"
    x-data="reservationForm()"
    x-on:submit="buttonDisabled = true"
    x-cloak>
    @csrf

    <x-validation-errors class="mb-4" />

    <div class="flex flex-col items-center">
        <h2 class="forms-heading-text" x-text="formHeading()"></h2>
    </div>

    <!-- Personal Information & Event Details -->
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
                    <option value="Anniversary">{{ __('Anniversary') }}</option>
                    <option value="Birthday">{{ __('Birthday') }}</option>
                </select>
                <x-input-error for="occasion" />
            </div>
            
            <div class="mt-5">
                <x-label for="address" required>Address:</x-label>
                <x-input x-model="address" name="address" class="w-full" id="address" /> 
                <x-input-error for="address" />
            </div>
            

            <div class="mt-5">
                <div class="flex justify-between">
                    <x-label for="package" required>Package:</x-label>
                    <a href="{{ asset('assets/packages/packages.pdf') }}" target="_blank" class="text-sm text-blue-500 hover:underline decoration-blue-500 underline-offset-2">
                        View all packages
                    </a>
                </div>
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
                <x-input x-model="pax" wire:model.change="pax" x-on:change="$wire.setPax()" name="pax" type="number" min="1" max="300" :value="old('pax')" class="w-full" id="pax" placeholder="Enter Number of Attendees" /> 
                <x-input-error for="pax" />
            </div>
        </div>

        <x-form-divider value="Time and Date" />

        <div class="flex flex-col items-center mt-5 md:items-start md:flex-row ">
            <div class="w-full mx-auto mr-2 md:w-8/12 lg:w-2/3">
                <div class="flex items-center">
                    <x-label for="date" required>
                        Choose date:
                    </x-label>
                    <x-tooltip id="calendar-tooltip" size="25" placement="right">
                        <p>Reserved dates are indicated in grey.</p>
                        <p>Select from available dates.</p>
                    </x-tooltip>
                </div>
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

    <!-- Menu Details -->
    <div x-show="step == 2">
        <x-form-divider value="Menu Details" />

        <h2 class="text-md md:text-xl font-noticia">
            Choose Menus for 
            <span class="underline underline-offset-4" x-text="packageText"></span>:
        </h2>

        <div class="flex w-[85%] mx-auto flex-col justify-between pb-12 md:flex-row">
            <div class="relative w-full">
                <!-- tooltip -->
                <div class="absolute top-0 right-7">
                    <x-tooltip id="menu-tooltip" placement="left" width="60">
                        <p>Example:</p>
                        <p>Price :	P590.00 / Head + 12%</p>
                        <div class="flex justify-end w-full">
                            <div>
                                <p>100 Heads = PHP 66,080</p>
                                <p>150 Heads = PHP 99,120</p>
                                <p>300 Heads = PHP198,240</p>
                            </div>
                        </div>
                    </x-tooltip>
                </div>
                <ul class="grid w-full gap-4 px-5 py-3 mt-10 overflow-y-scroll font-noticia max-h-72 md:max-h-80 lg:max-h-96">
                   
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
        
        <div class="flex w-[85%] mx-auto md:flex-row">
            <div class="flex flex-col items-center w-full p-5 mx-auto capitalize bg-gray-200 border-2 border-gray-300 rounded-lg">
                
                @switch($inclusionType)
                    @case('wedding sapphire')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for wedding</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With chairs and full length chair cover and ribbon</li>
                            <li>With tables and floor length clothe and toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and décor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With two tiffany for couples</li>
                            <li>With cage and dove</li>
                            <li>With wine for toast</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With gazebo for the couples</li>
                            <li>With very elegant flower arrangement</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                        </ol>
                    
                        @break
                    @case('wedding silver')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for wedding</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With chairs and full-length chair cover and ribbon</li>
                            <li>With tables and floor-length cloth and toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and décor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With couch for the couples</li>
                            <li>With cage and dove</li>
                            <li>With wine for toasting</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With carpet</li>
                            <li>With gazebo for the couples</li>
                            <li>With torch or sword parade</li>
                            <li>With very elegant flower arrangement</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                            <li>All tiffany chairs</li>
                        </ol>
                    
                        @break
                    @case('wedding tiffany')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for wedding</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With Tiffany chairs and organza ribbon</li>
                            <li>With tables and floor length cloth and toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and decor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With cage and dove</li>
                            <li>With wine for toasting</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With carpet</li>
                            <li>With gazebo for the couples</li>
                            <li>With very elegant flower arrangement</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                            <li>With guestbook & signature frame</li>
                            <li>With torch or sword parade</li>
                            <li>With free 3 layer cake (base edible)</li>
                            <li>With couch for couples</li>
                        </ol>
                    
                        @break
                    @case('wedding ruby')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for wedding</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With Tiffany chairs and organza ribbon</li>
                            <li>With tables and floor length cloth and toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and décor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With 6 pcs. Pedestal at entrance</li>
                            <li>With cage and dove</li>
                            <li>With wine for toasting</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With carpet</li>
                            <li>With gazebo for the couples</li>
                            <li>With torch or sword parade</li>
                            <li>With very elegant flower arrangement</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                            <li>With guestbook & signature frame</li>
                            <li>With emcee (for 100pax and above guests)</li>
                            <li>With sound system (public address)</li>
                            <li>With bubble machine</li>
                            <li>With 3 layer cake (base edible)</li>
                            <li>With couch for couples</li>
                        </ol>
                    
                        @break
                    @case('wedding gold')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for wedding</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With Tiffany chairs and organza ribbon</li>
                            <li>With tables and floor length clothe and toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and décor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With cage and dove</li>
                            <li>With wine for toasting</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With carpet</li>
                            <li>With torch or sword parade</li>
                            <li>With very elegant flower arrangement (glass center piece)</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                            <li>With guestbook & signature frame</li>
                            <li>With emcee</li>
                            <li>With sound system (public address)</li>
                            <li>With bubble machine</li>
                            <li>With 6 pcs. Pedestals at entrance</li>
                            <li>With fondant cake (3 layer)</li>
                            <li>With free reception coordination (150px above)</li>
                            <li>With mobile and lights</li>
                        </ol>
                    
                        @break
                    @case('debut sapphire')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for debut</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                            <li>With chairs and full-length chair cover and ribbon</li>
                            <li>With tables and floor-length clothe with toppings</li>
                            <li>With motif color</li>
                            <li>With complete catering equipment</li>
                            <li>With buffet table and decor</li>
                            <li>With presidential table, gift table, cake table</li>
                            <li>With one tiffany chair for debutante</li>
                            <li>With 18 roses and candles</li>
                            <li>With 18 wine glasses</li>
                            <li>With uniformed waiters</li>
                            <li>With colored napkins</li>
                            <li>With gazebo for the debutante</li>
                            <li>With very elegant flower arrangement</li>
                            <li>With free food tasting for two persons</li>
                            <li>With purified water and ice</li>
                        </ol>
                    
                        @break
                    @case('debut silver')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for debut</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                        <li>With chairs and full-length chair cover and ribbon</li>
                        <li>With tables and floor-length cloth with toppings</li>
                        <li>With motif color</li>
                        <li>With complete catering equipment</li>
                        <li>With buffet table and decor</li>
                        <li>With presidential table, gift table, cake table</li>
                        <li>With couch for the debutante</li>
                        <li>With 18 roses and candles</li>
                        <li>With 18 wine glasses</li>
                        <li>With uniformed waiters</li>
                        <li>With colored napkins</li>
                        <li>With carpet</li>
                        <li>With gazebo for the debutante</li>
                        <li>With torch or sword parade</li>
                        <li>With very elegant flower arrangement</li>
                        <li>With free food tasting for two persons</li>
                        <li>With purified water and ice</li>
                        <li>All tiffany chairs</li>
                        </ol>
                    
                        @break
                    @case('debut tiffany')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for debut</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                        <li>With Tiffany chairs and organza ribbon</li>
                        <li>With tables and floor length cloth with toppings</li>
                        <li>With motif color</li>
                        <li>With complete catering equipment</li>
                        <li>With buffet table and decor</li>
                        <li>With presidential table, gift table, cake table</li>
                        <li>With 18 roses and candles</li>
                        <li>With 18 wine glasses</li>
                        <li>With uniformed waiters</li>
                        <li>With colored napkins</li>
                        <li>With carpet</li>
                        <li>With gazebo for the debutante</li>
                        <li>With very elegant flower arrangement</li>
                        <li>With free food tasting for two persons</li>
                        <li>With purified water and ice</li>
                        <li>With guestbook & signature frame</li>
                        <li>With torch or sword parade</li>
                        <li>With free 3 layer cake (base edible)</li>
                        <li>With couch for debutant</li>
                        </ol>
                    
                        @break
                    @case('debut ruby')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for debut</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                        <li>With Tiffany chairs and organza ribbon</li>
                        <li>With tables and floor length cloth with toppings</li>
                        <li>With motif color</li>
                        <li>With complete catering equipment</li>
                        <li>With buffet table and decor</li>
                        <li>With presidential table, gift table, cake table</li>
                        <li>With 6 pcs. Pedestal</li>
                        <li>With 18 roses and candles</li>
                        <li>With 18 wine glass</li>
                        <li>With uniformed waiters</li>
                        <li>With colored napkins</li>
                        <li>With carpet</li>
                        <li>With gazebo for the debutante</li>
                        <li>With torch or sword parade</li>
                        <li>With very elegant flower arrangement</li>
                        <li>With free food tasting for two persons</li>
                        <li>With purified water and ice</li>
                        <li>With guestbook & signature frame</li>
                        <li>With emcee (for 100 pax and above guest)</li>
                        <li>With sound system (public address)</li>
                        <li>With fog machine</li>
                        <li>With 3 layer cake (base edible)</li>
                        <li>With couch for debutant</li>
                        </ol>
                    
                        @break
                    @case('debut gold')
                       <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for debut</span>
                        <ol class="text-sm text-gray-700 list-decimal list-inside md:text-base">
                        <li>With tiffany chairs and organza ribbon</li>
                        <li>With tables and floor length clothe w/ toppings</li>
                        <li>With motif color</li>
                        <li>With complete catering equipment</li>
                        <li>With buffet table and decor</li>
                        <li>With presidential table, gift table, cake table</li>
                        <li>With 18 roses and candles</li>
                        <li>With 18 wine glass</li>
                        <li>With uniformed waiters</li>
                        <li>With colored napkins</li>
                        <li>With carpet</li>
                        <li>With torch or sword parade</li>
                        <li>With very elegant flower arrangement</li>
                        <li>With free food tasting for two persons</li>
                        <li>With purified water and ice</li>
                        <li>With guestbook & signature frame</li>
                        <li>With emcee</li>
                        <li>With sound system (public address)</li>
                        <li>With fog machine</li>
                        <li>With 6 pcs. Pedestals</li>
                        <li>With fondant cake (3 layers)</li>
                        <li>With mobile and lights</li>
                        <li>With free reception coordination (150px above)</li>
                        </ol>
                    
                        @break
                    @case('ordinary')
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Inclusion :</span>
                        <p>
                            {{ __('With chairs and tables and colored ribbon With motif,
                            With buffet table and decor, With complete catering equipment,
                            With uniformed waiters, With purified water and ice, no individual flowers,
                            With floor length clothe and colored toppings, no table set up.') }}  
                        </p>
                        @break
                    @case('special')
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Inclusion :</span>
                        <p>
                            {{ __('With chairs and tables and colored ribbon With motif, 
                            With buffet table and decor, With complete catering equipment, With uniformed 
                            waiters, With purified water and ice, With individual flowers, With floor 
                            length cloth and colored toppings.') }}
                        </p>
                        @break
                    @default
                        
                @endswitch
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
        <x-form-divider value="Chairs & Tables Rentals" />

        <h2 class="w-full mx-auto mb-5 text-lg text-center text-gray-400">(Optional)</h2>

        <div class="grid gap-2 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($inventoryItems->where('category', 'CHAIRS & TABLES') as $item)
                <div class="flex flex-col justify-end h-full" x-data="{ quantity{{ $item->id }}: 0 }">
                    <x-label for="{{ $item->item_name }}">
                        {{ $item->item_name }} 
                        <span class="ml-2">₱{{ number_format($item->price, 2, '.', ',') }}</span>
                    </x-label>
                    <div class="inline-flex w-full">
                        <x-secondary-button type="button" x-on:click="quantity{{ $item->id }} = Math.max(quantity{{ $item->id }} - 1, 0); $wire.updateQuantity({{ $item->id }}, quantity{{ $item->id }})" tabindex="-1" class="rounded-r-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">-</x-secondary-button>
                        <x-input id="{{ $item->item_name }}" x-model="quantity{{ $item->id }}" class="block w-full rounded-none focus:!border-gray-300 focus:!ring-0" tabindex="-1" type="number" name="quantity" value="0" min="0" readonly />
                        <x-secondary-button type="button" x-on:click="quantity{{ $item->id }} = quantity{{ $item->id }} + 1; $wire.addItem({{ $item->id }}, quantity{{ $item->id }})" tabindex="-1" class="rounded-l-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">+</x-secondary-button>
                    </div>
                </div>
            @endforeach
        </div>

        <x-form-divider value="Catering Equipment Rental" />

        <h2 class="w-full mx-auto mb-5 text-lg text-center text-gray-400">(Optional)</h2>

        <div class="grid gap-2 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($inventoryItems->where('category', 'CATERING EQUIPMENT') as $item)
                <div class="flex flex-col justify-end h-full" x-data="{ quantity{{ $item->id }}: 0 }">
                    <x-label for="{{ $item->item_name }}">
                        {{ $item->item_name }} 
                        <span class="ml-2">₱{{ number_format($item->price, 2, '.', ',') }}</span>
                    </x-label>
                    <div class="inline-flex w-full">
                        <x-secondary-button type="button" x-on:click="quantity{{ $item->id }} = Math.max(quantity{{ $item->id }} - 1, 0); $wire.updateQuantity({{ $item->id }}, quantity{{ $item->id }})" tabindex="-1" class="rounded-r-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">-</x-secondary-button>
                        <x-input id="{{ $item->item_name }}" x-model="quantity{{ $item->id }}" class="block w-full rounded-none focus:!border-gray-300 focus:!ring-0" tabindex="-1" type="number" name="quantity" value="0" min="0" readonly />
                        <x-secondary-button type="button" x-on:click="quantity{{ $item->id }} = quantity{{ $item->id }} + 1; $wire.addItem({{ $item->id }}, quantity{{ $item->id }})" tabindex="-1" class="rounded-l-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">+</x-secondary-button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="relative flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>  
    </div>

    <!-- Reservation Summary -->
    <div x-show="step == 4">
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

        <ul class="m-0 text-base lg:mx-10 font-noticia">
            <li>
                <p>Package: <span x-text="packageText"></span></p>
            </li>
            <li>
                <p>Menu: <span x-text="menuName"></span></p>
            </li>
            <li>
                <p>Price: ₱<span>{{ number_format($menuPrice, 2, '.', ',') }}</span></p>
            </li>
        </ul>

        @if ($additionalItems)
            <x-form-divider value="Rentals" />

            <div class="flex justify-center">
                <table class="w-full md:w-[70%] text-sm text-left rtl:text-right lg:mx-10 font-noticia">
                    <thead class="text-base">
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        @foreach ($additionalItems as $item)
                            <tr>
                                <td>{{ $item['item']->item_name }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>₱{{ number_format($item['item']->price * $item['quantity'], 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @foreach ($additionalItems as $index => $item)
                <input type="hidden" name="additionalItems[{{ $index }}][id]" value="{{ $item['item']->id }}">
                <input type="hidden" name="additionalItems[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
            @endforeach
        @endif

        <x-form-divider />
        
        <div class="flex justify-end w-full px-10 font-semibold font-noticia">
            <p>Total Cost (with tax): ₱{{ number_format($totalCost, 2, '.', ',') }}</p>
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>    
    </div>
    
    <!-- Payment Details -->
    <div x-show="step == 5">
        <x-form-divider value="Payment Details" />

        <div class="flex flex-col w-full mx-auto my-5 lg:w-2/3">
            <h2 class="text-md md:text-lg font-noticia">
                Total Cost: ₱{{ number_format($totalCost, 2, '.', ',') }}
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
                Amount to pay: ₱{{ number_format($amountToPay, 2, '.', ',') }}
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

                formHeading() {
                    if(this.step == 4)
                        return 'Reservation Summary';
                    else if(this.step == 3)
                        return "Rentals";
                    else 
                        return 'Reservation Details';
                },

                fieldsValidated(){
                    if(this.step === 1){
                        return this.address 
                        && this.occasion != "Select Occasion" 
                        && this.package != "Select Package" 
                        && this.pax;

                       // return true;   
                    }
                    else if(this.step === 2){
                        return this.menu
                        // return true;   
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