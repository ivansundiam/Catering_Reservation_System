<div>
    <button class="px-3 py-2 btn-success" wire:click="showForm" wire:loading.attr="disabled">
        {{ __('Add Item') }}
    </button>

    <!-- Add Item  Modal -->
    <x-dialog-modal maxWidth="lg" wire:model="showingForm">
        <x-slot name="title">
            {{ __('Add Item') }}
        </x-slot>

        <x-slot name="content">
            <form action="{{ route('inventory.store') }}"
                enctype="multipart/form-data"
                method="POST">
                @csrf
                
                <div class="mt-4">
                    <x-label for="item_name" value="{{ __('Item Name') }}" />
                    <x-input id="item_name" class="block w-full mt-1" type="text" name="item_name" :value="old('item_name')" required />
                </div>
     
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required />
                </div>
     
                <div class="mt-4">
                    <x-label for="category" value="{{ __('Category') }}" />
                    <x-input id="category" class="block w-full mt-1" type="text" name="category" :value="old('category')" required />
                </div>
     
                <div class="mt-4">
                    <x-label for="quantity" value="{{ __('Quantity') }}" />
                    <x-input id="quantity" class="block w-full mt-1" type="number" name="quantity" :value="old('quantity')" required />
                </div>
     
                <div class="mt-4">
                    <x-label for="item_img" value="{{ __('Upload Item Image') }}" />
                    <x-dropbox id="item_img" label="Click to upload" name="item_img" class="mb-4"/>
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <button type="submit" class="px-3 py-2 ms-2 btn-success" wire:loading.attr="disabled">
                {{ __('Add') }}
            </button>
        </form>

        </x-slot>
    </x-dialog-modal>
</div>