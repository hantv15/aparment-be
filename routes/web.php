<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServiceController;

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
    return view('layouts.app');
});
Route::prefix('user-manager')->group(function (){
    Route::get('/', [\App\Http\Controllers\UserController::class, 'getUser'])->name('index');
});
Route::prefix('service-manage')->group(function (){
    Route::get('/', [ServiceController::class, 'getService'])->name('service.index');
    Route::get('/add', [ServiceController::class, 'addForm'])->name('add');
    Route::post('/add', [ServiceController::class, 'saveAdd']);
    Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
    Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
});