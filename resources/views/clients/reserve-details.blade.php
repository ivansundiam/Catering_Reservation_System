<x-app-layout>
    <x-slot name="title">
        {{ __('Reservation Details | ' . config('app.name')) }}
    </x-slot>

    <div class="grid gap-5 py-12 mx-auto max-w-7xl lg:grid-cols-5 lg:px-8 md:px-4">
        <div class="lg:col-span-3">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Reservation Details</h2>
                </div>

                <div>
                    <x-form-divider />

                    <h2 class="m-0 mt-5 text-base font-noticia lg:mx-10">Transaction no.:
                        <span>{{ $reservation->transaction_number }}</span>
                    </h2>

                    <x-form-divider value="Personal Information & Event Details" />

                    <ul class="m-0 text-base lg:mx-10 font-noticia">
                        <li>
                            <p>Name: <span>{{ $reservation->user->name }}</span></p>
                        </li>
                        <li>
                            <p>Phone Number: <span>{{ $reservation->phone_number}}</span></p>
                        </li>
                        @if ($reservation->additional_number)
                            <li>
                                <p>Additional Number: <span>{{ $reservation->additional_number}}</span></p>
                            </li>
                        @endif
                        <li>
                            <p>Event Address: <span>{{ $reservation->address }}</span></p>
                        </li>
                        <li>
                            <p>Occasion: <span>{{ $reservation->occasion }}</span></p>
                        </li>
                        <li>
                            <p>Pax: <span>{{ $reservation->pax }}</span></p>
                        </li>
                        @if ($reservation->adults && $reservation->kids)
                            <li>
                                <p> - Adults: <span>{{ $reservation->adults }}</span></p>
                            </li>
                            <li>
                                <p> - Kids: <span>{{ $reservation->kids }}</span></p>
                            </li>
                        @endif
                    </ul>

                    <x-form-divider value="Time and Date" />

                    <ul class="m-0 text-base lg:mx-10 font-noticia">
                        <li>
                            <p>Date Reserved: <span>{{ $reservation->created_at->format('M d, Y') }}</span></p>
                        </li>
                        <li>
                            <p>Event Date: <span>{{ $reservation->date->format('M d, Y') }}</span></p>
                        </li>
                        <li>
                            <p>Time: <span>{{ $reservation->time->format('g : i A') }}</span></p>
                        </li>
                    </ul>

                    <x-form-divider value="Package Details" />

                    <ul class="m-0 text-base lg:mx-10 font-noticia">
                        <div>
                            <li>
                                <p>Package: <span>{{ $reservation->package->name }}</span></p>
                            </li>
                            <li>
                                <p>Menu: <span>{{ $reservation->menu->name }}</span></p>
                            </li>
                            @if ($reservation->beverage)
                                <li>
                                    <p>Beverage: <span>{{ $reservation->beverage }}</span></p>
                                </li>
                            @endif
                            <li>
                                <p>Price: ₱<span>{{ number_format($reservation->menu->price, 2, '.', ',') }}</span></p>
                            </li>
                            <li>
                                <p>Amount Paid: ₱<span>{{ number_format($reservation->amount_paid, 2, '.', ',') }}
                                        ({{ $reservation->payment_percent }}%)</span></p>
                            </li>
                        </div>
                        <div>

                        </div>
                    </ul>

                    @if ($reservation->rentals)
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
                                    @foreach (json_decode($reservation->rentals, true) as $item)
                                        @php
                                            $inventoryItem = json_decode($item['item'], true); // Decode the nested JSON string
                                        @endphp
                                        <tr>
                                            <td>{{ $inventoryItem['item_name'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>₱{{ number_format($inventoryItem['price'], 2, '.', ',') }}</td>
                                            <td>₱{{ number_format(intval($item['itemTotalCost']), 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if ($reservation->add_ons)
                        <x-form-divider value="Options / Additional Charge" />

                        <ul class="m-0 text-base lg:mx-10 font-noticia">
                            @foreach (json_decode($reservation->add_ons, true) as $option)
                                <li>
                                    <p>- {{ $option['option'] }}<span>
                                            (₱{{ number_format(intval($option['price']), 2, '.', ',') }})
                                        </span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <x-form-divider />

                    <div class="flex justify-end w-full px-10 font-semibold font-noticia">
                        <p>Total Cost: ₱{{ number_format($reservation->total_cost, 2, '.', ',') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2" x-data="reservationDetails()">
            <div class="p-5 overflow-hidden bg-white shadow-lg md:p-10 sm:rounded-lg">

                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Payment Details</h2>
                </div>

                <div class="flex flex-col w-full mx-auto my-5">

                    @php
                        $percent = $reservation->payment_percent;
                        $completed = $percent >= 90;
                        $hasNotice = $reservation->has_notice;
                    @endphp

                    <div class="inline-block w-full mt-5 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="{{ $completed ? 'bg-green-500' : 'bg-primary' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width: {{ $completed ? '100' : $percent }}%">
                            {{ $completed ? ($percent === 90 ? 'Completed(90%)' : 'Completed') : $percent . '%' }}
                        </div>
                    </div>

                    @livewire('reservation.attachment-modal', ['reservation' => $reservation])

                    <div id="accordion-flush-2" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <h2 id="accordion-flush-heading-2">
                            <button type="button" tabindex="-1"
                                class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-2" aria-expanded="true"
                                aria-controls="accordion-flush-body-2">
                                <h3 class="text-lg font-semibold font-noticia">Balance</h3>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" wire:ignore.self class="hidden"
                            aria-labelledby="accordion-flush-heading-2">
                            <ul class="text-base font-noticia">
                                <li class="flex justify-between">
                                    <p>Amount Paid:</p>
                                    <span>₱{{ number_format($reservation->amount_paid, 2, '.', ',') }}
                                        ({{ $reservation->payment_percent }}%)</span>
                                </li>
                                <li class="flex justify-between">
                                    <p>Total Cost: </p>
                                    <span>₱{{ number_format($reservation->total_cost, 2, '.', ',') }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <p>Remaining Balance: </p>
                                    <span>₱{{ number_format($balance, 2, '.', ',') }}</span>
                                </li>
                                @if ($reservation->payment_percent !== 60)
                                <li class="flex justify-between">
                                    <p>Next Payment Due (60%): </p>
                                    <span>{{ $nextPaymentDate->format('M d, Y') }}</span>
                                </li>
                                @endif
                                <li class="flex justify-between">
                                    <p>Next Payment Due (90%): </p>
                                    <span>{{ $secondPaymentDate->format('M d, Y') }}</span>
                                </li>
                            </ul>

                            <x-payment-note>
                                <p class="font-bold">PLEASE READ:</p> 
                                <ul class="px-3 list-disc">
                                    <li>Payment for your reservation is due by <b><u>{{ $reservation->payment_percent !== 60 ? $nextPaymentDate->format('M d, Y') : $secondPaymentDate->format('M d, Y') }}</u></b>. Failure to submit payment by this date may result in the <b><u>cancellation of your reservation</u></b>. We kindly remind you to settle the balance before the payment due date to secure your reservation. Thank you for your cooperation.</li>
                                    <li>Paying 90% of the total cost will mark the payment as complete. However, remember that the remaining 10% must still be paid at the actual event. Thank you for your understanding.</li>
                                </ul>
                            </x-payment-note>
                        </div>
                    </div>

                    @if (!$completed && !$hasNotice)
                        <div id="accordion-flush-3" data-accordion="collapse"
                            data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                            data-inactive-classes="text-gray-500 dark:text-gray-400">

                            <h2 id="accordion-flush-heading-3">
                                <button type="button" tabindex="-1"
                                    class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400"
                                    data-accordion-target="#accordion-flush-body-3" aria-expanded="true"
                                    aria-controls="accordion-flush-body-3">
                                    <h3 class="text-lg font-semibold font-noticia">Payment</h3>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-flush-body-3" wire:ignore.self class="hidden"
                                aria-labelledby="accordion-flush-heading-3">

                                <form action="{{ route('reservation.update', $reservation->id) }}" method="post"
                                    enctype="multipart/form-data" id="reservationUpdateForm"
                                    x-on:submit="buttonDisabled = true">
                                    @csrf
                                    @method('PUT')

                                    <x-validation-errors />
                                    <div class="mt-5">
                                        <x-label for="payment_percent">Payment Percent:</x-label>
                                        <select x-model.fill="payPercent" name="payment_percent"
                                            class="w-full input-field" id="payment_percent">
                                            <option selected disabled>{{ __('Select Payment Percent') }}</option>
                                            @foreach ($payment_percentages as $percent)
                                                @if ($percent > $reservation->payment_percent)
                                                    <option value="{{ $percent }}"
                                                        {{ old('payment_percent') == $percent ? 'selected' : '' }}>
                                                        {{ $percent == 100 ? 'Full' : $percent }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error for="payment_percent" />

                                        <p class="mt-3" x-show="amountToPay()">
                                            Amount to pay: ₱
                                            <span
                                                x-text="amountToPay().toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })"></span>
                                        </p>

                                        <input type="hidden" name="amount_paid" x-model="amountToPay()">
                                        <x-input-error for="amount_paid" />

                                    </div>

                                    <div>
                                        <h2 class="my-3 text-center text-md md:text-lg font-noticia">Select Payment
                                            Method
                                        </h2>
                                        @livewire('reservation.payment-display-modal')
                                    </div>

                                    <div class="mt-5">
                                        <x-label for="receipt-img">Receipt Photo:</x-label>
                                        <x-dropbox x-model="receiptImg" id="receipt-img" label="Click to upload"
                                            name="receipt-img" />
                                        <x-input-error for="receipt-img" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="mt-5 flex !justify-center">
                    @if ($reservation->payment_percent < 90)
                        @livewire('reservation.cancel-modal', ['reservation' => $reservation])

                        @if (!$hasNotice)
                            <div class="relative flex justify-center">
                                <div x-show="incompleteFields" x-on:close.stop="incompleteFields = false"
                                    x-on:keydown.escape.window="incompleteFields = false"
                                    x-on:click.outside="incompleteFields = false"
                                    class="absolute z-50 p-2 mb-1 text-sm text-gray-400 w-64 bg-gray-100 rounded-md shadow-lg top-[-45px]"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0 translate-y-5"
                                    x-transition:enter-end="opacity-100 translate-y-0">
                                    {{ __('Fill required fields before proceeding') }}
                                </div>
                                <button type="button" x-bind:disabled="buttonDisabled" x-on:click="submitForm()"
                                    class="ms-3 btn-primary">
                                    <div role="status" x-show="buttonDisabled" class="w-full">
                                        <svg class="mx-auto animate-spin" width="20px" height="20px"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            transform="rotate(0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612"
                                                    stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <span x-show="!buttonDisabled">Pay</span>
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('reservationDetails', () => ({
                    buttonDisabled: false,
                    payPercent: '',
                    receiptImg: '',
                    totalCost: {{ $reservation->total_cost }},
                    amountPaid: {{ $reservation->amount_paid }},
                    incompleteFields: false,

                    amountToPay() {
                        if (this.payPercent === '20') {
                            return this.totalCost * 0.2 - this.amountPaid;
                        } else if (this.payPercent === '60') {
                            return this.totalCost * 0.6 - this.amountPaid;
                        } else if (this.payPercent === '90') {
                            return this.totalCost * 0.9 - this.amountPaid;
                        } else if (this.payPercent === '100') {
                            return this.totalCost * 1 - this.amountPaid;
                        } else {
                            return 0;
                        }
                    },

                    submitForm() {
                        if (this.payPercent != "Select Payment Percent" && this.receiptImg) {
                            this.incompleteFields = false;
                            this.buttonDisabled = true;
                            document.getElementById('reservationUpdateForm').submit();
                        } else {
                            this.incompleteFields = true;
                        }
                    },


                }));
            });
        </script>
    @endpush
</x-app-layout>
