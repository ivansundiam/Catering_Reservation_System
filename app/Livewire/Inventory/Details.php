<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use Livewire\WithFileUploads;

class Details extends Component
{
    use WithFileUploads;

    public $item;
    public $image;
    public $editing = false;
    public $isDisabled = true;

    public function render()
    {
        return view('livewire.inventory.details');
    }

    public function mount($item) {
        $this->item = $item;
    }

    public function showEdit() {
        $this->editing = !$this->editing;
        $this->isDisabled = !$this->isDisabled;
        
    }

    public function removeImg() {
        $this->image = null;
    }
}
