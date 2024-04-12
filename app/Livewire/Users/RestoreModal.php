<?php

namespace App\Livewire\Users;

use Livewire\Component;

class RestoreModal extends Component
{
    public $user;
    public $showing = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function show()
    {
        return $this->showing = !$this->showing;
    }
    
    public function render()
    {
        return view('livewire.users.restore-modal');
    }
}
