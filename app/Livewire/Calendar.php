<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\Event;
use App\Models\Reservation;

class Calendar extends Component
{
    public $selectedDate;
    public $month;
    public $year;

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;

    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function setReservationDate($date){
        $this->selectedDate = date('Y-m-d', strtotime($date));
    }

    public function render()
    {
        $calendar = [];
        $firstDayOfMonth = Carbon::create($this->year, $this->month, 1);
        $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
        $reservedDates = collect(Reservation::pluck('date'));
        
        // Adjusting the starting position of the first day of the month
        $currentDate = $firstDayOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        while ($currentDate->lte($lastDayOfMonth)) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = [
                    'day' => $currentDate->format('j'),
                    'date' => $currentDate->format('Y-m-d'),
                    'isCurrentMonth' => $currentDate->month == $this->month,
                    'isReserved' => $reservedDates->contains($currentDate),
                    'isPastDay' => $currentDate->lt(today())
                ];
                $currentDate->addDay();
            }
            $calendar[] = $week;
        }

        // dd($calendar);
    
        return view('livewire.calendar', [
            'calendar' => $calendar,
            'selectedDate' => $this->selectedDate,
        ]);
    }
    
    
}
