<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotmanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// botman
Route::match(['get', 'post'], '/botman', [BotmanController::class, 'handle'])->name('botman');
Route::view('/botman-frame', 'botman-frame');


Route::get('/', [GuestController::class, 'index'])->name('index');
Route::get('/dashboard',  [GuestController::class, 'index'])->name('dashboard')->middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified']);
Route::view('/about', 'about');
Route::view('/gallery', 'gallery');

Route::post('/register', [RegisterController::class, 'create'])->name('register');

Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'AllowUser:client'], function () {
        Route::resource('reservation', ReservationController::class)
        ->middleware(['AllowUser:client'
        , 'verified.id'
        ]);
    Route::put('update-reservation-notice/{id}', [ReservationController::class, 'updateNotice'])->name('reservation.updateNotice');

    });

    Route::group(['middleware' => 'AllowUser:admin', 'prefix' => 'admin'], function () {
        Route::get('/reservations', [AdminController::class , 'reservations'])->name('admin.reservations');
        Route::delete('delete-reservation/{id}', [AdminController::class, 'destroy'])->name('admin.reservation-delete');
        Route::put('update-reservation/{id}', [AdminController::class, 'update'])->name('admin.reservation-update');
        Route::get('/reservation/{id}', [AdminController::class , 'showReservation'])->name('admin.reservation.show');
        Route::resource('inventory', InventoryController::class);
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::resource('users', UserController::class);
        Route::get('/archive', [UserController::class, 'archives'])->name('users.archive');
        Route::post('/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::post('/report-pdf', [PDFController::class, 'reportPdf'])->name('report-pdf');
        Route::get('/receipt-pdf', [PDFController::class, 'receiptPdf'])->name('receipt-pdf');
        Route::get('/mail', [AdminController::class, 'sendMail'])->name('send-mail');
    });
});