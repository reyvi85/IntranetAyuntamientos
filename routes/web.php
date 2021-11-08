<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Livewire\ComunidadesProvinciasComponent,
    App\Http\Livewire\Instancias\InstanciasComponent,
    App\Http\Livewire\Usuarios\UsuariosComponent,
    App\Http\Livewire\CategoryBusinessComponent,
    App\Http\Livewire\Business\BusinessComponent,
    App\Http\Livewire\Business\ShowPublicBusiness,
    App\Http\Livewire\InterestPhonesComponent,
    App\Http\Livewire\Notifications\CategoryNotificationComponent,
    App\Http\Livewire\Notifications\NotificationComponent;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', UploadImg::class);


Route::prefix('dashboard')->middleware(['auth', 'checkRol:Super-Administrador'])->group(function(){
    Route::get('/comunidades-provincias', ComunidadesProvinciasComponent::class)->name('comunidades.provincias');
    Route::get('/instancias', InstanciasComponent::class)->name('instancias');
    Route::get('/usuarios', UsuariosComponent::class)->name('usuarios');
    Route::get('/categorias-negocios', CategoryBusinessComponent::class)->name('category-business');
    Route::get('/comercios', BusinessComponent::class)->name('business.index');
    Route::get('/telefonos', InterestPhonesComponent::class)->name('phones.index');
    //Route::get('/categorias-notificaciones', CategoryNotificationComponent::class)->name('category.notifications');
    //Route::get('/notificaciones', NotificationComponent::class)->name('notifications.index');

    Route::get('/notificaciones', function(){
        return view('livewire.administrator.notification-component');
    })->name('notifications.index');

    Route::get('cmd/{comando}', function($comando){
            Artisan::call($comando);
            dd(Artisan::output());
    });
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
        Route::get('/comercios', BusinessComponent::class)->name('gestion.business');
        Route::get('/telefonos', InterestPhonesComponent::class)->name('gestion.phones');
        //Route::get('/notificaciones', NotificationComponent::class)->name('gestion.notifications');

        Route::get('/notificaciones', function(){
            return view('livewire.administrator.notification-component');
        })->name('gestion.notifications');
    });

});






/** Componentes **/
Route::prefix('component')->middleware('checkInstance')->group(function (){
      Route::get('/business', ShowPublicBusiness::class)->name('business.show');

});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
