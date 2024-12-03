<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceRequest;

class ManageRequests extends Component
{
    public $requests;

    public function mount()
    {
        $this->requests = ServiceRequest::with(['user', 'service'])->get();
    }

    public function render()
    {
        return view('livewire.manage-requests')->layout('layouts.volt');
    }
}