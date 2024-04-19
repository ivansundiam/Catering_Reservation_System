<x-app-layout> 
    <div class="grid gap-5 py-12 mx-auto max-w-7xl lg:grid-cols-3 lg:px-8 md:px-4">
        <div class="lg:col-span-2">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center">
                    <h2 class="forms-heading-text">Reservation Details</h2>
                </div>

                <div>
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
                                <p>Price: ₱<span>{{ $reservation->menu->price }}</span></p>
                            </li>
                            <li>
                                <p>Amount Paid: ₱<span>{{ $reservation->amount_paid }} ({{ $reservation->payment_percent }}%)</span></p>
                            </li>
                        </div>
                        <div>
                            
                        </div>
                    </ul>
            
                    <x-form-divider />
                    
                    <div class="flex justify-end w-full px-10 font-semibold font-noticia">
                        <p>Total Cost: ₱{{ $reservation->total_cost }}</p>
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

                    @livewire('reservation.attachment-modal', ['reservation' => $reservation])

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