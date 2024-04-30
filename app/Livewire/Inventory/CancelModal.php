<?php

namespace App\Livewire\Inventory;

use Livewire\Component;

class CancelModal extends Component
{
    public $showingCancelModal = false;
    public $item;


    public function showCancelModal()
    {
        $this->showingCancelModal = !$this->showingCancelModal;
    }

    public function mount($item){
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.inventory.cancel-modal');
    }
}
