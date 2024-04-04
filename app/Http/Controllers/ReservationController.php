<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use Illuminate\Contracts\View\View;
use App\Actions\Uploads\StoreImage;   
use App\Models\Reservation;

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
            : view('clients.reserve')
            ->with('reservations', $userReservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View{
        return view('clients.add-reserve');
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
        //
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
    public function update(ReservationRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
