<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvisosController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\InterestPhoneController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\WidgetsController;
use App\Http\Controllers\Api\RoutesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/user',[AuthController::class, 'userInfo'])->middleware('auth:sanctum');


Route::prefix('v1')->middleware('checkInstance')->group(function (){
    /**
     * AVISOS
    **/
    Route::prefix('warnings')->group(function (){
        Route::get('/', [AvisosController::class, 'index'])->name('api.warning.index')->middleware('auth:sanctum');
        Route::post('/warningStore', [AvisosController::class, 'warningStore'])->name('api.warning.store')->middleware('auth:sanctum');
        Route::get('/show/{warning}', [AvisosController::class, 'show'])->name('api.warning.show');
        Route::get('/{id}/answer', [AvisosController::class, 'answerIndex'])->name('api.answer.index');
        Route::get('/answer/{warningAnswer}', [AvisosController::class, 'answerShow'])->name('api.answer.show');
        Route::get('/categories/uper/', [AvisosController::class, 'allSubCategories'])->name('api.subcategory.all');
        Route::get('/categories', [AvisosController::class, 'categoryIndex'])->name('api.category.index');
        Route::get('/categories/{warningCategory}', [AvisosController::class, 'categoryShow'])->name('api.category.show');
        Route::get('/categories/{warningCategory}/subcategories', [AvisosController::class, 'subCategoryIndex'])->name('api.subcategory.index');
        Route::get('/categories/subcategories/{warningSubCategory}', [AvisosController::class, 'subCategoryShow'])->name('api.subcategory.show');
        Route::get('/estados/', [AvisosController::class, 'stateIndex'])->name('api.state.index');
        Route::get('/estados/{warningState}', [AvisosController::class, 'stateShow'])->name('api.state.show');
    });
    /**
     * NEGOCIOS
    **/
    Route::prefix('business')->group(function(){
        Route::get('/', [BusinessController::class, 'index'])->name('api.bussiness.index');
        Route::get('/categories', [BusinessController::class, 'businessCategoryIndex'])->name('api.bussinessCategory.index');
        Route::get('/{busine}', [BusinessController::class, 'businessShow'])->name('api.bussiness.show');
        Route::get('/categories/{categoryBusine}', [BusinessController::class, 'businessCategoryShow'])->name('api.bussinessCategory.show');
    });
    /**
     * WIDGETS
     **/
    Route::prefix('widgets')->group(function (){
        Route::get('/', [WidgetsController::class, 'index'])->name('api.widgets.index');
        Route::get('/{widget}', [WidgetsController::class, 'show'])->name('api.widgets.show');
    });
    /**
     * NOTIFICACIONES
    **/
    Route::prefix('notifications')->group(function (){
        Route::get('/', [NotificationsController::class, 'index'])->name('api.notification.index');
        Route::get('/categories', [NotificationsController::class, 'notificationCategoryIndex'])->name('api.notificationCategory.index');
        Route::get('/{notification}', [NotificationsController::class, 'notificationShow'])->name('api.notification.show');
        Route::get('/categories/{categoryNotification}', [NotificationsController::class, 'notificationCategoryShow'])->name('api.notificationCategory.show');
    });
    /**
     * POST
     **/
    Route::prefix('posts')->group(function (){
        Route::get('/', [PostController::class, 'index'])->name('api.post.index');
        Route::get('/{id}', [PostController::class, 'show'])->name('api.post.show');
    });
    /**
     * TELEFONOS DE INTERES
    **/
    Route::prefix('phones')->group(function (){
        Route::get('/', [InterestPhoneController::class, 'index'])->name('api.phones.index');
        Route::get('/{interestPhone}', [InterestPhoneController::class, 'show'])->name('api.phones.show');
    });
    /**
     * LOCALIZACIONES
    **/
    Route::prefix('locations')->group(function (){
        Route::get('/', [LocationsController::class, 'index'])->name('api.location.index');
        Route::get('/categories', [LocationsController::class, 'locationCategoryIndex'])->name('api.locationCategory.index');
        Route::get('/{location}', [LocationsController::class, 'locationShow'])->name('api.location.show');
        Route::get('categories/{locationCategory}', [LocationsController::class, 'locationCategoryShow'])->name('api.locationCategory.show');
    });
    /**
     * E V E N T O S
    **/
    Route::prefix('events')->group(function (){
        Route::get('/',[EventsController::class, 'index'])->name('event.index');
        Route::get('categories',[EventsController::class, 'categories'])->name('event.category');
    });
    /**
     * R U T A S
    **/
    Route::prefix('routes')->group(function (){
        Route::get('/',[RoutesController::class, 'index'])->name('route.index');
        Route::get('categories',[RoutesController::class, 'categories'])->name('route.category');
        Route::get('reserves',[RoutesController::class, 'reserves'])->name('route.reserves');
        Route::post('reserves',[RoutesController::class, 'reserveStore'])->name('route.reserveStore')->middleware('auth:sanctum');;
    });
});
