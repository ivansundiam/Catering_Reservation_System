<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class AddItemForm extends Component
{

    public $showingForm = false;
    public $name;
    public $description;
    
    public function render()
    {
        return view('livewire.inventory.add-item-form');
    }

    public function showForm()
    {
        $this->showingForm = true;
    }

    public function closeModal()
    {
        $this->showingForm = false;
    }

}
