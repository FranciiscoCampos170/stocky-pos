<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/roles', function(){
    return view('roles.index');
})->name('roles.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/manage-permissions', function(){
    return view('roles.manage-permissions');
})->name('roles.manage-permissions');

Route::post('/roles-store',function (\Illuminate\Http\Request $request){
    return $request;
})->name('roles.store');


Route::middleware(['auth:sanctum', 'verified'])->get('/users-list', function (){
    return view('users.index');
})->name('users.index');

Route::get('/store-permission', function ()
{
    /*$permission = \Spatie\Permission\Models\Permission::create(
        ['name' => 'Create Users']);*/
});
