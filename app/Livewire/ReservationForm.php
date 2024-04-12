<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class ReservationForm extends Component
{
    public $date;
    public $time;

    protected $listeners = [
        'dateSelected' => 'setDate',
        'timeSelected' => 'setTime',
    ];

    public function setDate($date)
    {
        $this->date = Carbon::parse($date)->format('F j, Y');
    }

    public function setTime($event)
    {
        $this->time = $event['time'];
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
