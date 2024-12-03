<?php

use App\Http\Controllers\ServiceRequestController;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Dashboard;
use App\Livewire\ServiceManagement;
use App\Livewire\Profile\Edit;
use App\Livewire\Profile\Show;
// use App\Livewire\ServiceRequest; // Add this line
use App\Http\Livewire\Pages\ServiceRequest;
use Illuminate\Support\Facades\Route;
use App\Livewire\ManageRequests;
use App\Livewire\ServiceRequest as LivewireServiceRequest;


Route::get('/', Home::class)->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)
        ->middleware(['verified'])
        ->name('dashboard');

    Route::get('/manage-requests', ManageRequests::class)->name('manage.requests');
    Route::get('/request-service', LivewireServiceRequest::class)->name('request.service');
    // Profile Routes
    Route::get('/profile', Show::class)
        ->name('profile');
    Route::get('/profile/edit', Edit::class)
        ->name('profile.edit');
    Route::patch('/profile', function () {
        // Handle the profile update
    })->name('profile.update');
    Route::delete('/profile', function () {
        // Handle the profile deletion
    })->name('profile.destroy');

    // Service Management Routes
    Route::get('/services', function () {
        return view('services.index');
    })->name('services');
    // Route::get('/services', Show::class)->name('services');
    Route::get('/services/manage', ServiceManagement::class)->name('services.manage');
    Route::get('/services/{service}/edit', ServiceManagement::class)->name('services.edit');

    // Service Request Routes
    Route::get('/requests', function () {
        return view('requests.index');
    })->name('requests.index');
    // Service Request Route
    // Route::get('/service-request', ServiceRequest::class)->name('service.request');
    // Route::view('/service-request', 'service-request')->name('service.request');
    // Route::get('/service-request', [ServiceRequestController::class, 'index'])->name('service.request');
    // Route::post('/service-request/store', [ServiceRequestController::class, 'submit'])->name('service.request.store');

    // Document Management Routes
    Route::get('/documents', function () {
        return view('documents.index');
    })->name('documents.index');

    // Logout Route
    Route::post('logout', function () {
        auth()->guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

require __DIR__ . '/auth.php';
