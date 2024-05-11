<form action="{{ route('users.update', $user->id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="flex flex-col items-center md:flex-row md:items-center"
    x-data="{ viewImage: false }">
    @csrf
    @method('PUT')

    <div class="flex flex-col items-center w-64 h-full">
        <x-label for="id_verify_img" value="{{ __('User Verification Id') }}" class="mb-3 text-xl font-semibold" />
        <div type="button" x-on:click="viewImage = !viewImage" class="bg-gray-200 rounded-lg hover:bg-gray-300 ">
            <img src="{{ asset('storage/' . $user->id_verify_img) }}" id="id_verify_img" class="object-contain w-full h-80" alt="id image">
        </div>
    </div>

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
            <button type="button" class="absolute flex top-2 right-2 z-10 text-white rounded-full size-8 items-center justify-center text-[1.5rem] hover:bg-gray-100 hover:bg-opacity-30 active:bg-opacity-30 active:bg-gray-300">×</button>  
        </div>
        <img src="{{ asset('storage/' . $user->id_verify_img) }}" id="id_verify_img" class="fixed top-[15vh] z-50 object-contain left-[15vw] w-[70vw] h-[70vh]" alt="id photo view">
    </div>

    <div class="w-full md:w-auto md:ml-10 grow">
        <div class="mt-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" class="block w-full mt-1 disabled:bg-transparent" type="text" name="name" :value="$user->name" disabled/>
        </div>

        <div class="mt-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="block w-full mt-1 disabled:bg-transparent" type="text" name="email" :value="$user->email" disabled/>
        </div>

        <div class="mt-4">
            <x-label for="phone_number" value="{{ __('Phone Number') }}" />
            <x-input id="phone_number" class="block w-full mt-1 disabled:bg-transparent" type="text" name="phone_number" :value="$user->phone_number" disabled/>
        </div>

        <div class="mt-4">
            <x-label for="verified" value="{{ __('Verified') }}" />
            <x-input id="verified" class="block w-full mt-1 disabled:bg-transparent" type="text" name="verified" :value="$user->verified ? 'Yes' : 'No'" disabled/>
        </div>

        <x-dialog-modal wire:model="showingModal">
            <x-slot name="title">
                {{ __('Verify this user?') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure to verify the user? This would give them to access reservation.') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="showModal">
                    {{ __('Back') }}
                </x-secondary-button>

                <button type="submit" class="px-3 py-1 ms-2 btn-success">
                    {{ __('Verify') }}
                </button>
            </x-slot>

        </x-dialog-modal>

       @if (!$user->verified)
        <div class="mt-4 float-end">
            <button type="button" wire:click="showModal" class="px-3 py-1 ms-2 btn-success">
                {{ __('Verify') }}
            </button>
        </div>
       @endif
    </div>
</form>
