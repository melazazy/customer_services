<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        if (Auth::user()->is_admin) {
            $stats = $this->getAdminStats();
            $recentServices = $this->getRecentServices();
            $recentRequests = $this->getRecentRequests();
            return view('livewire.pages.dashboard', compact('stats', 'recentServices', 'recentRequests'))->layout('layouts.volt');
        } else {
            $userStats = $this->getUserStats();
            $recentUserRequests = $this->getRecentUserRequests();
            return view('livewire.pages.dashboard', compact('userStats', 'recentUserRequests'))->layout('layouts.volt');
        }
    }

    private function getAdminStats()
    {
        return [
            'total_services' => Service::count(),
            'active_requests' => ServiceRequest::where('status', 'active')->count(),
            'total_users' => User::count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
        ];
    }

    private function getUserStats()
    {
        $userId = Auth::id();
        return [
            // 'your_services' => Service::where('user_id', $userId)->count(),
            'your_requests' => ServiceRequest::where('user_id', $userId)->count(),
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

    private function getRecentUserRequests()
    {
        $userId = Auth::id();
        return ServiceRequest::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
    }
}