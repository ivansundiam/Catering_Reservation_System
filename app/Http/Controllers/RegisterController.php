<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Uploads\StoreImage;
use App\Actions\Registration\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function create(Request $request, NewUser $newUser, StoreImage $storeImage)
    {
       try {
            $user = $newUser->execute($request, $storeImage);

            Auth::login($user);

            return redirect('dashboard');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ', $e->validator->errors()->all());
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while creating an account: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while creating an account.');
        }
    }
}
