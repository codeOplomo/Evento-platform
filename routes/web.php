<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'checkrole:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.adminDashboard');
    })->name('dashboard');
    Route::get('/dashboard/admin/users', function () {
        return view('admin.users.index');
    })->name('admin.users.index');
    Route::get('/dashboard/admin/tickets', function () {
        return view('admin.tickets.index');
    })->name('admin.tickets.index');
    Route::get('/dashboard/admin/events', function () {
        return view('admin.events.index');
    })->name('admin.events.index');
    Route::get('/dashboard/admin/categories', function () {
        return view('admin.categories.index');
    })->name('admin.categories.index');
    Route::get('/dashboard/admin/bookings', function () {
        return view('admin.bookings.index');
    })->name('admin.bookings.index');
    Route::resource('/dashboard/admin/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/dashboard/admin/events', EventController::class)->names('admin.events');
    Route::resource('/dashboard/admin/bookings', BookingController::class)->names('admin.bookings');
    Route::resource('/dashboard/admin/tickets', TicketController::class)->names('admin.tickets');
    Route::resource('/dashboard/admin/users', UserController::class)->names('admin.users');

});

Route::middleware(['auth', 'verified', 'checkrole:organiser'])->group(function () {
    Route::get('/organizer-profile', function () {
        return view('organizer.profile');
    })->name('organizer.profile');
});

Route::middleware(['auth', 'verified', 'checkrole:client'])->group(function () {
    Route::get('/client-profile', function () {
        return view('client.profile');
    })->name('client.profile');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
