<x-guest-layout>
    <x-authentication-card maxWidth="5xl">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" 
            action="{{ route('register') }}" 
            enctype="multipart/form-data"
            x-data="{ buttonDisabled: false }"
            x-on:submit="buttonDisabled = true">
            @csrf

            <div class="flex items-center flex-col mb-5">
                <h2 class="forms-heading-text">Register Account</h2>
                <span class="text-sm md:text-base text-gray-500">for full access</span>
            </div>

            <div class="grid md:grid-cols-2 m-5">
                <div class="pr-0 md:pr-10 border-gray-400 md:border-r-2">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" placeholder="Lastname, Firstname, M.I." required autofocus autocomplete="name" />
                        <x-input-error for="name" />
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" placeholder="Enter Email" required autocomplete="username" />
                        <x-input-error for="email" />
                    </div>
        
                    <div class="mt-4">
                        <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                        <x-input id="phone_number" class="block w-full mt-1" type="number" pattern="/^-?\d+\.?\d*$/" placeholder="Enter Phone Number" min="0" onKeyPress="if(this.value.length==11) return false;" name="phone_number" :value="old('phone_number')" />
                        <x-input-error for="phone_number" />
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block w-full mt-1" type="password" name="password" placeholder="Enter Password" required autocomplete="new-password" />
                        <x-input-error for="password" />
                    </div>
        
                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block w-full mt-1" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
    
                <div class="pl-0 md:pl-10">
                    <div>
                        <x-label for="address" value="{{ __('Address') }}" />
                        <textarea id="address" class="block w-full mt-1 input-field"  placeholder="#, Street, Municipality, City" name="address" required>{{ old('address') }}</textarea>   
                        <x-input-error for="address" />
                    </div>
        
                    <div class="mt-4">
                        <x-label for="id_type" value="{{ __('Select ID Type') }}" />
                        <select id="id_type" class="block w-full mt-1 input-field" type="text" name="id_type" :value="old('id_type')" required>
                            <option value="" selected disabled>Id Type</option>
                            <option value="Voters ID">Voter's ID</option>
                            <option value="Passport">Passport</option>
                            <option value="Drivers License">Driver's License</option>
                            <option value="Postal ID">Postal ID</option>
                            <option value="SSS/GSIS">SSS/GSIS</option>
                            <option value="TIN Card">Tax Identification Number (TIN) Card</option>
                            <option value="Senior/PWD ID">Senior/PWD ID</option>
                            <option value="PRC">PRC</option>
                            <option value="NBI">NBI</option>
                            <option value="School ID">School ID</option>
                            <option value="Birth Certificate">Birth Certificate</option>
                            <option value="TMC Employee ID">TMC Employee ID</option>
                        </select>
                        <x-input-error for="id_type" />
                    </div>
        
                    <div class="flex flex-col w-full mx-auto mt-4">
                        <x-label for="id_verify_img" required>Id Verification Photo:</x-label>
                        <x-dropbox id="id_verify_img" label="Click to upload" name="id_verify_img"/>
                        <x-input-error for="id_verify_img" />
                    </div>
        
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
        
                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
        
                    <div class="flex items-center justify-end mt-4">
                        <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bg-primary dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
        
                        <x-button class="ms-4 min-w-24" x-bind:disabled="buttonDisabled">
                            <div role="status" x-show="buttonDisabled" class="w-full">
                                <svg class="mx-auto animate-spin" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#e2e8f0" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
                            </div>
                            <span class="mx-auto" x-show="!buttonDisabled">{{ __('Sign Up') }}</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
