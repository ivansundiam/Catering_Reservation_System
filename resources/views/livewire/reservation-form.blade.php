<form action="{{ route('reservation.store') }}" method="post" enctype="multipart/form-data" x-data="reservationForm()"
    x-on:submit="buttonDisabled = true" x-cloak>
    @csrf

    <x-validation-errors class="mb-4" />

    <div class="flex flex-col items-center">
        <h2 class="forms-heading-text" x-text="formHeading()"></h2>
    </div>

    <!-- Personal Information & Event Details -->
    <div x-show="step == 1">

        <x-form-divider value="Personal Information" />

        <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 md:grid-rows-3 md:grid-flow-col gap-x-16">
            <div class="mt-5">
                <x-label for="name" required>Name:</x-label>
                <x-input type="text" name="name" class="w-full" id="name" x-model="name" readonly />
                <x-input-error for="name" />
            </div>

            <div class="mt-5">
                <x-label for="city" required>Select City:</x-label>
                <select name="city" id="city" x-model.fill="city" class="w-full input-field">
                    <option selected>Select a city</option>
                    <option value="Manila">Manila</option>
                    <option value="Quezon City">Quezon City</option>
                    <option value="Caloocan City">Caloocan City</option>
                    <option value="Las Piñas City">Las Piñas City</option>
                    <option value="Makati City">Makati City</option>
                    <option value="Malabon City">Malabon City</option>
                    <option value="Mandaluyong City">Mandaluyong City</option>
                    <option value="Marikina City">Marikina City</option>
                    <option value="Muntinlupa City">Muntinlupa City</option>
                    <option value="Navotas City">Navotas City</option>
                    <option value="Parañaque City">Parañaque City</option>
                    <option value="Pasay City">Pasay City</option>
                    <option value="Pasig City">Pasig City</option>
                    <option value="Pateros">Pateros</option>
                    <option value="San Juan City">San Juan City</option>
                    <option value="Taguig City">Taguig City</option>
                    <option value="Valenzuela City">Valenzuela City</option>
                </select>
            </div>
            
            <div class="mt-5">
                <x-label for="event-address" required>Event Address:</x-label>
                <div class="flex">
                    <x-input x-model="eventAddress" name="event-address" class="w-full !rounded-r-none" x-bind:disabled="city == 'Select a city'" placeholder="House/Unit Number Street Name, Barangay/Subdivision" id="event-address" />
                    <x-input x-model="city"  name="city" class="input-field !rounded-l-none pointer-events-none w-1/2" readonly />
                </div>
                <x-input-error for="address" />
                <input type="text" name="address" x-model="fullAddress" hidden />
            </div>
            
            <div class="mt-5">
                <x-label for="phone_number" required>Phone Number:</x-label>
                <x-input x-model="phoneNumber" name="phone_number" class="w-full" id="phone_number" x-on:keypress="limitCharacterCount" />
                <x-input-error for="phone_number" />
            </div>
            
            <div class="mt-5">
                <x-label for="additional_number">Additional Number <span class="text-gray-500">(optional)</span>:</x-label>
                <x-input x-model="additionalNumber" name="additional_number" class="w-full" id="additional_number" x-on:keypress="limitCharacterCount" />
                <x-input-error for="additional_number" />
            </div>


        </div>

        <x-form-divider value="Event Details" />

        <div class="grid w-full grid-cols-1 mx-auto md:grid-cols-2 md:grid-rows-2 md:grid-flow-col gap-x-16">
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
                <div class="flex justify-between">
                    <x-label for="package" required>Package:</x-label>
                    <a href="{{ asset('assets/packages/packages.pdf') }}" target="_blank"
                        class="text-sm text-blue-500 hover:underline decoration-blue-500 underline-offset-2">
                        View all packages
                    </a>
                </div>
                <select x-model.fill="package"
                    x-on:change="packageText = $event.target.options[$event.target.selectedIndex].textContent; $wire.selectedPackage($event.target.value)"
                    name="package_id" class="w-full input-field" id="package">
                    <option selected disabled>{{ __('Select Package') }}</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ __($package->name) }}</option>
                    @endforeach
                </select>
                <x-input-error for="package" />
            </div>

            <div class="mt-5">
                <x-label for="pax" required>Pax:</x-label>
                <x-input x-model="pax" wire:model.change="pax" x-on:change="$wire.setPax()" name="pax"
                    type="number" min="1" max="300" :value="old('pax')" x-bind:readonly="occasion === 'Birthday'" class="w-full" id="pax"
                    placeholder="Enter Number of Attendees" />
                <x-input-error for="pax" />
            </div>

            <div class="flex mt-5 gap-x-5" x-show="occasion === 'Birthday'">
                <div class="w-full">
                    <x-label for="adults" required>Adults:</x-label>
                    <x-input x-model="adults" wire:model.change="adults" name="adults"
                        type="number" min="1" max="300" :value="old('adults')" x-on:input="updatePax()" class="w-full" id="adults"
                        placeholder="Enter adult Attendees" />
                </div>

                <div class="w-full">
                    <x-label for="kids" required>Kids:</x-label>
                    <x-input x-model="kids" wire:model.change="kids" name="kids"
                        type="number" min="1" max="300" :value="old('kids')" x-on:input="updatePax()" class="w-full" id="kids"
                        placeholder="Enter kid Attendees" />
                </div>

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
            <div x-show="incompleteFields"
                x-on:click.outside="incompleteFields = false"
                class="absolute p-2 mb-1 text-sm text-gray-400 bg-gray-100 rounded-md shadow-lg top-[-45px]"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
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
                        <p>Price : P590.00 / Head + 12%</p>
                        <div class="flex justify-end w-full">
                            <div>
                                <p>100 Heads = PHP 66,080</p>
                                <p>150 Heads = PHP 99,120</p>
                                <p>300 Heads = PHP198,240</p>
                            </div>
                        </div>
                    </x-tooltip>
                </div>
                <ul
                    class="grid w-full gap-4 px-5 py-3 mt-10 overflow-y-scroll font-noticia max-h-72 md:max-h-80 lg:max-h-96">

                    @if ($menus)
                        @foreach ($menus as $menu)
                            <li>
                                <input type="radio" x-model="menu"
                                    x-on:click="menuName = '{{ $menu->name }}'; $wire.selectedMenu({{ $menu->price }})"
                                    id="menu-{{ $menu->name }}" name="menu_id" value="{{ $menu->id }}"
                                    class="hidden peer" />
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

                @if ($packageName !== 'special' && $packageName !== 'ordinary')
                <h2 class="mx-5 mt-5 mb-3 text-md md:text-lg font-noticia">
                    Select Beverage:
                </h2>
                <ul class="grid w-full grid-cols-2 gap-4 px-5 font-noticia">
                    <li>
                        <input type="radio" x-model="beverage"
                            wire:model.change="beverage"
                            id="beverage-1" name="beverage" value="Iced Tea"
                            class="hidden peer" />
                        <label for="beverage-1" class="menu-card">
                            <div class="flex justify-between w-full">
                                <div class="text-lg font-semibold ">Iced Tea</div>
                            </div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" x-model="beverage"
                            wire:model.change="beverage"
                            id="beverage-2" name="beverage" value="Soft Drinks"
                            class="hidden peer" />
                        <label for="beverage-2" class="menu-card">
                            <div class="flex justify-between w-full">
                                <div class="text-lg font-semibold ">Soft Drinks</div>
                            </div>
                        </label>
                    </li>
                </ul>
                @endif
            </div>

            <div class="flex flex-col items-center w-full lg:w-72">
                @if ($packageName)
                    <h2 class="mb-3 text-md md:text-lg font-noticia">View full menu</h2>
                    <a href="{{ asset('assets/packages/' . $packageName . '.pdf') }}" target="_blank"
                        class="mx-2 duration-300 ease-in-out bg-gray-600 shadow cursor-pointer max-w-72 hover:shadow-xl hover:scale-105">
                        <img src="{{ asset('assets/web-images/low/package-' . $packageName . '.webp') }}"
                            class="package-service" fetchpriority="high" alt="package sapphire">
                    </a>
                @endif
            </div>
        </div>

        <div class="flex w-[85%] mx-auto md:flex-row">
            <div
                class="flex flex-col items-center w-full p-5 mx-auto capitalize bg-gray-200 border-2 border-gray-300 rounded-lg">

                @switch($inclusionType)
                    @case('wedding sapphire')
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            wedding</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            wedding</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            wedding</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            wedding</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            wedding</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            debut</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            debut</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            debut</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            debut</span>
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
                        <span class="text-base font-semibold text-gray-700 capitalize md:text-lg">Standard amenities for
                            debut</span>
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
            <div x-show="incompleteFields"
                x-on:click.outside="incompleteFields = false"
                class="absolute p-2 mb-1 text-sm text-gray-400 bg-gray-100 rounded-md shadow-lg top-[-45px]"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
                {{ __('Fill required fields before proceeding') }}
            </div>
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <x-button x-on:click="nextStep()" type="button">next</x-button>
        </div>
    </div>

    <!-- Rentals -->
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
                        <x-secondary-button type="button"
                            x-on:click="quantity{{ $item->id }} = Math.max(quantity{{ $item->id }} - 1, 0); $wire.updateQuantity({{ $item->id }}, quantity{{ $item->id }})"
                            tabindex="-1"
                            class="rounded-r-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">
                            -</x-secondary-button>
                        <x-input id="{{ $item->item_name }}" x-model="quantity{{ $item->id }}"
                            class="block w-full rounded-none focus:!border-gray-300 focus:!ring-0" tabindex="-1"
                            type="number" name="quantity" value="0" min="0" readonly />
                        <x-secondary-button type="button"
                            x-on:click="quantity{{ $item->id }} = quantity{{ $item->id }} + 1; $wire.addItem({{ $item->id }}, quantity{{ $item->id }})"
                            tabindex="-1"
                            class="rounded-l-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">
                            +</x-secondary-button>
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
                        <x-secondary-button type="button"
                            x-on:click="quantity{{ $item->id }} = Math.max(quantity{{ $item->id }} - 1, 0); $wire.updateQuantity({{ $item->id }}, quantity{{ $item->id }})"
                            tabindex="-1"
                            class="rounded-r-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">
                            -</x-secondary-button>
                        <x-input id="{{ $item->item_name }}" x-model="quantity{{ $item->id }}"
                            class="block w-full rounded-none focus:!border-gray-300 focus:!ring-0" tabindex="-1"
                            type="number" name="quantity" value="0" min="0" readonly />
                        <x-secondary-button type="button"
                            x-on:click="quantity{{ $item->id }} = quantity{{ $item->id }} + 1; $wire.addItem({{ $item->id }}, quantity{{ $item->id }})"
                            tabindex="-1"
                            class="rounded-l-none focus:!ring-transparent focus:ring-offset-0 text-black font-bold text-lg md:!text-[1.5rem]">
                            +</x-secondary-button>
                    </div>
                </div>
            @endforeach
        </div>

        <x-form-divider value="Options / Additional Charge" />

        <ul>
            <li>
                <x-checkbox name="add-ons" x-model="emcee" wire:click="addOption('Emcee')" value="Emcee"
                    id="emcee" />
                <label for="emcee" class="ms-2">Emcee - ₱4,000.00</label>
            </li>
            <li>
                <x-checkbox name="add-ons" x-model="christianWedding"
                    wire:click="addOption('Christian Wedding Set-up')" value="Christian Wedding Set-up"
                    id="christian-wedding" /><label for="christian-wedding" class="ms-2">Christian Wedding Set-up -
                    ₱15,000.00</label>
            </li>
        </ul>



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
                <p>Phone Number: <span x-text="phoneNumber"></span></p>
            </li>
            <div x-show="additionalNumber !== ''">
                <li>
                    <p>Additional Number: <span x-text="additionalNumber"></span></p>
                </li>
            </div>
            <li>
                <p>Event Address: <span x-text="fullAddress"></span></p>
            </li>
            <li>
                <p>Occasion: <span x-text="occasion"></span></p>
            </li>
            <li>
                <p>Pax: <span x-text="pax"></span></p>
            </li>
            <div x-show="occasion === 'Birthday'">
                <li>
                    <p> - Adults: <span x-text="adults"></span></p>
                </li>
                <li>
                    <p> - Kids: <span x-text="kids"></span></p>
                </li>
            </div>
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
            @if ($packageName !== 'special' && $packageName !== 'ordinary')
                <li>
                    <p>Beverage: <span x-text="beverage"></span></p>
                </li>
            @endif
            <li>
                <p>Price: ₱<span>{{ number_format($menuPrice, 2, '.', ',') }}</span></p>
            </li>
        </ul>

        @if ($additionalItems)
            <x-form-divider value="Rentals" />

            <div class="flex justify-center">
                <table class="w-full md:w-[90%] text-sm text-left rtl:text-right lg:mx-10 font-noticia">
                    <thead class="text-base">
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Cost</th>
                    </thead>
                    <tbody>
                        @foreach ($additionalItems as $item)
                            <tr>
                                <td>{{ $item['item']->item_name }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['item']->price }}</td>
                                <td>₱{{ number_format($item['item']->price * $item['quantity'], 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @foreach ($additionalItems as $index => $item)
                <input type="hidden" name="rentals[{{ $index }}][id]" value="{{ $item['item']->id }}">
                <input type="hidden" name="rentals[{{ $index }}][item]" value="{{ $item['item'] }}">
                <input type="hidden" name="rentals[{{ $index }}][quantity]"
                    value="{{ $item['quantity'] }}">
                <input type="hidden" name="rentals[{{ $index }}][itemTotalCost]"
                    value="{{ $item['quantity'] * $item['item']->price }}">
            @endforeach
        @endif

        @if ($addOns)
            <x-form-divider value="Options / Additional Charge" />

            <ul class="m-0 text-base lg:mx-10 font-noticia">
                @foreach ($addOns as $index => $option)
                    <li>
                        <p>- {{ $option['option'] }}
                            <span>(₱{{ number_format(intval($option['price']), 2, '.', ',') }})</span>
                        </p>
                    </li>

                    {{-- the value is from livewire ReservationForm --}}
                    <input type="hidden" name="addOns[{{ $index }}][option]"
                        value="{{ $option['option'] }}">
                    <input type="hidden" name="addOns[{{ $index }}][price]" value="{{ $option['price'] }}">
                @endforeach
            </ul>

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

            <div class="flex items-center">
                <x-label for="payment_percent" required>Payment Percent: </x-label>
                <x-tooltip id="payment-tooltip" size="25" placement="right">
                    <p>{{ __('Enter the percentage of the total cost you want to pay now') }}</p>
                </x-tooltip>
            </div>
            <select name="payment_percent" x-on:change="$wire.calculateAmountToPay($event.target.value)"
                class="w-full input-field" id="payment_percent">
                <option selected disabled>{{ __('Select Payment Percent') }}</option>
                <option value="20">{{ __('20') }}</option>
                <option value="60">{{ __('60') }}</option>
                <option value="90">{{ __('90') }}</option>
                <option value="100">{{ __('Full') }}</option>
            </select>
            <x-input-error for="payment_percent" />

            <x-payment-note />

            <h2 x-show="$wire.amountToPay" class="mt-5 text-md md:text-lg font-noticia">
                Amount to pay: ₱{{ number_format($amountToPay, 2, '.', ',') }}
                <input type="text" name="amount_paid" value="{{ $amountToPay }}" class="hidden" />

            </h2>

            <div class="flex items-center justify-center">
                <h2 class="my-3 text-center text-md md:text-xl font-noticia">Select Payment Method </h2>
                <x-tooltip id="payment-method-tooltip" size="25" placement="top">
                    <p>{{ __('Choose a payment method. Please ensure to pay the exact amount.') }}</p>
                </x-tooltip>
            </div>
            @livewire('reservation.payment-display-modal')

            <x-label for="receipt-img" required>Receipt Photo:</x-label>
            <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img" />
            <x-input-error for="receipt-img" />
        </div>

        <div class="flex justify-center w-full mt-8 md:justify-end">
            <x-secondary-button x-on:click="prevStep()" type="button" class="mr-3">back</x-secondary-button>
            <button type="button" wire:click="showConfimationModal" wire:loading.attr="disabled" class="btn-success">
                <div role="status" wire:loading wire:loading.class="min-w-[3.8rem]" class="w-full">
                    <svg class="mx-auto animate-spin" width="20px" height="20px" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612"
                                stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </div>
                <span wire:loading.remove>{{ __('Reserve') }}</span>
            </button>

            <x-dialog-modal wire:model="showingConfirmationModal" id="confirmationModal" maxWidth="sm">
                <x-slot name="title">
                    Confirm reservation
                </x-slot>
                <x-slot name="content">
                    <div class="mt-4 text-xl text-gray-600 dark:text-gray-400">
                        <h4 x-show="!buttonDisabled">Are you sure you want to confirm this reservation?</h4>
                        <div class="flex flex-col items-center justify-center" x-show="buttonDisabled">
                            <div role="status">
                                <svg aria-hidden="true" class="inline text-gray-200 size-16 animate-spin dark:text-gray-600 fill-gray-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>

                            <p class="text-gray-400">Please wait</p>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="showConfimationModal" class="mr-3">Back</x-secondary-button>
                    
                    <button class="min-w-24 btn-success" x-bind:disabled="buttonDisabled">
                        <span>{{ __('Reserve') }}</span>
                    </button>
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationForm', () => ({
                name: '{{ auth()->user()->name }}',
                eventAddress: '',
                city: '',
                phoneNumber: '{{ auth()->user()->phone_number }}',
                additionalNumber: '',
                adults: '',
                kids: '',
                pax: '',
                occasion: '',
                packageText: '',
                package: '',
                menu: '',
                menuName: '',
                beverage: '',
                buttonDisabled: false,
                incompleteFields: false,
                emcee: '',
                christianWedding: '',
                step: 1,

                get fullAddress() {
                    return `${this.eventAddress}, ${this.city}`;
                },

                limitCharacterCount(event) {
                    // Get the key code of the pressed key
                    const keyCode = event.keyCode;

                    // Allow numeric keys (0-9) and backspace (8)
                    if ((keyCode < 48 || keyCode > 57) && keyCode !== 8) {
                        event.preventDefault();
                    }

                    // Limit to 11 characters
                    if (event.target.value.length === 11) {
                        event.preventDefault();
                    }
                },

                updatePax() {
                    this.pax = parseInt(this.adults || 0) + parseInt(this.kids || 0);
                    this.$wire.set('pax', this.pax);
                },

                formHeading() {
                    if (this.step == 4)
                        return 'Reservation Summary';
                    else if (this.step == 3)
                        return "Rentals";
                    else
                        return 'Reservation Details';
                },

                fieldsValidated() {
                    if (this.step === 1) {
                        return this.fullAddress &&
                            this.eventAddress &&
                            this.occasion != "Select Occasion" &&
                            this.package != "Select Package" &&
                            this.pax;

                        // return true;   
                    } else if (this.step === 2) {
                        if(this.packageText !== 'Dinner / Lunch Buffet (Special)' && this.packageText !== 'Dinner / Lunch Buffet (Ordinary)') {
                            return this.menu && this.beverage;
                        } else {
                            return this.menu;
                        }
                        // return true;   
                    } else {
                        return true;
                    }
                },

                nextStep() {
                    if (this.fieldsValidated()) {
                        this.step++;
                        this.incompleteFields = false;
                        window.scrollTo({
                            top: 100,
                            behavior: 'smooth'
                        });
                    } else {
                        this.incompleteFields = true;
                    }
                },
                prevStep() {
                    this.step--;
                    window.scrollTo({
                        top: 180,
                        behavior: 'smooth'
                    });
                }
            }));
        });
    </script>
@endpush
