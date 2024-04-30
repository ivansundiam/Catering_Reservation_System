<div class="!text-left">
    <x-dropdown-link type="button" wire:click.lazy="showCancelModal">
        {{ __('Delete') }}
    </x-dropdown-link>
    
    <x-dialog-modal wire:model="showingCancelModal">
        <x-slot name="title">
            {{ __('Delete Items') }}
        </x-slot>
        <x-slot name="content">
            <p class="mb-4">
                {!! __('Are you sure you want to proceed with deleting these items?
                 This action is <span class="font-bold underline">irreversible</span> and will <span class="font-bold underline">remove all quantities</span> of the 
                 selected items from inventory.') !!}
            </p>
        </x-slot>
        <x-slot name="footer">
            <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" 
                class="flex items-center" id="deleteForm"
                x-data="{ buttonDisabled: false}" x-on:submit="buttonDisabled = true">
                @csrf
                @method('DELETE')
                
                <x-secondary-button wire:click="showCancelModal">back</x-secondary-button>
                <button type="button" x-on:click="buttonDisabled = true;document.getElementById('deleteForm').submit()" class="btn-danger ms-3" x-bind:disabled="buttonDisabled">
                    <div role="status" x-show="buttonDisabled" class=" w-20">
                        <svg class="mx-auto animate-spin" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                    </div>
                    <span x-show="!buttonDisabled">Delete Items</span>
                </button>                                    
            </form>
        </x-slot>        
    </x-dialog-modal>
</div>
