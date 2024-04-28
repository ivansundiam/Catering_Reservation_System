<?php

namespace App\Livewire\Reservation;

use Livewire\Component;

class PaymentDisplayModal extends Component
{
    public $showingGcash = false;
    public $showingMaya = false;

    public function showGcash()
    {
        $this->showingGcash = !$this->showingGcash;
        $this->showingMaya = false;
    }
    
    public function showMaya()
    {
        $this->showingMaya = !$this->showingMaya;
        $this->showingGcash = false;
    }

    public function render()
    {
        return view('livewire.reservation.payment-display-modal');
    }
}
