<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagePermission extends Component
{
    public function render()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('livewire.manage-permission', [
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }
}
