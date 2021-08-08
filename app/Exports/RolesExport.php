<?php

namespace App\Exports;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RolesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return \Spatie\Permission\Models\Role::all();
    }

    public function view(): View
    {
        return view('exports.roles', ['roles' => \Spatie\Permission\Models\Role::all()]);
    }
}
