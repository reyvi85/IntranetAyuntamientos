<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Livewire\ComunidadesProvinciasComponent,
    App\Http\Livewire\InstanciasComponent,
    App\Http\Livewire\UsuariosComponent;
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

/*Route::get('/', function () {
    return view('administrator.ComunidadesProvincias');
});*/

//Route::get('/', UploadImg::class);
Route::get('/', ComunidadesProvinciasComponent::class);
Route::get('/instancias', InstanciasComponent::class);
Route::get('/usuarios', UsuariosComponent::class);



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
