<form action="{{ route('inventory.update', $item->id) }}"
    method="POST"
    class="relative flex flex-col items-center md:items-start md:flex-row"
    enctype="multipart/form-data"
    x-cloak 
    x-data="{ fieldDisabled: @entangle('isDisabled'), 
        fileAttached: @entangle('image'), 
        count: {{ $item->quantity }}  }">
    @csrf
    @method('PUT')

    <div class="flex flex-col items-center w-64">
        <x-label for="item_img" value="{{ __('Item Image') }}" class="mb-3 text-xl font-semibold" />
        <!-- if item has image attachment -->
        @if ($item->item_img)
            <div x-show="!fileAttached">
                <img src="{{ asset('storage/' . $item->item_img) }}" id="item_img" class="object-cover w-full mb-1 rounded-lg h-80" alt="Item Image">
                <label for="upload-img" class="w-full py-3 select-none btn-info" x-bind:class="{ 'pointer-events-none !bg-gray-400': fieldDisabled }">
                    Update image
                </label>
                <input type="file" 
                    x-on:change="fileAttached = true" 
                    wire:model="image" 
                    class="hidden" 
                    name="item_img" 
                    id="upload-img" 
                    accept="image/*">
            </div>
        @else
            <input x-bind:disabled="fieldDisabled" 
                x-show="!fileAttached" 
                x-on:change="fileAttached = true" 
                wire:model="image" 
                class="flex flex-col w-full text-sm border rounded-lg cursor-pointer disabled:bg-gray-200 focus:outline-none file:!bg-blue-500 " 
                id="item_img" 
                name="item_img" 
                accept="image/*" 
                type="file"  />
        @endif

        <!-- thumbnail for attached images -->
        @if ($image)
            <div class="relative w-full mb-1 rounded-lg h-80">
                <img src="{{ $image->temporaryUrl() }}" alt="preview image"  class="object-cover w-full rounded-lg h-80" /> 
                <button wire:click="removeImg" type="button" class="absolute flex top-2 right-2 z-10 text-white rounded-full size-8 items-center justify-center text-[1.5rem] hover:bg-gray-100 hover:bg-opacity-30 active:bg-opacity-30 active:bg-gray-300">×</button>  
            </div>
        @endif
        <div wire:loading.flex wire:target="image" class="flex items-center justify-center w-full mb-1 bg-gray-200 rounded-lg h-80">
            <svg class="animate-spin" width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#bfbfbf" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
        </div>
    </div>
    <div class="w-full md:w-auto md:ml-10 grow">
        <button type="button" wire:click="showEdit" class="mb-2 size-8 !p-0 top-0 right-0 absolute btn-info">
            <svg width="15px" height="15px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="edit"> <g> <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon> </g> </g> </g> </g></svg>
        </button>
        <div class="mt-4">
            <x-label for="item_name" value="{{ __('Item Name') }}" />
            <x-input id="item_name" class="block w-full mt-1" type="text" name="item_name" :value="$item->item_name" disabled="{{ $isDisabled }}"/>
        </div>

        <div class="mt-4">
            <x-label for="description" value="{{ __('Description') }}" />
            <x-input id="description" class="block w-full mt-1" type="text" name="description" :value="$item->description" disabled="{{ $isDisabled }}"/>
        </div>

        <div class="mt-4">
            <x-label for="category" value="{{ __('Category') }}" />
            <x-input id="category" class="block w-full mt-1" type="text" name="category" :value="$item->category" disabled="{{ $isDisabled }}"/>
        </div>
        
        <div class="mt-4">
            <x-label for="price" value="{{ __('Price') }}" />
            <x-input id="price" class="block w-full mt-1" type="text" name="price" :value="$item->price" disabled="{{ $isDisabled }}"/>
        </div>

        <div class="mt-4">
            <x-label for="quantity" value="{{ __('Quantity') }}" />
            <div class="inline-flex w-full">
                <x-secondary-button type="button" x-on:click="count > 0 ? count-- : count = 0" class="rounded-r-none focus:!ring-transparent focus:ring-offset-0 disabled:bg-gray-300 disabled:!opacity-100 text-black font-bold !text-[1.5rem]" :disabled="$isDisabled">-</x-secondary-button>
                <x-input id="quantity" class="block w-full rounded-none" type="number" x-bind:value="count" name="quantity" min="0" :value="$item->quantity" disabled="{{ $isDisabled }}"/>
                <x-secondary-button type="button" x-on:click="count++" class="rounded-l-none focus:!ring-transparent focus:ring-offset-0 disabled:bg-gray-300 disabled:!opacity-100 text-black font-bold !text-[1.5rem]" :disabled="$isDisabled">+</x-secondary-button>
            </div>
        </div>

        <div class="mt-4 float-end">

            @if($editing)
                <button type="submit" wire:click="" class="px-3 py-1 ms-2 btn-success">
                    {{ __('Save') }}
                </button>
            @endif
        </div>
    </div>
</form>
