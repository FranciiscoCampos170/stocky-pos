<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return view('exports.roles', ['roles' => \Spatie\Permission\Models\Role::all()]);
    }
    public function view(): View
    {
        return view('exports.users', ['users' => User::all()]);
    }
}
