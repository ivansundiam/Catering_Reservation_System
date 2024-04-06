<?php

namespace App\Livewire;

use Livewire\Component;

class TimePicker extends Component
{

    public $hours = [];
    public $minutes = [];
    public $periods = ['AM', 'PM'];
    public $selectedHour;
    public $selectedMinute;
    public $selectedPeriod;
    public $selectedTime;

    public function mount()
    {
        // Initialize hours, minutes, and periods
        $this->hours = range(1, 12);
        $this->minutes = range(0, 59);

        // Initialize selected values to current time
        $currentTime = now();
        // $this->selectedHour = str_pad($currentTime->format('h'), 2, '0', STR_PAD_LEFT);
        // $this->selectedMinute = str_pad($currentTime->format('i'), 2, '0', STR_PAD_LEFT);
        $this->selectedHour = $currentTime->format('g');
        $this->selectedMinute = ltrim($currentTime->format('i'), '0');
        $this->selectedPeriod = $currentTime->format('A');
        
        $this->updateSelectedTime();
    }

    public function selectHour($hour)
    {
        $this->selectedHour = $hour;
        $this->updateSelectedTime();
    }

    public function selectMinute($minute)
    {
        $this->selectedMinute = $minute;
        $this->updateSelectedTime();
    }

    public function selectPeriod($period)
    {
        $this->selectedPeriod = $period;
        $this->updateSelectedTime();
    }

    protected function updateSelectedTime()
    {
        $this->selectedTime = sprintf('%02d:%02d %s', $this->selectedHour, $this->selectedMinute, $this->selectedPeriod);
    }

    public function render()
    {
        return view('livewire.time-picker', [
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'periods' => $this->periods,
        ]);
    }
}
