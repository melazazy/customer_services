<?php

use App\Http\Controllers\ServiceRequestController;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Dashboard;
use App\Livewire\ServiceManagement;
use App\Livewire\Profile\Edit;
use App\Livewire\Profile\Show;
use App\Http\Livewire\Pages\ServiceRequest;
use App\Livewire\Pages\Goldenspeed;
use Illuminate\Support\Facades\Route;
use App\Livewire\ManageRequests;
use App\Livewire\ManageServices;
use App\Livewire\ManageUsers;
use App\Livewire\ServiceRequest as LivewireServiceRequest;
use App\Livewire\ServiceCreate;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
    // Home Route
    Route::get('/', Goldenspeed::class)->name('home');

    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', Dashboard::class)
            ->middleware(['verified'])
            ->name('dashboard');

        Route::get('/manage-requests', ManageRequests::class)->name('manage.requests');
        Route::get('/manage-users', ManageUsers::class)->name('manage.users');
        Route::get('/manage-services', ManageServices::class)->name('manage.services');

        Route::get('/request-service', LivewireServiceRequest::class)->name('request.service');
        Route::get('/create-service', ServiceCreate::class)->name('create.service');

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
        Route::get('/services/manage', ServiceManagement::class)->name('services.manage');
        Route::get('/services/{service}/edit', ServiceManagement::class)->name('services.edit');

        // Service Request Routes
        Route::get('/requests', function () {
            return view('requests.index');
        })->name('requests.index');

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
});

require __DIR__ . '/auth.php';
