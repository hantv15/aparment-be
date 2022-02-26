<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ResidentCardController;
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
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/send-notification', [\App\Http\Controllers\ApartmentNotiController::class, 'sendNotification'])->name('save-token');
});

Route::get('/building', [BuildingController::class, 'getBuilding'])->name('building');
Route::get('/building/add', [BuildingController::class, 'addForm']);
Route::post('/building/add', [BuildingController::class, 'saveAdd']);

Route::get('/apartment', [ApartmentController::class, 'getApartment'])->name('apartment');
Route::get('/apartment/add', [ApartmentController::class, 'addForm']);
Route::post('/apartment/add', [ApartmentController::class, 'saveAdd']);
Route::get('/apartment/{id}', [ApartmentController::class, 'getApartmentInfo']);
 Route::get('/apartment/{id}/finance', [ApartmentController::class, 'getBillByApartmentId']);
// Route::get('/apartment/{id}/finance/{bill_id}/bill_detail', [ApartmentController::class, 'getBillDetailByApartmentId']);
// Route::get('/apartment/{id}/resident-card', [ResidentCardController::class, 'getResidentCardByApartmentId']);
Route::get('/bill_detail', [BillDetailController::class, 'getBillDetail']);
Route::get('/bill_detail/{id}', [BillDetailController::class, 'getBillDetailById']);

Route::get('/service', [ServiceController::class, 'getService'])->name('service');
Route::post('/service/add', [ServiceController::class, 'addService']);

Route::post('payment', [\App\Http\Controllers\PaymentController::class, 'payment']);
