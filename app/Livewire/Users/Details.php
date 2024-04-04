<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class Details extends Component
{
    public $user;
    public $image;
    public $showingModal = false;
    
    public function render()
    {

        return view('livewire.users.details');
    }

    public function showModal()
    {
        $this->showingModal = !$this->showingModal;
    }


}
