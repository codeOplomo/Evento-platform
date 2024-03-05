<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Event;
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
        $notApprovedEvents = Event::where('is_approved', false)->get();
        return view('admin.adminDashboard', ['notApprovedEvents' => $notApprovedEvents]);
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
    Route::put('/dashboard/admin/events/{event}/approve', [EventController::class, 'approve'])->name('admin.events.approve');
    Route::put('/dashboard/admin/events/{event}/reject', [EventController::class, 'reject'])->name('admin.events.reject');


});

Route::middleware(['auth', 'verified', 'checkrole:organiser'])->group(function () {
    Route::get('/organizer-profile', [OrganizerController::class, 'profile'])->name('organizer.profile');
    Route::get('/organizer/events/create', [OrganizerController::class, 'createEvent'])->name('organizer.events.create');
    Route::post('/organizer/events', [OrganizerController::class, 'storeEvent'])->name('organizer.events.store');
});

Route::middleware(['auth', 'verified', 'checkrole:client'])->group(function () {
    Route::get('/client-profile', [ClientController::class, 'profile'])->name('client.profile');
    Route::get('/client/events', [ClientController::class, 'listEvents'])->name('client.events.index');
    Route::get('/client/events/{event}', [ClientController::class, 'showEvent'])->name('client.events.show');

    Route::get('/client/events/{event}/book', [ClientController::class, 'createBooking'])->name('client.bookings.create');
    Route::post('/client/events/{event}/book', [ClientController::class, 'storeBooking'])->name('client.bookings.store');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
