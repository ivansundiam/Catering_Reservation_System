<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        if(auth()->check()){
            $userType = auth()->user()->user_type;
            return $userType == "admin" 
                 ? redirect()->route('admin.reservations')
                 : view('clients.index');

        }
        return view('clients.index');
    }
}
