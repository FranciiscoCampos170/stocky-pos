<?php

namespace App\Http\Livewire;

use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return view('livewire.user', ['users' => \App\Models\User::get()]);
    }
}
