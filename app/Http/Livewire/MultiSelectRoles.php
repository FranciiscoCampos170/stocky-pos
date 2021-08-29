<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class MultiSelectRoles extends Component
{
    public function render()
    {
        return view('livewire.multi-select-roles', ['roles' => Role::all()]);
    }
}
