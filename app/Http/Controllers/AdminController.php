<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard() : View{

        $reservations = Reservation::all();
        return view('admin.dashboard', compact('reservations'));
    }

}
