<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Package;
use App\Models\Menu;
class AdminController extends Controller
{
    public function reservations(Request $request) : View
    {
        $search = $request->input('search');

        $reservations = Reservation::where(function ($query) use ($search) {
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhereHas('package', function ($packageQuery) use ($search) {
                $packageQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhere(function ($paymentQuery) use ($search) {
                $paymentQuery->where('payment_percent', 'like', "%{$search}%")
                             ->orWhere(function ($innerPaymentQuery) use ($search) {
                                 // Check if search term matches "pending payment" or "complete payment"
                                 if ($search === 'pending') {
                                     $innerPaymentQuery->where('payment_percent', '<', 100);
                                 } elseif ($search === 'complete') {
                                     $innerPaymentQuery->where('payment_percent', 100);
                                 }
                             });
            });
        })
            ->with(['user', 'package'])
            ->withTrashed()
            ->paginate(10);
        return view('admin.reservations', compact('reservations'));
    }

    public function showReservation($id) : View
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reserve-details', compact('reservation'));
    }
}
