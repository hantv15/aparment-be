<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentNotiController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FireNotificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;

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
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'postLogin']);

Route::get('/', function () {
    return view('layouts.app');
});

Route::prefix('/apartment')->group(function () {
    Route::get('/', [ApartmentController::class, 'getApartment'])->name('apartment');
    Route::get('/not-owned', [ApartmentController::class, 'getApartmentNotOwned']);
    Route::get('/not-owned/{id}', [ApartmentController::class, 'getApartmentNotOwnedAndId']);
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
    Route::get('/{id}/add-card', [ApartmentController::class, 'addCardForm']);
    Route::post('/{id}/add-card', [ApartmentController::class, 'saveAddCard']);
    Route::post('/upload-excel', [ApartmentController::class, 'uploadApartment'])->name('apartment.upload-excel');
});

Route::prefix('/bill')->group(function () {
    Route::get('/', [BillController::class, 'getBill'])->name('bill');
    Route::get('/add', [BillController::class, 'addForm'])->name('bill.add');
    Route::post('/add', [BillController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BillController::class, 'editForm'])->name('bill.edit');
    Route::post('/edit/{id}', [BillController::class, 'saveEdit']);
    Route::get('/edit/{id}/add-bill-detail', [BillController::class, 'editAddBillDetailForm']);
    Route::post('/edit/{id}/add-bill-detail', [BillController::class, 'saveEditAddBillDetail']);
    Route::get('/edit/{id}/edit-bill-detail/{bill_detail_id}', [BillController::class, 'editEditBillDetailForm']);
    Route::post('/edit/{id}/edit-bill-detail/{bill_detail_id}', [BillController::class, 'saveEditEditBillDetail']);
    Route::get('/edit-status/{id}', [BillController::class, 'editStatusForm']);
    Route::post('/edit-status/{id}', [BillController::class, 'saveEditStatus']);
    Route::get('/{id}', [BillController::class, 'getBillById'])->name('bill.detail');
    Route::get('/{id}/bill-detail', [BillController::class, 'getBillDetailByBillId']);
});

Route::prefix('/bill-detail')->group(function () {
    Route::get('/', [BillDetailController::class, 'getBillDetail'])->name('bill-detail');
    Route::get('/add', [BillDetailController::class, 'addForm'])->name('bill-detail.add');
    Route::post('/add', [BillDetailController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BillDetailController::class, 'editForm'])->name('bill-detail.edit');
    Route::post('/edit/{id}', [BillDetailController::class, 'saveEdit']);
    Route::get('/{id}', [BillDetailController::class, 'getBillDetailById'])->name('bill-detail.detail');
});

Route::prefix('/building')->group(function () {
    Route::get('/', [BuildingController::class, 'getBuilding'])->name('building');
    Route::get('/add', [BuildingController::class, 'addForm'])->name('building.add');
    Route::post('/add', [BuildingController::class, 'saveAdd']);
    Route::get('/edit/{id}', [BuildingController::class, 'editForm'])->name('building.edit');
    Route::post('/edit/{id}', [BuildingController::class, 'saveEdit']);
    Route::get('/{id}', [BuildingController::class, 'geBuildingById'])->name('building.detail');
    Route::get('/{id}/apartment', [BuildingController::class, 'getApartmentByBuildingId']);
});

Route::prefix('/card')->group(function () {
    Route::get('/', [CardController::class, 'getCard'])->name('card');
    Route::get('/add', [CardController::class, 'addForm'])->name('card.add');
    Route::post('/add', [CardController::class, 'saveAdd']);
    Route::get('/edit/{id}', [CardController::class, 'editForm'])->name('card.edit');
    Route::post('/edit/{id}', [CardController::class, 'saveEdit']);
    Route::post('/remove/{id}', [CardController::class, 'remove']);
    Route::get('/{id}', [CardController::class, 'getCardById'])->name('card.detail');
});

Route::prefix('service-manage')->group(function (){
    Route::get('/', [ServiceController::class, 'getService'])->name('service.index');
    Route::get('/add', [ServiceController::class, 'addForm'])->name('service.add');
    Route::post('/add', [ServiceController::class, 'saveAdd']);
    Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
    Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
});

