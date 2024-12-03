<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\Dashboard;
use App\Livewire\ServiceManagement;
use App\Livewire\Profile\Edit;
use App\Livewire\Profile\Show;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)
        ->middleware(['verified'])
        ->name('dashboard');

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
