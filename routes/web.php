<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController,
    App\Http\Controllers\DashboardController;
use App\Http\Livewire\ComunidadesProvinciasComponent,
    App\Http\Livewire\Instancias\InstanciasComponent,
    App\Http\Livewire\Usuarios\UsuariosComponent,
    App\Http\Livewire\Business\ShowPublicBusiness,
    App\Http\Livewire\InterestPhonesComponent,
    App\Http\Livewire\Noticias\NoticiasComponent,
    App\Http\Livewire\Widget\WidgetsComponent,
    \App\Http\Livewire\Ampa\Ampacomponent,
    App\Http\Livewire\Ampa\AmpaFrontComponent;
use \Illuminate\Support\Facades\Artisan;
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

Route::domain('ampamatutesocios.zitty.es')->group(function(){
    Route::get('/', AmpaFrontComponent::class)->name('ampa.index');
});

Route::get('/', function () {
    return view('auth.login');
});
/**
 * GESTIÓN DE MODULOS
 **/

Route::prefix('gestion')->middleware('auth')->group(function (){
    Route::get('/usuarios', UsuariosComponent::class)->middleware(['checkRol:Administrador-Instancia,Super-Administrador'])->name('usuario.gestor');
    /**
     * GESTORES DE INSTANCIAS
     */
    Route::middleware(['CheckPermissionModules','checkRol:Super-Administrador,Administrador-Instancia,Gestor-Instancia'])->group(function(){
        Route::get('/comunidades-provincias', ComunidadesProvinciasComponent::class)->name('comunidades.provincias');
        Route::get('/instancias', InstanciasComponent::class)->name('instancias');
        Route::get('/usuarios', UsuariosComponent::class)->name('usuarios');
        Route::get('/telefonos', InterestPhonesComponent::class)->name('gestion.phones');
        Route::get('/noticias', NoticiasComponent::class)->name('gestion.noticias');
        Route::get('/widgets', WidgetsComponent::class)->name('gestion.widgets');
        Route::get('/ampa', Ampacomponent::class)->name('ampa.gestion');


        Route::prefix('comercios')->group(function (){
            Route::get('/', function(){
                return view('livewire.administrator.business.index');
            })->name('gestion.business');

        });



        Route::get('/notificaciones', function(){
            return view('livewire.administrator.notification-component');
        })->name('gestion.notifications');

        Route::get('/localizaciones', function(){
            return view('livewire.administrator.locations.index');
        })->name('gestion.localizaciones');

        Route::get('/avisos', function(){
            return view('livewire.administrator.avisos.index');
        })->name('gestion.avisos');

        Route::get('/events', function(){
            return view('livewire.administrator.events.index');
        })->name('gestion.events');

        Route::get('/routes', function(){
            return view('livewire.administrator.routes.index');
        })->name('gestion.routes');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });

});

Route::get('cmd/{comando}', function($comando){
    Artisan::call($comando);
    dd(Artisan::output());
})->middleware('checkRol:Super-Administrador');

/** Componentes **/
Route::prefix('component')->group(function (){
      Route::get('/business', ShowPublicBusiness::class)->middleware('checkInstance')->name('business.show');
    //Route::get('/ampa', AmpaFrontComponent::class)->name('ampa.index');
});



Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
