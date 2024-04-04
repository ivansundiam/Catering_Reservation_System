<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class RegisterModal extends Component
{
    public $showingRegForm = false;

    public function render()
    {
        return view('livewire.auth.register-modal');
    }

    public function showModal()
    {
        $this->showingRegForm = true;
    }
}
