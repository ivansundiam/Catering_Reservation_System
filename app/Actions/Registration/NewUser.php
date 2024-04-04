<?php

namespace App\Actions\Registration;

use Illuminate\Http\Request;
use App\Actions\Fortify\PasswordValidationRules;
use App\Actions\Uploads\StoreImage;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;

class NewUser
{
    use PasswordValidationRules;

    public function execute(Request $request, StoreImage $storeImage): User
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'id_type' => ['required', 'string'],
            'id_verify_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $idVerifyPhotoPath = $storeImage->execute($request, 'id_verify_img', 'ids');

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'address' => $input['address'],
            'id_type' => $input['id_type'],
            'id_verify_img' => $idVerifyPhotoPath,
            'phone_number' => $input['phone_number'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
