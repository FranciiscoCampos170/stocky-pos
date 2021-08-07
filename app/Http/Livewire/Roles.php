<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $name, $action;
    public $selectedRoles = [];
    protected $listeners = ['updateTable' => 'render',
                            'deleteItens' => 'deleteSelected'];
    public $confirming;
    protected  $rules = [
        'name' => 'required|unique:roles'
    ];
    public function mount()
    {
        $this->selectedRoles = collect();
    }
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

    public function confirmSingRoleDelete($id): void
    {
        $this->confirming = $id;
    }

    public function deleteSingleRole($id): void
    {
        Role::where('id', $id)->delete();
        $this->emit('updateTable');
    }

    public function confirmDeleteModal(): void
    {
        if ($this->action === "1" && count($this->selectedRoles) > 0)
        {
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'message' => 'Você tem a certeza?',
                'text' => 'Se apagar, essa ação não é reversível'
            ]);
        }
    }
    public function deleteSelected()
    {
        Role::query()
            ->whereIn('id', $this->selectedRoles)
            ->delete();
        $this->selectedRoles = [];
        $this->emit('updateTable');
    }

    public function refreshTable()
    {
        $this->emit('updateTable');
    }
    public function render()
    {
        return view('livewire.roles', ['roles' => Role::all()]);
    }
}
