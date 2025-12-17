<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Tech\TechDashboardController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Customer\ComplaintController;
use App\Http\Controllers\Admin\ComplaintAdminController;
use App\Http\Controllers\Tech\TechComplaintController;


// AUTH
Auth::routes();


//ROOT REDIRECT 
Route::get('/', function () {
    if (!Auth::check()) return redirect('/login');

    if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
    if (Auth::user()->role === 'technician') return redirect()->route('tech.dashboard');

    return redirect()->route('customer.dashboard');
});


// CUSTOMER ROUTES
Route::middleware(['auth'])->prefix('customer')->group(function () {

    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/complaints', [ComplaintController::class, 'index'])->name('customer.complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('customer.complaints.create');
    Route::post('/complaints/store', [ComplaintController::class, 'store'])->name('customer.complaints.store');
    Route::get('/complaints/view/{id}', [ComplaintController::class, 'view'])->name('customer.complaints.view');
    Route::delete('/complaints/delete/{id}', [ComplaintController::class, 'destroy'])->name('customer.complaints.delete');
});


// DELIVERY VERIFY (TECH ONLY)
// Route::get('/verify-delivery/{id}', [TechComplaintController::class, 'verifyDelivery'])
//     ->middleware('auth')
//     ->name('delivery.verify');

Route::middleware(['auth', 'can:isTech'])
->get('/verify-delivery/{id}',[TechComplaintController::class, 'verifyDelivery'])
->name('delivery.verify');


// TECHNICIAN ROUTES
Route::middleware(['auth', 'can:isTech'])->prefix('tech')->group(function () {
    Route::get('/dashboard', [TechDashboardController::class, 'index'])->name('tech.dashboard');

    Route::get('/complaints', [TechComplaintController::class, 'index'])->name('tech.complaints.index');
    Route::post('/complaints/update/{id}', [TechComplaintController::class, 'updateStatus'])->name('tech.complaints.update');
    Route::get('/complaints/ready/{id}', [TechComplaintController::class, 'showReady'])->name('tech.complaints.ready');
});


//ADMIN ROUTES 
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Technicians
    Route::get('/technicians', [TechnicianController::class, 'index'])->name('technicians.index');
    Route::get('/technicians/create', [TechnicianController::class, 'create'])->name('technicians.create');
    Route::post('/technicians/store', [TechnicianController::class, 'store'])->name('technicians.store');
    Route::delete('/technicians/delete/{id}', [TechnicianController::class, 'destroy'])->name('technicians.delete');
    Route::get('/technicians/edit/{id}', [TechnicianController::class, 'edit'])->name('technicians.edit');
    Route::post('/technicians/update/{id}', [TechnicianController::class, 'update'])->name('technicians.update');

    // Complaints
    Route::get('/complaints', [ComplaintAdminController::class, 'index'])->name('admin.complaints.index');
    Route::get('/complaints/{id}', [ComplaintAdminController::class, 'view'])->name('admin.complaints.view');
    Route::post('/complaints/assign/{id}', [ComplaintAdminController::class, 'assign'])->name('admin.complaints.assign');
    Route::post('/complaints/update/{id}', [ComplaintAdminController::class, 'updateStatus'])->name('admin.complaints.update');

    // customers
    Route::get('/customers', [DashboardController::class, 'customers'])->name('admin.customers.index');
});
