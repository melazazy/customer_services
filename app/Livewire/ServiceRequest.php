<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceRequest as ServiceRequestModel;


class ServiceRequest extends Component
{
    use WithFileUploads;

    public $services;
    public $selectedService;
    public $documents = [];
    public $notes;

    public function mount()
    {
        $this->services = Service::where('status', 'active')->get();
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'selectedService' => 'required|exists:services,id',
            'documents.*' => 'nullable|file|max:1024', // 1MB Max
            'notes' => 'nullable|string|max:500',
        ]);

        // Handle file uploads
        $uploadedFiles = [];
        foreach ($this->documents as $document) {
            $uploadedFiles[] = $document->store('documents');
        }

        // Save the service request
        ServiceRequest::create([
            'service_id' => $validatedData['selectedService'],
            'notes' => $validatedData['notes'],
            'documents' => json_encode($uploadedFiles),
        ]);

        session()->flash('message', 'Service request submitted successfully.');
    }

    public function render()
    {
        return view('livewire.service-request')->layout('layouts.volt');
    }
     
}
