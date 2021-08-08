<?php

namespace App\Http\Livewire;

use App\Exports\RolesExport;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Maatwebsite\Excel\Excel;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
class Roles extends Component
{
    use WithPagination;
    public $name, $action, $search, $role, $roleId;
    public $selectedRoles = [];
    protected $listeners = ['updateTable' => 'render',
                            'deleteItens' => 'deleteSelected'];
    protected $queryString = ['search'];
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
            $this->name = "";
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

    public function edit($id): void
    {
        $role = Role::where('id', $id)->first();
        $this->role = $role->name;
        $this->roleId = $role->id;
    }

    public function update($id): void
    {
        try {

            $role = Role::where('id', $id)->first();
            $role->name = $this->role;
            $role->save();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Cargo editado com sucesso!'
            ]);
            $this->role = "";
            $this->emit('updateTable');

        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new RolesExport, 'roles.xlsx');
    }
    public function render()
    {
        return view('livewire.roles', ['roles' => Role::where(function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
        })->paginate(10)]);
    }
}
