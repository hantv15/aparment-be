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

Route::prefix('/apartment')->group(function (){
    Route::get('/', [ApartmentController::class, 'getApartment'])->name('apartment');
    Route::get('/add', [ApartmentController::class, 'addForm'])->name('apartment.add');
    Route::post('/add', [ApartmentController::class, 'saveAdd']);
    Route::get('/edit/{id}', [ApartmentController::class, 'editForm'])->name('apartment.edit');
    Route::post('/edit/{id}', [ApartmentController::class, 'saveEdit']);
    Route::get('/{id}', [ApartmentController::class, 'getApartmentById'])->name('apartment.detail');
    Route::get('/{id}/finance', [ApartmentController::class, 'getBillByApartmentId']);
    Route::get('/{id}/finance/unpaid', [ApartmentController::class, 'getUnpaidBillByApartmentId']);
    Route::get('/{id}/finance/paid', [ApartmentController::class, 'getPaidBillByApartmentId']);
    Route::get('/{id}/finance/{bill_id}/bill-detail', [ApartmentController::class, 'getBillDetailByApartmentId']);
    Route::get('/{id}/card', [CardController::class, 'getCardByApartmentId']);
    Route::post('/upload-excel', [ApartmentController::class, 'uploadApartment'])->name('apartment.upload-excel');
});

Route::prefix('/bill')->group(function (){
    Route::get('/', [BillController::class, 'getBill'])->name('bill');
    Route::get('/add', [BillController::class, 'addForm'])->name('bill.add');
    Route::post('/add', [BillController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BillController::class, 'editForm'])->name('bill.edit');
    Route::post('/edit/{id}', [BillController::class, 'saveEdit']);
    Route::get('/{id}', [BillController::class, 'getBillById'])->name('bill.detail');
});

Route::prefix('/bill-detail')->group(function (){
    Route::get('/', [BillDetailController::class, 'getBillDetail'])->name('bill-detail');
    Route::get('/add', [BillDetailController::class, 'addForm'])->name('bill-detail.add');
    Route::post('/add', [BillDetailController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BillDetailController::class, 'editForm'])->name('bill-detail.edit');
    Route::post('/edit/{id}', [BillDetailController::class, 'saveEdit']);
    Route::get('/{id}', [BillDetailController::class, 'getBillDetailById'])->name('bill-detail.detail');
});

Route::prefix('/building')->group(function (){
    Route::get('/', [BuildingController::class, 'getBuilding'])->name('building');
    Route::get('/add', [BuildingController::class, 'addForm'])->name('building.add');
    Route::post('/add', [BuildingController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BuildingController::class, 'editForm'])->name('building.edit');
    Route::post('/edit/{id}', [BuildingController::class, 'saveEdit']);
    Route::get('/{id}', [BuildingController::class, 'geBuildingById'])->name('building.detail');
    Route::get('/{id}/apartment', [BuildingController::class, 'getApartmentByBuildingId']);
});

Route::prefix('/card')->group(function (){
    Route::get('/', [CardController::class, 'getCard'])->name('card');
    Route::get('/add', [CardController::class, 'addForm'])->name('card.add');
    Route::post('/add', [CardController::class, 'saveAdd']);
    Route::get('/edit/{id}', [CardController::class, 'editForm'])->name('card.edit');
    Route::post('/edit/{id}', [CardController::class, 'saveEdit']);
    Route::post('/remove/{id}', [CardController::class, 'remove'])->name('card.remove');
    Route::get('/{id}', [CardController::class, 'getCardById'])->name('card.detail');
});

Route::prefix('/service')->group(function (){
    Route::get('/', [ServiceController::class, 'getService'])->name('service');
    Route::get('/add', [ServiceController::class, 'addForm'])->name('service.add');
    Route::post('/add', [ServiceController::class, 'saveAdd']);
    Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('service.edit');
    Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
    Route::get('/{id}', [ServiceController::class, 'getServiceById'])->name('service.detail');
});

Route::post('payment', [PaymentController::class, 'payment']);
