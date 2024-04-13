<?php

namespace App\Livewire\Reservation;

use Livewire\Component;

class AttachmentModal extends Component
{
    public $showingModal = false;
    public $reservation;

    public function mount($reservation)
    {
        $this->reservation = $reservation;
    }

    public function showModal()
    {
        $this->showingModal = !$this->showingModal;
    }
    public function render()
    {
        return view('livewire.reservation.attachment-modal');
    }
}
