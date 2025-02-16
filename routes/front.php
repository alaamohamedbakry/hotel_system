<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestLoginController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/index',[RoomController::class,'index'])->name('room.index');
Route::get('/create', [BookingController::class, 'create'])->middleware('guest-hotel')->name('booking.create');
Route::post('/store', [BookingController::class, 'store'])->name('booking.store');


Route::prefix('guest')->group(function () {
    Route::get('/login-guest', [GuestLoginController::class, 'login'])->name('guest_login');
    Route::post('/login_submit', [GuestLoginController::class, 'login_submit'])->name('guest_login_submit');
    Route::get('/register', [GuestRegisterController::class, 'showRegistrationForm'])->name('guest.register.form');
    Route::post('/register', [GuestRegisterController::class, 'store'])->name('guest.register');
    Route::get('/logout', [GuestLoginController::class, 'logout'])->name('guest_logout');
});
Route::get('review', [ReviewController::class, 'review'])->name('review');
Route::post('storereview', [ReviewController::class, 'storereview'])->name('storereview');
Route::get('/get-room-details/{room_id}', [RoomController::class, 'getRoomDetails'])->name('getroomdetails');
Route::get('/about-us',[HomeController::class,'about_us'])->name('about_us');
