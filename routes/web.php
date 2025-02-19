<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffProfileController;
use App\Http\Controllers\UserController;
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


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/login', [DashboardController::class, 'login_admin'])->name('admin.login');
Route::get('/admin/register', [DashboardController::class, 'register_admin'])->name('admin.register');

Route::prefix('roomtype')->group(function () {
    Route::get('/index', [RoomTypeController::class, 'index'])->name('roomtype.index');
    Route::get('/create', [RoomTypeController::class, 'create'])->name('roomtype.create');
    Route::post('/store', [RoomTypeController::class, 'store'])->name('roomtype.store');
    Route::get('/edit/{roomtype}', [RoomTypeController::class, 'edit'])->name('roomtype.edit');
    Route::put('update/{roomtype}', [RoomTypeController::class, 'update'])->name('roomtype.update');
    Route::delete('/delete/{id}', [RoomTypeController::class, 'destroy'])->name('roomtype.destroy');
});

Route::prefix('hotel')->group(function () {
    Route::get('/show_tables', [HomeController::class, 'show_tables'])->name('hotel.show.tables');
    Route::get('/create', [HomeController::class, 'create'])->name('hotel.create');
    Route::post('/store', [HomeController::class, 'store'])->name('hotel.store');
    Route::get('/edit/{hotel}', [HomeController::class, 'edit'])->name('hotel.edit');
    Route::put('/update/{hotel}', [HomeController::class, 'update'])->name('hotel.update');
    Route::delete('/delete/{id}', [HomeController::class, 'destroy'])->name('hotel.destory');
});

Route::prefix('room')->group(function () {
    Route::get('/show_tables', [RoomController::class, 'show_tables'])->name('rooms.show.tables');
    Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/edit/{room}', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/update/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});
Route::prefix('booking')->group(function () {
    Route::get('/index/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/create/admin', [BookingController::class, 'admin_create'])->name('booking_admin.create');
    Route::post('/store/admin', [BookingController::class, 'admin_store'])->name('booking_admin.store');
    Route::get('/edit/{booking}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/update/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/show/{id}', [BookingController::class, 'show'])->name('booking.show');
});
Route::prefix('guest')->group(function () {
    Route::get('/show_tables', [DashboardController::class, 'show_tables'])->name('guests.show.tables');
    Route::get('/sendemail/{id}', [DashboardController::class, 'email_sending'])->name('send_email_guests');
    Route::post('/mail/{id}', [DashboardController::class, 'mailing'])->name('mailing');
    Route::get('/create/guest', [DashboardController::class, 'create_guest'])->name('guest.create');
    Route::post('/store/guest', [DashboardController::class, 'store_guest'])->name('guest.store');
    Route::get('/edit/{guest}', [DashboardController::class, 'edit_guest'])->name('guest.edit');
    Route::put('/update/{guest}', [DashboardController::class, 'update_guest'])->name('guest.update');
    Route::delete('/delete/{guest}', [DashboardController::class, 'destroy'])->name('guest.destroy');
});

Route::prefix('staff')->group(function () {
    Route::get('/show-tables', [StaffController::class, 'show_tables'])->name('staff.show_tables');
    Route::get('/create/staff', [StaffController::class, 'createstaff'])->name('staff.form');
    Route::post('/store/staff', [StaffController::class, 'storestaff'])->name('staff.store');
    Route::get('/register', [StaffController::class, 'RegistrationForm'])->name('staff.register.form');
    Route::post('/register', [StaffController::class, 'register'])->name('staff.register');
    Route::get('/login-staff', [StaffController::class, 'login'])->name('staff_login');
    Route::post('/login_submit', [StaffController::class, 'login_submit'])->name('staff_login_submit');
    Route::get('staff/logout', [StaffController::class, 'logout'])->name('staff.logout');
    Route::get('/dashboard-staff', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/edit/{staff}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/update/{staff}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
});
Route::middleware(['auth:staff'])->group(function () {
    Route::get('/staff/profile/edit', [StaffProfileController::class, 'edit'])->name('staff.profile.edit');
    Route::put('/staff/profile/update', [StaffProfileController::class, 'update'])->name('staff.profile.update');
});


Route::get('/admin/booking/avilable-rooms/{checkindate}', [BookingController::class, 'avilable_rooms']);
Route::get('/index-dashboarrd', [DashboardController::class, 'admin_index'])->name('admin_index');

Route::get('/chart-bookings', [DashboardController::class, 'chart_bookings'])->name('chart_bookings');
Route::get('/chart-rooms', [DashboardController::class, 'chart_rooms'])->name('chart_rooms');
Route::get('/chart-staff', [DashboardController::class, 'chart_staff'])->name('chart_staff');
Route::get('/total-bookings', [DashboardController::class, 'total_bookings'])->name('total_bookings');
Route::get('/total-rooms', [DashboardController::class, 'total_rooms'])->name('total_rooms');
Route::get('/total-user', [DashboardController::class, 'total_user'])->name('total_user');
Route::get('/total-hotels', [DashboardController::class, 'total_hotels'])->name('total_hotels');


Route::patch('/rooms/{id}/status', [RoomController::class, 'updateStatus'])->name('rooms.update.status');
Route::get('/Addroomimages/{roomid}', [RoomController::class, 'addroomimages'])->name('addroomimage');
Route::post('/storeroomimage', [RoomController::class, 'storeroomimage'])->name('storeroomimage');
Route::delete('/removephotos/{roomphoto}', [RoomController::class, 'removeroomphotos'])->name('removeroomphotos');
Route::get('/mail-inbox', [DashboardController::class, 'inbox'])->name('inbox');
Route::get('/send_email/{id}', [DashboardController::class, 'send_email'])->name('send_email');
Route::post('/mail/{id}', [DashboardController::class, 'mail'])->name('mail');
Route::get('/notificataions', [DashboardController::class, 'notifications'])->name('notifications');
Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');


Route::resource('roles', RoleController::class)->except(['show']);
require __DIR__ . '/auth.php';
