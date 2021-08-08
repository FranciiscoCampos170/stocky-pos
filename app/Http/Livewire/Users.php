<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use PasswordValidationRules;
    public $name, $email, $password, $role_id, $active, $password_confirmation;
    public $selectedRoles = [];
    public $action;
    protected $listeners = ['updateTable' => 'render',
        'deleteItens' => 'deleteSelected'];
    protected  $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed',
        'active' => 'required',
        'role_id' => 'required',
        'password_confirmation' => 'required'
    ];

    public function mount()
    {
        $this->selectedRoles = collect();
    }
    public function createUser()
    {
        $this->validate();
        try {

        //dd($this->active);
            DB::transaction(function () {
           $user = \App\Models\User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'active' => $this->active
            ]);
            $role = Role::where('id', $this->role_id)->first();
                $user->assignRole($role->name);
            });
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Utilizador adicionado com sucesso!'
            ]);
            $this->clearFields();
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.users', ['users' => \App\Models\User::get(), 'roles' => Role::all()]);
    }

    public function clearFields(): void
    {
        $this->name = "";
        $this->role_id = "";
        $this->password = "";
        $this->email = "";
        $this->active = "";
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
        dd("hre");
        \App\Models\User::query()
            ->whereIn('id', $this->selectedRoles)
            ->delete();
        $this->selectedRoles = [];
        $this->emit('updateTable');
    }
}
