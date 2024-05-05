<?php

namespace App\Livewire\Reservation;

use Livewire\Component;

class AttachmentModal extends Component
{
    public $showingModal = false;
    public $showingNoticeModal = false;
    public $reservation;
    public $lastReceipt;

    public function mount($reservation)
    {
        $receiptsArray = explode(',', $reservation->receipt_img);
        
        // Get the last uploaded receipt image path
        $this->lastReceipt = end($receiptsArray);
        $this->reservation = $reservation;
        
    }

    public function showModal()
    {
        $this->showingModal = !$this->showingModal;
    }

    public function showNoticeModal()
    {
        $this->showingNoticeModal = !$this->showingNoticeModal;
    }
    public function render()
    {
        return view('livewire.reservation.attachment-modal');
    }
}
