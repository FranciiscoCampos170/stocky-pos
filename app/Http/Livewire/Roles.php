<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $name;
    protected $listeners = ['updateTable' => 'render'];
    protected  $rules = [
        'name' => 'required|unique:roles'
    ];
    public function submitRole()
    {
        try {
            $this->validate();
            $role = new Role();
            $role->name = $this->name;
            $role->save();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Cargo adicionado com sucesso!'
            ]);
            $this->emit('updateTable');

        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.roles', ['roles' => Role::all()]);
    }
}
