<form action="{{ route('users.update', $user->id) }}"
    method="POST"
    class="flex items-start"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="flex flex-col items-center w-64">
        <x-label for="id_verify_img" value="{{ __('User Verification Id') }}" class="mb-3 text-xl font-semibold" />
        <img src="{{ asset('storage/' . $user->id_verify_img) }}" id="id_verify_img" class="object-cover w-full rounded-lg mb-1 h-80" alt="">
    </div>
    <div class="ml-10 grow">
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
