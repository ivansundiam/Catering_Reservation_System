<?php

namespace App\Livewire\Users;

use Livewire\Component;

class DeleteModal extends Component
{
    public $user;
    public $show = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.users.delete-modal');
    }
}
