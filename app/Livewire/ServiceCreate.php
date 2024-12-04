<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ServiceCreate extends Component
{
    public $name;
    public $description;
    public $icon = 'fas fa-cog'; 
    public $image_url = 'fas fa-cog';
    public $status = 'active';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'icon' => 'string|max:255',
        'image_url' => 'string|max:255',
        'status' => 'required|in:active,inactive',
    ];

    public function submit()
    {
        $validatedData = $this->validate();

        try {
            Service::create($validatedData);

            session()->flash('success', 'Service created successfully.');
            $this->reset(['name', 'description', 'icon', 'image_url', 'status']);
        } catch (\Exception $e) {
            Log::error('Service Creation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'An error occurred while creating the service. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.service-create')->layout('layouts.volt');
    }
}