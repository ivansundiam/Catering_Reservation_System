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
        $packageFilter = $request->input('package');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date');
    
        // Initialize the query to fetch all reservations
        $query = Reservation::query()->with(['user', 'package']);
    
        // Apply search filter
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
            });
        }
    
        // Apply package filter if selected
        if ($packageFilter !== 'all') {
            $query->where('package_id', $packageFilter);
        }
    
        // Apply status filter if selected
        if ($statusFilter === '1') {
            $query->where('payment_percent', '<', 100);
        } elseif ($statusFilter === '2') {
            $query->where('payment_percent', 100);
        }
        
        // Apply date filter if selected
        if ($dateFilter) {
            $currentDate = now();

            switch ($dateFilter) {
                case 'week':
                    // Filter reservations for the current week
                    $query->whereBetween('date', [
                        $currentDate->startOfWeek()->format('Y-m-d'),
                        $currentDate->endOfWeek()->format('Y-m-d'),
                    ]);
                    break;
                case 'month':
                    // Filter reservations for the current month
                    $query->whereYear('date', $currentDate->year)
                        ->whereMonth('date', $currentDate->month);
                    break;
                case 'year':
                    // Filter reservations for the current year
                    $query->whereYear('date', $currentDate->year);
                    break;
                default:
                    // No date filter
                    break;
            }
        }
    
        // Load paginated reservations
        $reservations = $query->paginate(10);
    
        // If no filters or search terms are provided, load all reservations
        if (!$search && !$packageFilter && !$statusFilter && !$dateFilter) {
            $reservations = Reservation::with(['user', 'package'])->paginate(10);
        }
        return view('admin.reservations', [
            'reservations' => $reservations,
            'packages' => Package::all(),
        ]);
    }
    
    


    public function showReservation($id) : View
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reserve-details', compact('reservation'));
    }
}
