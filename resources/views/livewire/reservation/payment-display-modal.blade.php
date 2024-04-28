<div class="flex justify-center mb-5">
    <button type="button" wire:click.layz="showGcash" wire:loading.class="opacity-75"
        class="px-3 py-1 rounded-lg shadow w-32 bg-[#087cfc] hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
        <div class="w-full" wire:loading wire:target="showGcash">
            <svg class="mx-auto animate-spin" width="25px" height="25px" viewBox="0 0 24 24" fill="none"
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
        <img src="{{ asset('assets/images/gcash-fill-logo.jpg') }}" alt="gcash logo" wire:loading.remove
            wire:target="showGcash">
    </button>
    <div class="mx-4 border-l-2 border-gray-400"></div>
    <button type="button" wire:click.layz="showMaya" wire:loading.class="opacity-75"
        class="px-6 py-3 bg-[#50b16b] rounded-lg shadow w-32 hover:shadow-lg hover:scale-[1.03] ease-in-out duration-100">
        <div class="w-full" wire:loading wire:target="showMaya">
            <svg class="mx-auto animate-spin" width="25px" height="25px" viewBox="0 0 24 24" fill="none"
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
        <img src="{{ asset('assets/images/maya-fill-logo.png') }}" alt="maya logo" wire:loading.remove
            wire:target="showMaya">
    </button>

    <!-- gcash modal -->
    <x-dialog-modal footerPosition="center" maxWidth="md" wire:model="showingGcash">
        <x-slot name="title">
            <div class="mx-auto">
                <div class="flex items-end my-2 ">
                    <x-application-mark class="block" />
                    <x-brand-name class="ml-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col items-center">
                <div class="max-w-36">
                    <img src="{{ asset('assets/images/gcash-logo.png') }}" alt="gcash logo">
                </div>

                <p class="mt-5 font-semibold uppercase text-md">send your payment here</p>

                <div class="size-64">
                    <img src="{{ asset('assets/images/qr.png') }}" alt="gcash qr code">
                </div>

                <h3 class="title-primary !text-xl !font-bold">RO***T C.</h3>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="showGcash" type="button">back</x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- maya modal -->
    <x-dialog-modal footerPosition="center" maxWidth="md" wire:model="showingMaya">
        <x-slot name="title">
            <div class="mx-auto">
                <div class="flex items-end my-2 ">
                    <x-application-mark class="block" />
                    <x-brand-name class="ml-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col items-center">
                <div class="max-w-36">
                    <img src="{{ asset('assets/images/maya-logo.jpg') }}" alt="maya logo">
                </div>

                <p class="mt-5 font-semibold uppercase text-md">send your payment here</p>

                <div class="size-64">
                    <img src="{{ asset('assets/images/qr.png') }}" alt="maya qr code">
                </div>

                <h3 class="title-primary !text-xl !font-bold">RO***T C.</h3>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="showMaya" type="button">back</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
