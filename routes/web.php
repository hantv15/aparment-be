<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\FeedbackController;
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
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'postLogin']);

Route::middleware(['auth'])->group(function () {

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

