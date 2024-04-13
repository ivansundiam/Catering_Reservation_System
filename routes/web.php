<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotmanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InventoryController;
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

Route::post('/register', [RegisterController::class, 'create'])->name('register');

Route::group(['middleware' => 'auth'], function (){
    Route::resource('reservation', ReservationController::class)
    ->only('index', 'create', 'store', 'show', 'update')
    ->middleware(['AllowUser:client'
    // , 'verified.id'
]);

    Route::group(['middleware' => 'AllowUser:admin', 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class , 'dashboard'])->name('admin-dashboard');
        Route::resource('inventory', InventoryController::class);
        Route::resource('users', UserController::class);
        Route::get('/archive', [UserController::class, 'archives'])->name('users.archive');
        Route::post('/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    });
});