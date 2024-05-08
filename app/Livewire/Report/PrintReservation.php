<?php

namespace App\Livewire\Report;

use App\Models\Package;
use App\Models\Reservation;
use Livewire\Component;
use carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PrintReservation extends Component
{
    public $showing = false;
    public $reservations;
    public $selectedPackage = 'all';
    public $selectedDate = 'monthly';
    public $selectedMonth;
    public $selectedYear;
    public $noReservations = false;

    public function show()
    {
        $this->showing = !$this->showing;
    }

    public function mount()
    {
        $this->selectedMonth = date('n');
        $this->selectedYear = date('Y');    
    }


    public function render()
    {
        $query = Reservation::with(['package', 'menu']);        

        // Apply package filter if selected
        if ($this->selectedPackage !== 'all') {
            $query->where('package_id', $this->selectedPackage);
        }

        // Apply date filter if selected
        if ($this->selectedDate) {
            $currentDate = now();
            switch ($this->selectedDate) {
                case 'weekly':
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

        // Apply month filter if selected
        if ($this->selectedMonth && $this->selectedDate == "monthly") {
            $query->whereMonth('date', $this->selectedMonth);
        }

        // Apply year filter if selected
        if ($this->selectedYear) {
            $query->whereYear('date', $this->selectedYear);
        }

        $this->reservations = $query->get();
        $packages = Package::all();
        $totalEarnings = (float) $this->reservations->sum('total_cost');


        // Retrieve the most chosen package and its count for the selected month
        $mostChosenPackageMonth = Reservation::selectRaw('package_id, count(*) as package_count')
            ->whereMonth('date', $this->selectedMonth)
            ->whereYear('date', $this->selectedYear)
            ->groupBy('package_id')
            ->orderByDesc('package_count')
            ->first();

        // Retrieve the most chosen package and its count for the selected year
        $mostChosenPackageYear = Reservation::selectRaw('package_id, count(*) as package_count')
            ->whereYear('date', $this->selectedYear)
            ->groupBy('package_id')
            ->orderByDesc('package_count')
            ->first();
        
        // Get the month with the most reservations
        $mostReservedMonth = Reservation::selectRaw('YEAR(date) year, MONTH(date) month, count(*) as reservation_count')
            ->groupBy('year', 'month')
            ->orderByDesc('reservation_count')
            ->first();

    
        // Get the count of reservations
        $reservationsCount = $query->count();

        // Get the minimum and maximum dates from the reservations
        $minDate = $this->reservations->min('date');
        $maxDate = $this->reservations->max('date');
        $minYear = Carbon::parse($minDate)->format('Y');
        $maxYear = Carbon::parse($maxDate)->format('Y');

        // Create an array of years from the minimum to maximum year
        $years = range($minYear, $maxYear);

        // disables submit button if there is no reservations
        $reservationsCount < 1 
            ? $this->noReservations = true
            : $this->noReservations = false;

        

        // to be passed in the pdf
        $reportDetails = [
            'reservations' => $this->reservations,
            'date' => $this->selectedDate,
            'month' => $this->selectedMonth,
            'year' => $this->selectedYear,
            'mostChosenPackageMonth' => $mostChosenPackageMonth,
            'mostChosenPackageYear' => $mostChosenPackageYear,
            'mostReservedMonth' => $mostReservedMonth,
            'reservationsCount' => $reservationsCount,
            'totalEarnings' => $totalEarnings,
        ];

        return view('livewire.report.print-reservation', [
            'reservations' => $this->reservations,
            'packages' => $packages,
            'years' => $years,
            'mostChosenPackageMonth' => $mostChosenPackageMonth,
            'mostChosenPackageYear' => $mostChosenPackageYear,
            'mostReservedMonth' => $mostReservedMonth,
            'reservationsCount' => $reservationsCount,
            'reservationsCount' => $reservationsCount,
            'totalEarnings' => $totalEarnings,
            'reportDetails' => $reportDetails,
        ]);
    }
}
