<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Package;
use App\Models\Menu;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    public function reservations(Request $request) : View
    {
        $search = $request->input('search');
        $packageFilter = $request->input('package');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date');
    
        $query = Reservation::query()->with(['user', 'package']);
    
        if ($search) {
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
                        if ($search === 'pending') {
                            $innerPaymentQuery->where('payment_percent', '<', 100);
                        } elseif ($search === 'complete') {
                            $innerPaymentQuery->where('payment_percent', 100);
                        }
                    });
            })
            ->orWhere('transaction_number', $search);
        }
    
        if ($packageFilter !== 'all') {
            $query->where('package_id', $packageFilter);
        }
    
        if ($statusFilter === '1') {
            $query->where('payment_percent', '<', 100);
        } elseif ($statusFilter === '2') {
            $query->where('payment_percent', 90);
        } elseif ($statusFilter === '3') {
            $query->where('payment_percent', 100);
        } 
        
        if ($dateFilter) {
            $currentDate = now();

            switch ($dateFilter) {
                case 'week':
                    // Filter reservations from today to the next week
                    $nextWeek = $currentDate->copy()->addDays(7);
                    $query->whereBetween('date', [
                        $currentDate->startOfWeek()->format('Y-m-d'),
                        $nextWeek->format('Y-m-d'),
                    ]);
                    break;
                case 'month':
                    // Filter reservations from today to the next month
                    $nextMonth = $currentDate->copy()->addDays(30);
                    $query->whereBetween('date', [
                        $currentDate->format('Y-m-d'),
                        $nextMonth->format('Y-m-d'),
                    ]);
                    break;
                case 'year':
                    // Filter reservations for the current year
                    $query->whereYear('date', $currentDate->year);
                    break;
                default:
                    break;
            }
        }
    
        $reservations = $query
            ->latest()
            ->paginate(10);
    
        // If no filters or search terms are provided, load all reservations
        if (!$search && !$packageFilter && !$statusFilter && !$dateFilter) {
            $reservations = Reservation::with(['user', 'package'])
                ->latest()
                ->paginate(10);
        }
        return view('admin.reservations', [
            'reservations' => $reservations,
            'packages' => Package::all(),
        ]);
    }
    
    


    public function showReservation($id) : View
    {
        $reservation = Reservation::findOrFail($id);
        $balance = $reservation->total_cost - $reservation->amount_paid;

        return view('admin.reserve-details', compact('reservation', 'balance'));
    }

    public function destroy( ReservationService $reservationService, $id)
    {
        try{
            $reservationService->deleteReservation($id);
    
            return redirect()->route('admin.reservations')->with('success', "Reservation deleted successfully");
        }
        catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while deleting the reservation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while deleting the reservation.');
        }
    }
}
