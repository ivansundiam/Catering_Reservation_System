<div>
    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
        <h2 id="accordion-flush-heading-1">
            <button type="button" class="flex items-center justify-between w-full gap-3 py-5 font-medium text-gray-500 border-b border-gray-200 rtl:text-right dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                <h3 class="text-lg font-semibold font-noticia">Receipts</h3>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-flush-body-1" wire:ignore.self class="hidden" aria-labelledby="accordion-flush-heading-1">
            <div class="flex justify-end">
                <button type="button" wire:click="showModal" aria-label="view all receipt button" wire:loading.attr="disabled" class="flex text-blue-500 hover:text-blue-600">View All Receipts</button>
            </div>
            @foreach (explode(',', $reservation->receipt_img) as $index => $imagePath)
                <div>
                    <div class="mt-5 mb-2 text-base">
                        <span class="font-semibold">Payment Date:</span>
                        {{ \Carbon\Carbon::parse($reservation->payment_dates[$index])->format('M d, Y - g:i A') }}
                    </div>
                    <div class="flex justify-center mx-auto max-w-96" x-data="{ viewImage: false }">
                        <button type="button" class="flex justify-center px-4 py-1 bg-gray-100 shadow hover:bg-gray-200" x-on:click="viewImage = !viewImage">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 11C9.10457 11 10 10.1046 10 9C10 7.89543 9.10457 7 8 7C6.89543 7 6 7.89543 6 9C6 10.1046 6.89543 11 8 11Z" stroke="#4f4f4f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6.56055 21C12.1305 8.89998 16.7605 6.77998 22.0005 14.63" stroke="#4f4f4f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18 3H6C3.79086 3 2 4.79086 2 7V17C2 19.2091 3.79086 21 6 21H18C20.2091 21 22 19.2091 22 17V7C22 4.79086 20.2091 3 18 3Z" stroke="#4f4f4f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <span class="ml-2">{{ substr(trim($imagePath), -20) }}</span>
                        </button>
                        <!-- full image view -->
                        <div x-show="viewImage" x-on:click="viewImage = !viewImage" class="z-40 flex items-center justify-center">
                            <div x-show="viewImage" class="fixed inset-0 transition-all transform"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0">
                                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
                                <button type="button" class="absolute flex top-2 right-2 z-10 text-white rounded-full size-8 items-end justify-center text-[1.5rem] hover:bg-gray-100 hover:bg-opacity-30 active:bg-opacity-30 active:bg-gray-300">×</button>  
                            </div>
                            <img src="{{ asset('storage/' . trim($imagePath)) }}" id="receipt_img" class="fixed top-[15%] z-50 object-contain left-[15%] w-[70%] h-[70%]" alt="Receipt photo view">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    

    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            Submitted Receipt Images
        </x-slot>
        <x-slot name="content">
            @foreach (explode(',', $reservation->receipt_img) as $index => $imagePath)
                <div>
                    <div class="mb-5 text-lg">
                        <span class="font-semibold">Payment Date:</span>
                         {{ \Carbon\Carbon::parse($reservation->payment_dates[$index])->format('M d, Y - g:i A') }}
                    </div>
                    <div class="flex justify-center mx-auto max-w-96" x-data="{ viewImage: false }">
                        <button type="button" x-on:click="viewImage = !viewImage">
                            <img src="{{ asset('storage/' . trim($imagePath)) }}" alt="Receipt Photo">
                        </button>
                        <!-- full image view -->
                        <div x-show="viewImage" x-on:click="viewImage = !viewImage" class="z-40 flex items-center justify-center">
                            <div x-show="viewImage" class="fixed inset-0 transition-all transform"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0">
                                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
                                <button type="button" class="absolute flex top-2 right-2 z-10 text-white rounded-full size-8 items-end justify-center text-[1.5rem] hover:bg-gray-100 hover:bg-opacity-30 active:bg-opacity-30 active:bg-gray-300">×</button>  
                            </div>
                            <img src="{{ asset('storage/' . trim($imagePath)) }}" id="receipt_img" class="fixed top-[15%] z-50 object-contain left-[15%] w-[70%] h-[70%]" alt="Receipt photo view">
                        </div>
                    </div>
                </div>

                <x-form-divider />
            @endforeach


        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="showModal">close</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
