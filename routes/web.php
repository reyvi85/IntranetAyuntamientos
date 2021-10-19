<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Livewire\ComunidadesProvinciasComponent,
    App\Http\Livewire\Instancias\InstanciasComponent,
    App\Http\Livewire\Usuarios\UsuariosComponent,
    App\Http\Livewire\CategoryBusinessComponent,
    App\Http\Livewire\Business\BusinessComponent;
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

//Route::get('/', UploadImg::class);


Route::prefix('dashboard')->middleware(['auth'])->group(function(){
    Route::get('/comunidades-provincias', ComunidadesProvinciasComponent::class)->name('comunidades.provincias');
    Route::get('/instancias', InstanciasComponent::class)->name('instancias');
    Route::get('/usuarios', UsuariosComponent::class)->name('usuarios');
    Route::get('/categorias-negocios', CategoryBusinessComponent::class)->name('category-business');
    Route::get('/comercios', BusinessComponent::class)->name('business.index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
