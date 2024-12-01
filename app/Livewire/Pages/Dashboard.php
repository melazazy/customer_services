// app/Livewire/Pages/Dashboard.php
<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard', [
            'stats' => $this->getStats(),
            'recentServices' => $this->getRecentServices(),
            'recentRequests' => $this->getRecentRequests(),
        ])->layout('layouts.app');
    }

    private function getStats()
    {
        return [
            'total_services' => Service::count(),
            'active_requests' => ServiceRequest::where('status', 'active')->count(),
            'total_users' => User::count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
        ];
    }

    private function getRecentServices()
    {
        return Service::latest()->take(5)->get();
    }

    private function getRecentRequests()
    {
        return ServiceRequest::with('service', 'user')
            ->latest()
            ->take(5)
            ->get();
    }
}