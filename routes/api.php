<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvisosController;
use App\Http\Controllers\Api\PostController;
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


Route::prefix('v1')->middleware(['auth:sanctum', 'checkRol:Super-Administrador,Administrador-Instancia,Gestor-Instancia'])->group(function (){
    Route::get('post/', [PostController::class, 'index'])->name('api.post.index');
    Route::get('post/{id}', [PostController::class, 'show'])->name('api.post.show');
    /**
     * AVISOS
    **/
    Route::prefix('avisos')->group(function (){
        Route::get('/', [AvisosController::class, 'index'])->name('api.warning.index');
        Route::get('/show/{warning}', [AvisosController::class, 'show'])->name('api.warning.show');
        Route::get('/{id}/relationships/answer', [AvisosController::class, 'answerIndex'])->name('api.answer.index');
        Route::get('/answer/{warningAnswer}', [AvisosController::class, 'answerShow'])->name('api.answer.show');
        Route::get('/categories', [AvisosController::class, 'categoryIndex'])->name('api.category.index');
        Route::get('/categories/{warningCategory}', [AvisosController::class, 'categoryShow'])->name('api.category.show');
        Route::get('/categories/{warningCategory}/subcategories', [AvisosController::class, 'subCategoryIndex'])->name('api.subcategory.index');
        Route::get('/categories/subcategories/{warningSubCategory}', [AvisosController::class, 'subCategoryShow'])->name('api.subcategory.show');

    });


});
