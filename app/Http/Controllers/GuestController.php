<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        // dd('adsf');
        if(auth()->check()){
            $userType = auth()->user()->user_type;
            return $userType == "admin" 
                 ? redirect()->route('admin-dashboard')
                 : view('clients.index');

        }
        return view('clients.index');
    }
}
