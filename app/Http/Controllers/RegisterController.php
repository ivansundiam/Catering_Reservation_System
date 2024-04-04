<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Uploads\StoreImage;
use App\Actions\Registration\NewUser;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(Request $request, NewUser $newUser, StoreImage $storeImage)
    {
        $user = $newUser->execute($request, $storeImage);

        Auth::login($user);

        return redirect('dashboard');
    }
}
