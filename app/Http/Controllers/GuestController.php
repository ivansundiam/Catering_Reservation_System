<?php

namespace App\Http\Controllers;

use App\Actions\Uploads\CleanUploads;

class GuestController extends Controller
{
    public function index(CleanUploads $cleanUploads){

        // adding CleanUploads in the most visited route 
        $cleanUploads->execute('reservation');
        $cleanUploads->execute('inventory');

        if(auth()->check()){
            $userType = auth()->user()->user_type;
            return $userType == "admin" 
                 ? redirect()->route('admin.reservations')
                 : view('clients.index');

        }
        return view('clients.index');
    }
}
