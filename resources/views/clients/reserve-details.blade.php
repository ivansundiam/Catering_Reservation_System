<x-app-layout>
    <x-slot name="title">
        {{ __('Reservation Details | ' . config('app.name')) }}
    </x-slot>

    <div class="grid gap-5 py-12 mx-auto max-w-7xl lg:grid-cols-3 lg:px-8 md:px-4">
        <div class="lg:col-span-2">
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
                            <p>Address: <span>{{ $reservation->address }}</span></p>
                        </li>
                        <li>
                            <p>Occasion: <span>{{ $reservation->occasion }}</span></p>
                        </li>
                        <li>
                            <p>Pax: <span>{{ $reservation->pax }}</span></p>
                        </li>
                    </ul>

                    <x-form-divider value="Time and Date" />

                    <ul class="m-0 text-base lg:mx-10 font-noticia">
                        <li>
                            <p>Date: <span>{{ $reservation->date->format('M d, Y') }}</span></p>
                        </li>
                        <li>
                            <p>Time: <span>{{ $reservation->time->format('g : i A') }}</span></p>
                        </li>
                    </ul>

                    <x-form-divider value="Package Details" />

                    <ul class="grid grid-cols-2 m-0 text-base lg:mx-10 font-noticia">
                        <div>
                            <li>
                                <p>Package: <span>{{ $reservation->package->name }}</span></p>
                            </li>
                            <li>
                                <p>Menu: <span>{{ $reservation->menu->name }}</span></p>
                            </li>
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

        <div class="lg:col-span-1">
            <div class="p-5 overflow-hidden bg-white shadow-lg md:p-10 sm:rounded-lg">

                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Payment Details</h2>
                </div>

                <form action="{{ route('reservation.update', $reservation->id) }}" method="post"
                    enctype="multipart/form-data" class="flex flex-col w-full mx-auto my-5">
                    @csrf
                    @method('PUT')

                    @php
                        $percent = $reservation->payment_percent;
                        $completed = $percent >= 90;
                    @endphp

                    <div class="inline-block w-full mt-5 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="{{ $completed ? 'bg-green-500' : 'bg-primary' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                            style="width: {{ $completed ? '100' : $percent }}%">
                            {{ $completed ? 'Completed' : $percent . '%' }}
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
                            </ul>

                            <x-payment-note />
                        </div>
                    </div>

                    @if (!$completed)
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
                                <div class="mt-5" x-data="reservationDetails()">
                                    <x-label for="payment_percent">Payment Percent:</x-label>
                                    <select x-model.fill="payPercent" name="payment_percent" class="w-full input-field"
                                        id="payment_percent">
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
                                </div>

                                <div>
                                    <h2 class="my-3 text-center text-md md:text-lg font-noticia">Select Payment Method
                                    </h2>
                                    @livewire('reservation.payment-display-modal')
                                </div>

                                <div class="mt-5">
                                    <x-label for="receipt-img">Receipt Photo:</x-label>
                                    <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img" />
                                    <x-input-error for="receipt-img" />
                                </div>

                                <div class="mx-auto mt-5">
                                    <button type="submit" class="self-center mx-auto btn-primary">Pay</button>
                                </div>
                            </div>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('reservationDetails', () => ({
                    payPercent: '',
                    totalCost: {{ $reservation->total_cost }},
                    amountPaid: {{ $reservation->amount_paid }},

                    // amountToPay() {
                    //     if (this.payPercent === '20') {
                    //         let amount = this.totalCost * 0.2 - this.amountPaid;
                    //         return amount.toLocaleString('en-US', {
                    //             minimumFractionDigits: 2,
                    //             maximumFractionDigits: 2
                    //         });
                    //     } else if (this.payPercent === '60') {
                    //         let amount = this.totalCost * 0.6 - this.amountPaid;
                    //         return amount.toLocaleString('en-US', {
                    //             minimumFractionDigits: 2,
                    //             maximumFractionDigits: 2
                    //         });
                    //     } else if (this.payPercent === '90') {
                    //         let amount = this.totalCost * 0.9 - this.amountPaid;
                    //         return amount.toLocaleString('en-US', {
                    //             minimumFractionDigits: 2,
                    //             maximumFractionDigits: 2
                    //         });
                    //     } else if (this.payPercent === '100') {
                    //         let amount = this.totalCost * 1 - this.amountPaid;
                    //         return amount.toLocaleString('en-US', {
                    //             minimumFractionDigits: 2,
                    //             maximumFractionDigits: 2
                    //         });
                    //     } else {
                    //         return 0;
                    //     }
                    // }

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
                    }


                }));
            });
        </script>
    @endpush
</x-app-layout>
