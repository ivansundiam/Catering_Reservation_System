<div class="!text-left">
    <x-dropdown-link wire:click="show">
        {{ __('Restore') }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="showing">
        <x-slot name="title">
            Restore user?
        </x-slot>
        <x-slot name="content">
            Are you sure to restore this account?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="show">
                cancel
            </x-secondary-button>
            <form action="{{ route('users.restore', $user->id) }}" method="POST">
                @csrf
                
                <button type="submit" class="ml-2 btn-primary">
                    Restore
                </button>
            </form>
        </x-slot>    
    </x-dialog-modal>  
</div>