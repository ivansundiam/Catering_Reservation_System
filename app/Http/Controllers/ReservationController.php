<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use Illuminate\Contracts\View\View;
use App\Actions\Uploads\StoreImage;
use App\Models\Menu;
use App\Models\Package;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userReservations = Reservation::where('user_id', auth()->user()->id)->get();

        return $userReservations->isEmpty() 
            ? redirect()->route('reservation.create') 
            : view('clients.reserve-index')
            ->with('reservations', $userReservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View{
        return view('clients.add-reserve', [
            'packages' => Package::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(ReservationRequest $request, ReservationService $reservationService, StoreImage $storeImage)
    {
        $reservationService->createReservation($request, $storeImage);

        return redirect()->route('reservation.index')->with('success', "Reservation added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('package', 'menu')->findOrFail($id);
        $payment_percentages = [20, 60, 90, 100];
        // $package = Package::findOrFail($reservation->package_id);
        // $menu = Menu::findOrFail($reservation->menu_id);

        return view('clients.reserve-details', compact('reservation', 'payment_percentages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReservationService $reservationService, StoreImage $storeImage, string $id)
    {
        /*
            In this case, I couldnt use ReservationRequest as the form request for updating
            the reservation because I only need to update two fields. Submitting the form in
            clients/reserve-details.blade.php adds the validation of all the fields, which
            makes submitting only two fields invalid. For some reason, adding the ReservationRequest
            in the parameter validates the form already and does not even let you in the update()
            function.
        */
        $reservationService->updateReservation($request, $storeImage, $id);

        return redirect()->route('reservation.index')->with('success', "Reservation added successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
