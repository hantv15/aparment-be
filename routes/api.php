<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;

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

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/apartment', [ApartmentController::class, 'getApartment'])->name('apartment');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/send-notification', [\App\Http\Controllers\ApartmentNotiController::class, 'sendNotification'])->name('save-token');
});
Route::get('test', [\App\Http\Controllers\ApartmentNotiController::class, 'test']);

Route::get('/department', [DepartmentController::class, 'getDepartment'])->name('department');
Route::post('payment', [\App\Http\Controllers\PaymentController::class, 'payment']);
Route::get('/service', [ServiceController::class, 'getService'])->name('service');
Route::post('/service/add', [ServiceController::class, 'addService']);