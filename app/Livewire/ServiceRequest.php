<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use App\Models\ServiceRequest as ServiceRequestModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ServiceRequest extends Component
{
    use WithFileUploads;

    // Public properties
    public $services;
    public $service_id;
    public $documents = [];
    public $notes;

    // Validation rules
    protected $rules = [
        'service_id' => 'required|exists:services,id',
        'documents.*' => 'nullable|file|max:1024', // 1MB Max
        'notes' => 'nullable|string|max:500',
    ];

    // Custom error messages (optional)
    protected $messages = [
        'service_id.required' => 'Please select a service.',
        'service_id.exists' => 'The selected service is invalid.',
        'documents.*.max' => 'Each document must be less than 1MB.',
        'notes.max' => 'Notes cannot exceed 500 characters.',
    ];

    // Lifecycle method
    public function mount()
    {
        // dd(Auth::user());
        $this->services = Service::where('status', 'active')->get();
        $this->service_id = request()->query('service_id');; // Set the default selected service

    }

    // File upload handler
    private function handleFileUploads()
    {
        $uploadedFiles = [];

        if ($this->documents) {
            $documents = is_array($this->documents) ? $this->documents : [$this->documents];
            dd($documents);
            foreach ($this->documents as $document) {
                try {
                    // Retrieve user details
                    $userId = auth::user()->id;
                    $username = auth::user()->name;

                    // Construct the new file name
                    $originalName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $document->getClientOriginalExtension();
                    $newFileName = "{$originalName}_{$userId}_{$username}.{$extension}";

                    // Log file details for debugging
                    Log::info('Uploading Document', [
                        'original_name' => $document->getClientOriginalName(),
                        'name' => $newFileName,
                        'mime_type' => $document->getMimeType(),
                        'size' => $document->getSize()
                    ]);

                    // Store the file
                    // $path = $document->store('documents', 'public');
                    $path = $document->storeAs('documents', $newFileName, 'public');

                    $uploadedFiles[] = $path;
                } catch (\Exception $e) {
                    Log::error('File Upload Error', [
                        'error' => $e->getMessage(),
                        'file' => $document->getClientOriginalName()
                    ]);
                }
            }
        }
        return $uploadedFiles;
    }

    // Form submission method
    public function submit()
    {
        // Validate input
        $validatedData = $this->validate();

        try {
            // Log submission details for debugging
            Log::info('Service Request Submission', [
                'user_id' => Auth::id(),
                'service_id' => $this->service_id,
                'notes' => $this->notes,
                'documents_count' => count($this->documents)
            ]);

            // Create new service request
            $serviceRequest = new ServiceRequestModel();
            $serviceRequest->service_id = $this->service_id;
            $serviceRequest->user_id = Auth::id();
            $serviceRequest->notes = $this->notes;
            $serviceRequest->status = 'pending';
            $serviceRequest->price = 0.00;
            $serviceRequest->expiry_date = Carbon::now()->addDays(30);

            // Handle file uploads
            $uploadedFiles = $this->handleFileUploads();
            $serviceRequest->documents = $uploadedFiles;

            // Save the service request

            $serviceRequest->save();

            // Reset form fields
            $this->reset(['service_id', 'documents', 'notes']);

            // Flash success message
            session()->flash('success', 'Service request submitted successfully.');
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error('Service Request Submission Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Flash error message
            session()->flash('error', 'An error occurred while submitting your request. Please try again.');
        }
    }

    // Render method
    public function render()
    {
        return view('livewire.pages.service-request')->layout('layouts.volt');
    }
}