Route::prefix('/user')->group(function () {
    Route::get('/list', [UserController::class, 'getUser']);
    Route::get('/add', [UserController::class, 'registerForm']);
    Route::post('/add', [UserController::class, 'saveUser']);
    Route::get('/edit/{id}', [UserController::class, 'formEditUser']);
    Route::post('/edit/{id}', [UserController::class, 'saveEditUser']);
    Route::get('/remove/{id}', [UserController::class, 'removeUser']);
    Route::get('/{id}', [UserController::class, 'getUserInfomationById']);
});

Route::prefix('user-manager')->name('user.')->group(function (){
    Route::get('/', [UserController::class, 'getUser'])->name('index');
});

Route::prefix('/vehicle')->group(function () {
    Route::get('/', [VehicleController::class, 'getVehicle'])->name('vehicle');
    Route::get('/add', [VehicleController::class, 'addForm'])->name('vehicle.add');
    Route::post('/add', [VehicleController::class, 'saveAdd']);
    Route::get('/edit/{id}', [VehicleController::class, 'editForm'])->name('vehicle.edit');
    Route::post('/edit/{id}', [VehicleController::class, 'saveEdit']);
    Route::get('/{id}', [VehicleController::class, 'getVehicleById'])->name('vehicle.detail');
});

Route::prefix('/vehicle-type')->group(function () {
    Route::get('/', [VehicleTypeController::class, 'getVehicleType'])->name('vehicle-type');
    Route::get('/add', [VehicleTypeController::class, 'addForm'])->name('vehicle-type.add');
    Route::post('/add', [VehicleTypeController::class, 'saveAdd']);
    Route::get('/edit/{id}', [VehicleTypeController::class, 'editForm'])->name('vehicle-type.edit');
    Route::post('/edit/{id}', [VehicleTypeController::class, 'saveEdit']);
    Route::get('/{id}', [VehicleTypeController::class, 'getVehicleTypeById'])->name('vehicle-type.detail');
});

Route::get('feedback',[FeedbackController::class,'getFeedback']);
Route::post('feedback',[FeedbackController::class,'sendFeedback']);
Route::get('listFeedback',[FeedbackController::class,'listFeedback'])->name('feedback.list');
Route::get('getFeedbackID/{id}',[FeedbackController::class,'getFeedbackById'])->name('feedback.view');

Route::middleware(['web','auth'])->group(function () {

    Route::get('feedback', [FeedbackController::class, 'getFeedback']);
    Route::post('feedback', [FeedbackController::class, 'sendFeedback']);
    Route::get('listFeedback', [FeedbackController::class, 'listFeedback'])->name('feedback.list');
    Route::get('getFeedbackID/{id}', [FeedbackController::class, 'getFeedbackById'])->name('feedback.view');
    Route::get('signout', [\App\Http\Controllers\AuthController::class, 'signOut'])->name('signout');

    Route::get('/', function () {
        return view('layouts.app');
    });
    Route::middleware(['check.admin'])->group(function () {
        Route::get('dashboard/', function () {
            return view('layouts.app');
        })->name('dashboard');
        Route::prefix('user-manager')->name('user.')->group(function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'getUser'])->name('index');
            Route::get('add-user', [\App\Http\Controllers\UserController::class, 'registerForm'])->name('register');
            Route::post('add-user', [\App\Http\Controllers\UserController::class, 'saveUser']);
            Route::get('/edit-user/{id}', [\App\Http\Controllers\UserController::class, 'formEditUser'])->name('edit');
        });

        Route::prefix('service-manage')->group(function () {
            Route::get('/', [ServiceController::class, 'getService'])->name('service.index');
            Route::get('/add', [ServiceController::class, 'addForm'])->name('service.add');
            Route::post('/add', [ServiceController::class, 'saveAdd']);
            Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
        });

        Route::prefix('/card')->group(function () {
            Route::get('/', [CardController::class, 'getCard'])->name('card.index');
            Route::get('/add', [CardController::class, 'addForm'])->name('card.add');
            Route::post('/add', [CardController::class, 'saveAdd']);
            Route::get('/edit/{id}', [CardController::class, 'editForm'])->name('card.edit');
            Route::post('/edit/{id}', [CardController::class, 'saveEdit']);
            Route::post('/remove/{id}', [CardController::class, 'remove'])->name('card.remove');
            Route::get('/{id}', [CardController::class, 'getCardById'])->name('card.detail');
        });
    });
});
