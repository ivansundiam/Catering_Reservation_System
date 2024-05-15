<div class="!text-left">
    <x-dropdown-link wire:click="$toggle('show')">
        {{ __('Delete') }}
    </x-dropdown-link>

    <x-dialog-modal wire:model="show">
        <x-slot name="title">
            Delete user?
        </x-slot>
        <x-slot name="content">
            Are you sure you want to permanently delete this account? This action is <span class="font-bold underline">irreversible.</span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('show')">
                cancel
            </x-secondary-button>
            <form action="{{ route('users.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="ml-2 btn-danger">
                    Delete
                </button>
            </form>
        </x-slot>    
    </x-dialog-modal>  
</div>