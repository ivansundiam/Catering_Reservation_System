<?php

namespace App\Livewire\Reservation;

use Livewire\Component;

class CancelModal extends Component
{
    public $showingCancelModal = false;
    public $reservation;


    public function showCancelModal()
    {
        $this->showingCancelModal = !$this->showingCancelModal;
    }

    public function mount($reservation){
        $this->reservation = $reservation;
    }

    public function render()
    {
        return view('livewire.reservation.cancel-modal');
    }
}
