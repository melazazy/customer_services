<?php

use App\Livewire\Pages\Home;
use App\Livewire\ServiceManagement;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');
    
    // Service Management Routes
    Route::get('/services/manage', ServiceManagement::class)->name('services.manage');
    Route::get('/services/{service}/edit', ServiceManagement::class)->name('services.edit');
    
    // Service Request Routes
    Route::get('/requests', function() {
        return view('requests.index');
    })->name('requests.index');
    
    // Document Management Routes
    Route::get('/documents', function() {
        return view('documents.index');
    })->name('documents.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
