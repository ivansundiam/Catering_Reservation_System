<div class="!text-left">
    @php
        $isClient = auth()->user()->user_type == "client";
    @endphp
    @if ($isClient)
        <button type="button" x-on:click="incompleteFields = false" wire:click.lazy="showCancelModal" class="btn-danger">
            <div class="w-14" wire:loading>
                <svg class="mx-auto animate-spin" width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612"
                            stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path>
                    </g>
                </svg>
            </div>
            <span wire:loading.remove>cancel</span>
        </button> 
    @else
        <x-dropdown-link type="button" wire:click.lazy="showCancelModal">
            {{ __('Delete') }}
        </x-dropdown-link>
    @endif

    <x-dialog-modal wire:model="showingCancelModal">
        <x-slot name="title">
            {{ __('Cancel Reservation') }}
        </x-slot>
        <x-slot name="content">
            <p class="mb-4">Are you sure you want to cancel this reservation?</p>
            @if ($isClient)
            <p class="mb-4">Please note that cancellation is <span class="font-bold underline">irreversible</span>, and canceled reservations are <span class="font-bold underline">non-refundable</span></p>
            <p class="mb-4">By confirming cancellation, you acknowledge that:</p>
            <ul class="list-disc pl-6 mb-4">
                <li>Your reservation will be canceled immediately.</li>
                <li>You will not be able to recover or reverse this action.</li>
                <li>Refunds or credits will not be issued for canceled reservations.</li>
            </ul>
            @endif
        </x-slot>
        <x-slot name="footer">
            <form action="{{ route(($isClient ? 'reservation.destroy': 'admin.reservation-delete'), $reservation->id) }}" method="POST" 
                class="flex items-center" id="deleteForm"
                x-data="{ buttonDisabled = false}" x-on:submit="buttonDisabled = true">
                @csrf
                @method('DELETE')
                
                <x-secondary-button wire:click="showCancelModal">back</x-secondary-button>
                <button type="button" x-on:click="buttonDisabled = true;document.getElementById('deleteForm').submit()" class="btn-danger ms-3" x-bind:disabled="buttonDisabled">
                    @if ($isClient)
                        <div role="status" x-show="buttonDisabled" class=" w-36">
                            <svg class="mx-auto animate-spin" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                        </div>
                    @endif
                    <span x-show="!buttonDisabled">Delete Reservation</span>
                </button>                                    
            </form>
        </x-slot>        
    </x-dialog-modal>
</div>
