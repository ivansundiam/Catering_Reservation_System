<div class="!text-left">
    <x-dropdown-link wire:click="show">
        {{ __('Archive') }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="showing">
        <x-slot name="title">
            Archive user?
        </x-slot>
        <x-slot name="content">
            Are you sure to archive this account?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="show">
                cancel
            </x-secondary-button>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="ml-2 btn-danger">
                    Archive
                </button>
            </form>
        </x-slot>    
    </x-dialog-modal>  
</div>