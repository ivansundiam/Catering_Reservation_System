<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LoginModal extends Component
{
    public $showingLoginModal = false;
    public $buttonName;
    public $classes;

    public function render()
    {
        return view('livewire.auth.login-modal');
    }

    public function mount($buttonName)
    {
        $this->buttonName = $buttonName;
    }

    public function showModal()
    {
        $this->showingLoginModal = true;
    }
}
