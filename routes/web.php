<?php

use App\Http\Controllers\AdminTechnicians;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentNotiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CateMaintenanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FireNotificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\LoginController;
use App\Http\Controllers\Clients\ProfileController;

use App\Http\Controllers\Controller;

use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Models\Maintenancecategory;

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

Route::get('example', [Controller::class, 'test'])->name('example');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', function () {
    return view('layouts.app');
});
Route::prefix('client')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('feedback', [HomeController::class, 'sendFeedback'])->name('feedbacks');
    Route::get('/login', [LoginController::class, 'login'])->name('login-client');
    Route::post('/login', [LoginController::class, 'postLogin']);
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/{id}/bill-detail', [ProfileController::class, 'getBillDetail'])->name('billDetail');
});
Route::prefix('user-manager')->group(function (){
    Route::get('/', [UserController::class, 'getUser'])->name('index');
});
Route::middleware(['web','auth'])->group(function () {
    Route::get('feedback', [FeedbackController::class, 'getFeedback'])->name('feedback.add');
    Route::post('feedback', [FeedbackController::class, 'sendFeedback']);
    Route::get('listFeedback', [FeedbackController::class, 'listFeedback'])->name('feedback.list');
    Route::get('getFeedbackID/{id}', [FeedbackController::class, 'getFeedbackById'])->name('feedback.view');
    Route::get('remove-feedback/{id}', [FeedbackController::class, 'remove'])->name('feedback.remove');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('layouts.app');
    });

    Route::middleware(['check.admin'])->group(function () {
        Route::get('dashboard/', function () {
            return view('layouts.app');
        })->name('dashboard');

        Route::prefix('user-manager')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'getUser'])->name('index');
            Route::get('add-user', [UserController::class, 'registerForm'])->name('register');
            Route::post('add-user', [UserController::class, 'saveUser']);
            Route::get('/edit-user/{id}', [UserController::class, 'formEditUser'])->name('edit');
            Route::post('/edit-user/{id}', [UserController::class, 'saveEditUser']);
        });

        Route::prefix('service-manager')->name('service.')->group(function () {
            Route::get('/', [ServiceController::class, 'getService'])->name('index');
            Route::get('/add', [ServiceController::class, 'addForm'])->name('add');
            Route::post('/add', [ServiceController::class, 'saveAdd']);
            Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
        });

        Route::prefix('/card-manager')->name('card.')->group(function () {
            Route::get('/', [CardController::class, 'getCard'])->name('index');
            Route::get('/add', [CardController::class, 'addForm'])->name('add');
            Route::post('/add', [CardController::class, 'saveAdd']);
            Route::get('/edit/{id}', [CardController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [CardController::class, 'saveEdit']);
            Route::post('/remove/{id}', [CardController::class, 'remove'])->name('remove');
            Route::get('/{id}', [CardController::class, 'getCardById'])->name('detail');
        });

        Route::prefix('/apartment')->name('apartment.')->group(function () {
            Route::get('/', [ApartmentController::class, 'getApartment'])->name('index');
            Route::get('/not-owned', [ApartmentController::class, 'getApartmentNotOwned']);
            Route::get('/not-owned/{id}', [ApartmentController::class, 'getApartmentNotOwnedAndId']);
            Route::get('/add', [ApartmentController::class, 'addForm'])->name('add');
            Route::post('/add', [ApartmentController::class, 'saveAdd']);
            Route::get('/edit/{id}', [ApartmentController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [ApartmentController::class, 'saveEdit']);
            Route::get('/{id}', [ApartmentController::class, 'getApartmentById'])->name('detail');
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
            Route::get('/', [BillController::class, 'getBill'])->name('bill.index');
            Route::get('/list-unpaid', [BillController::class, 'getUnpaidBill'])->name('bill.list-unpaid');
            Route::get('/list-paid', [BillController::class, 'getPaidBill'])->name('bill.list-paid');
            Route::get('/add', [BillController::class, 'addForm'])->name('bill.add');
            Route::post('/add', [BillController::class, 'saveAdd']);
            Route::get('/add-list', [BillController::class, 'addListForm'])->name('bill.add-list');
            Route::post('/add-list', [BillController::class, 'saveAddList']);
            Route::get('/edit/{id}', [BillController::class, 'editForm'])->name('bill.edit');
            Route::post('/edit/{id}', [BillController::class, 'saveEdit']);
            Route::get('/edit/{id}/add-bill-detail', [BillController::class, 'editAddBillDetailForm'])->name('bill.add-bill-detail');
            Route::post('/edit/{id}/add-bill-detail', [BillController::class, 'saveEditAddBillDetail']);
            Route::get('/edit/{id}/edit-bill-detail/{bill_detail_id}', [BillController::class, 'editEditBillDetailForm']);
            Route::post('/edit/{id}/edit-bill-detail/{bill_detail_id}', [BillController::class, 'saveEditEditBillDetail']);
            Route::get('/edit-status/{id}', [BillController::class, 'editStatusForm']);
            Route::post('/edit-status/{id}', [BillController::class, 'saveEditStatus']);
            Route::get('/{id}', [BillController::class, 'getBillById'])->name('bill.detail');
            Route::get('/{id}/bill-detail', [BillController::class, 'getBillDetailByBillId']);
        });

        Route::prefix('/bill-detail')->group(function () {
            Route::get('/', [BillDetailController::class, 'getBillDetail'])->name('bill-detail.index');
            Route::get('/add', [BillDetailController::class, 'addForm'])->name('bill-detail.add');
            Route::post('/add', [BillDetailController::class, 'saveAdd']);
            Route::get('/edit/{id}', [BillDetailController::class, 'editForm'])->name('bill-detail.edit');
            Route::post('/edit/{id}', [BillDetailController::class, 'saveEdit']);
            Route::get('/{id}', [BillDetailController::class, 'getBillDetailById'])->name('bill-detail.detail');
        });

        Route::prefix('/building')->name('building.')->group(function () {
            Route::get('/', [BuildingController::class, 'getBuilding'])->name('index');
            Route::get('/add', [BuildingController::class, 'addForm'])->name('add');
            Route::post('/add', [BuildingController::class, 'saveAdd']);
            Route::get('/edit/{id}', [BuildingController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [BuildingController::class, 'saveEdit']);
            Route::get('/{id}', [BuildingController::class, 'geBuildingById'])->name('detail');
            Route::get('/{id}/apartment', [BuildingController::class, 'getApartmentByBuildingId'])->name('apartment');
        });

        Route::prefix('/department')->name('department.')->group(function () {
            Route::get('/', [DepartmentController::class, 'getDepartment'])->name('index');
            Route::get('/add', [DepartmentController::class, 'addForm'])->name('add');
            Route::post('/add', [DepartmentController::class, 'saveAdd']);
            Route::get('/edit/{id}', [DepartmentController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [DepartmentController::class, 'saveEdit']);
            Route::get('/{id}', [DepartmentController::class, 'getDepartmentById'])->name('detail');
        });

        Route::prefix('/staff')->name('staff.')->group(function () {
            Route::get('/', [StaffController::class, 'getStaff'])->name('index');
            Route::get('/add', [StaffController::class, 'addForm'])->name('add');
            Route::post('/add', [StaffController::class, 'saveAdd']);
            Route::get('/edit/{id}', [StaffController::class, 'editForm'])->name('edit');
            Route::post('/edit/{id}', [StaffController::class, 'saveEdit']);
            Route::get('/remove/{id}', [StaffController::class, 'remove'])->name('remove');
            Route::get('/{id}', [StaffController::class, 'getStaffById'])->name('detail');
        });

        Route::prefix('/vehicle')->group(function () {
            Route::get('/', [VehicleController::class, 'getVehicle'])->name('vehicle.index');
            Route::get('/add', [VehicleController::class, 'addForm'])->name('vehicle.add');
            Route::post('/add', [VehicleController::class, 'saveAdd']);
            Route::get('/edit/{id}', [VehicleController::class, 'editForm'])->name('vehicle.edit');
            Route::post('/edit/{id}', [VehicleController::class, 'saveEdit']);
            Route::get('/{id}', [VehicleController::class, 'getVehicleById'])->name('vehicle.detail');
        });

        Route::prefix('/vehicle-type')->group(function () {
            Route::get('/', [VehicleTypeController::class, 'getVehicleType'])->name('vehicle-type.index');
            Route::get('/add', [VehicleTypeController::class, 'addForm'])->name('vehicle-type.add');
            Route::post('/add', [VehicleTypeController::class, 'saveAdd']);
            Route::get('/edit/{id}', [VehicleTypeController::class, 'editForm'])->name('vehicle-type.edit');
            Route::post('/edit/{id}', [VehicleTypeController::class, 'saveEdit']);
            Route::get('/{id}', [VehicleTypeController::class, 'getVehicleTypeById'])->name('vehicle-type.detail');
        });
    });
    Route::prefix('/maintenance')->group(function(){
        Route::get('/',[MaintenanceController::class,'getMaintenance'])->name('maintenance.index');
        Route::get('/add',[MaintenanceController::class,'addForm'])->name('maintenance.add');
        Route::post('/add',[MaintenanceController::class,'saveAdd']);
        Route::get('/edit/{id}',[MaintenanceController::class,'editForm'])->name('maintenance.edit');
        Route::post('/edit/{id}',[MaintenanceController::class,'saveEdit']);
        Route::get('/remove/{id}',[MaintenanceController::class,'remove'])->name('maintenance.remove');
    });
    Route::prefix('/category-maintenance')->group(function(){
        Route::get('/',[CateMaintenanceController::class,'index'])->name('category-maintenance.index');
        Route::get('/add',[CateMaintenanceController::class,'addForm'])->name('category-maintenance.add');
        Route::post('/add',[CateMaintenanceController::class,'saveAdd']);
        Route::get('/edit/{id}',[CateMaintenanceController::class,'editForm'])->name('category-maintenance.edit');
        Route::post('/edit/{id}',[CateMaintenanceController::class,'saveEdit']);
        Route::get('/remove/{id}',[CateMaintenanceController::class,'remove'])->name('category-maintenance.remove');
    });
    Route::prefix('/admin-technicians')->group(function(){
        Route::get('/',[AdminTechnicians::class,'get'])->name('admin-technicians.index');
        Route::get('/add',[AdminTechnicians::class,'addForm'])->name('admin-technicians.add');
        Route::post('/add',[AdminTechnicians::class,'saveAdd']);
        Route::get('/edit/{id}',[AdminTechnicians::class,'editForm'])->name('admin-technicians.edit');
        Route::post('/edit/{id}',[AdminTechnicians::class,'saveEdit']);
        Route::get('/remove/{id}',[AdminTechnicians::class,'remove'])->name('admin-technicians.remove');
    });
});
