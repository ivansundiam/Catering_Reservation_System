<x-app-layout> 
    <x-slot name="header">
        {{ __('Add reservation') }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden bg-white shadow-xl md:p-10 dark:bg-gray-800 sm:rounded-lg">

                <form action="{{ route('reservation.store') }}" 
                    method="post" 
                    enctype="multipart/form-data">
                @csrf
                    <x-label class="!text-lg">
                        Select a package
                        <x-input-error for="package" />
                    </x-label>
                    <ul class="grid w-full gap-6 md:grid-cols-3">
                        <li>
                            <input type="radio" id="package-1" name="package" value="1" class="hidden peer" />
                            <label for="package-1" class="package-card">                           
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 1</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="package-2" name="package" value="2" class="hidden peer">
                            <label for="package-2" class="package-card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 2</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="package-3" name="package" value="3" class="hidden peer">
                            <label for="package-3" class="package-card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Package 3</div>
                                    <p class="w-full">Lorem ipsum dolor sit amet.</p>
                                </div>
                            </label>
                        </li>
                    </ul>

                    <div class="grid w-full grid-cols-1 mx-auto mt-5 md:grid-cols-2 gap-x-4 lg:w-1/2">
                        <div class="mt-5">
                            <x-label for="address" required>Address:</x-label>
                            <textarea name="address" class="w-full border-gray-300 rounded-lg focus:border-primary focus:ring-primary-hover" id="">{{ old('address') }}</textarea>
                            <x-input-error for="address" />
                        </div>

                        <div class="mt-5">
                            <x-label for="theme" required>Theme:</x-label>
                            <x-input type="text" name="theme" class="w-full" id="" :value="old('theme')" />
                            <x-input-error for="theme" />
                        </div>
                        
                        <div class="mt-5">
                            <x-label for="occasion" required>Occasion:</x-label>
                            <select name="occasion" class="w-full border-gray-300 rounded-lg focus:border-primary focus:ring-primary-hover" id="">
                                <option selected disabled>{{ __('Select Occasion') }}</option>
                                <option value="Wedding">{{ __('Wedding') }}</option>
                                <option value="Debut">{{ __('Debut') }}</option>
                                <option value="Dinner">{{ __('Dinner') }}</option>
                                <option value="Lunch">{{ __('Lunch') }}</option>
                                <option value="Kiddie">{{ __('Kiddie') }}</option>
                            </select>
                            <x-input-error for="occasion" />
                        </div>

                        <div class="mt-5">
                            <x-label for="time" required>Time:</x-label>
                            <x-input type="time" name="time" class="w-full" id="" :value="old('time')" />
                            <x-input-error for="time" />
                        </div>
                    </div>

                    <div class="w-full mx-auto mt-5 lg:w-2/3">
                        <x-label for="date" required>
                            Choose date:
                        </x-label>
                        @livewire('calendar')
                        <x-input-error for="date" />
                    </div>

                    {{-- <div class="flex flex-col w-full mx-auto mt-5 md:w-1/2">

                        <x-label for="id-verify-img" required>Id Verification Photo:</x-label>
                        <x-dropbox id="id-verify-img" label="Click to upload" name="id-verify-img"/>
                        <x-input-error for="id-verify-img" />
                    </div> --}}

                    <div class="flex flex-col w-full mx-auto my-5 md:w-1/2">

                        <x-label for="receipt-img" required>Receipt Photo:</x-label>
                        <x-dropbox id="receipt-img" label="Click to upload" name="receipt-img"/>
                        <x-input-error for="receipt-img" />
                    </div>

                    <div class="flex w-full">
                        <button type="submit" class="self-center mx-auto btn-primary">Reserve</button>
                    </div>

                    
            
  
                </form>
            </div>
        </div>
    </div>
</x-app-layout>