<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentNotiController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PaymentController;
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
    Route::post('/send-notification', [ApartmentNotiController::class, 'sendNotification'])->name('save-token');
});

Route::get('/apartment', [ApartmentController::class, 'getApartment'])->name('apartment');
Route::get('/apartment/add', [ApartmentController::class, 'addForm']);
Route::post('/apartment/add', [ApartmentController::class, 'saveAdd']);
Route::get('/apartment/edit/{id}', [ApartmentController::class, 'editForm']);
Route::post('/apartment/edit/{id}', [ApartmentController::class, 'saveEdit']);
Route::get('/apartment/{id}', [ApartmentController::class, 'getApartmentById']);
Route::get('/apartment/{id}/finance', [ApartmentController::class, 'getBillByApartmentId']);
Route::get('/apartment/{id}/finance/unpaid', [ApartmentController::class, 'getUnpaidBillByApartmentId']);
Route::get('/apartment/{id}/finance/paid', [ApartmentController::class, 'getPaidBillByApartmentId']);
Route::get('/apartment/{id}/finance/{bill_id}/bill_detail', [ApartmentController::class, 'getBillDetailByApartmentId']);
Route::get('/apartment/{id}/card', [CardController::class, 'getCardByApartmentId']);

Route::get('/bill', [BillController::class, 'getBill'])->name('bill');
Route::get('/bill/add', [BillController::class, 'addForm']);
Route::post('/bill/add', [BillController::class, 'saveAdd']);
Route::get('/bill/edit/{id}', [BillController::class, 'editForm']);
Route::post('/bill/edit/{id}', [BillController::class, 'saveEdit']);
Route::get('/bill/{id}', [BillController::class, 'getBillById']);

Route::get('/bill-detail', [BillDetailController::class, 'getBillDetail'])->name('bill-detail');
Route::get('/bill-detail/add', [BillDetailController::class, 'addForm']);
Route::post('/bill-detail/add', [BillDetailController::class, 'saveAdd']);
Route::get('/bill-detail/edit/{id}', [BillDetailController::class, 'editForm']);
Route::post('/bill-detail/edit/{id}', [BillDetailController::class, 'saveEdit']);
Route::get('/bill-detail/{id}', [BillDetailController::class, 'getBillDetailById']);

Route::get('/building', [BuildingController::class, 'getBuilding'])->name('building');
Route::get('/building/add', [BuildingController::class, 'addForm']);
Route::post('/building/add', [BuildingController::class, 'saveAdd']);
Route::get('/building/edit/{id}', [BuildingController::class, 'editForm']);
Route::post('/building/edit/{id}', [BuildingController::class, 'saveEdit']);
Route::get('/building/{id}', [BuildingController::class, 'geBuildingById']);
Route::get('/building/{id}/apartment', [BuildingController::class, 'getApartmentByBuildingId']);

Route::get('/card', [CardController::class, 'getCard'])->name('card');
Route::get('/card/add', [CardController::class, 'addForm']);
Route::post('/card/add', [CardController::class, 'saveAdd']);
Route::get('/card/edit/{id}', [CardController::class, 'editForm']);
Route::post('/card/edit/{id}', [CardController::class, 'saveEdit']);
Route::get('/card/{id}', [CardController::class, 'getCardById']);
Route::post('/card/remove/{id}', [CardController::class, 'remove']);

Route::get('/service', [ServiceController::class, 'getService'])->name('service');
Route::get('/service/add', [ServiceController::class, 'addForm']);
Route::post('/service/add', [ServiceController::class, 'saveAdd']);
Route::get('/service/edit/{id}', [ServiceController::class, 'editForm']);
Route::post('/service/edit/{id}', [ServiceController::class, 'saveEdit']);
Route::get('/service/{id}', [ServiceController::class, 'getServiceById']);

Route::post('payment', [PaymentController::class, 'payment']);
