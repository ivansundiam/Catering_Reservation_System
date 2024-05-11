<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use Illuminate\Contracts\View\View;
use App\Actions\Uploads\StoreImage;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userReservations = Reservation::where('user_id', auth()->user()->id)->paginate(6);

        return view('clients.reserve-index')->with('reservations', $userReservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View{
        return view('clients.add-reserve', [
            'packages' => Package::all(),
            'inventoryItems' => Inventory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(ReservationRequest $request, ReservationService $reservationService, StoreImage $storeImage)
    {
        try {
            $reservationService->createReservation($request, $storeImage);

            return redirect()->route('reservation.index')->with('success', "Reservation added successfully");
        } catch (ModelNotFoundException $e) {
            Log::error('An error occurred while creating a reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while creating a reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while creating a reservation.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('package', 'menu')->findOrFail($id);
        $payment_percentages = [20, 60, 90, 100];
        $balance = $reservation->total_cost - $reservation->amount_paid;
        $reservationDate = Carbon::parse($reservation->date);
        $dateReserved = Carbon::parse($reservation->created_at);
        $today = Carbon::now();

        // Calculate the difference in days between the date resreved and the reservation date
        $daysDifference = $dateReserved->diffInDays($reservationDate);
        if($daysDifference > 30){
            $nextPaymentDate = $reservationDate->copy()->subMonth();
            $secondPaymentDate = $reservationDate->copy()->subWeek();
            // dd("gt 30:" . $nextPaymentDate);
        }
        else {
            $nextPaymentDate = $dateReserved->copy()->addDays($daysDifference / 2.6);
            $secondPaymentDate = $dateReserved->copy()->addDays($daysDifference / 1.2);

            // dd("lt:" . $nextPaymentDate);
            // dd("lt:" . $daysDifference);
        }
        
        return view('clients.reserve-details', compact('reservation', 'payment_percentages','balance', 'nextPaymentDate', 'secondPaymentDate'));
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
        try{
            $reservationService->updateReservation($request, $storeImage, $id);
    
            return redirect()->route('reservation.index')->with('success', "Updated payment on reservation successfully");
        }
        catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while updating the reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while updating the reservation.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( ReservationService $reservationService, $id)
    {
        try{
            $reservationService->deleteReservation($id);
    
            return redirect()->route('reservation.index')->with('success', "Reservation deleted successfully");
        }
        catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while deleting the reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while deleting the reservation.');
        }
    }

    public function updateNotice(Request $request, ReservationService $reservationService, StoreImage $storeImage, string $id)
    {
        try{
            $reservationService->updatePaymentNotice($request, $storeImage, $id);
    
            return redirect()->route('reservation.index')->with('success', "Updated payment on reservation successfully");
        }
        catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while updating payment notice the reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while updating payment notice the reservation.');
        }
    }

}
