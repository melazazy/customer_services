<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public $serviceId = null;
    public $name = '';
    public $description = '';
    public $icon = '';
    public $image = null;
    public $status = 'active';
    public $existingImage = null;

    public function mount($id = null)
    {
        if ($id) {
            $this->serviceId = $id;
            $this->loadService($id);
        }
    }

    public function loadService($id)
    {
        $service = Service::findOrFail($id);

        $this->name = $service->name;
        $this->description = $service->description;
        $this->icon = $service->icon;
        $this->status = $service->status;
        $this->existingImage = $service->image_url;
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // Max 2MB
            'status' => 'required|in:active,inactive'
        ];

        // If it's a new service, make name unique
        if (!$this->serviceId) {
            $rules['name'] .= '|unique:services,name';
        } else {
            // If editing, make name unique except for current service
            $rules['name'] .= '|unique:services,name,' . $this->serviceId;
        }

        return $rules;
    }

    public function save()
    {
        // Validate all inputs
        $validatedData = $this->validate();

        // Prepare image upload
        $imageName = $this->existingImage;
        if ($this->image) {
            try {
                // Sanitize service name for filename
                $sanitizedName = Str::slug($this->name);

                // Generate unique filename
                $uniqueString = Str::random(10);
                $imageName = "{$sanitizedName}-{$uniqueString}." . $this->image->getClientOriginalExtension();

                // Store the file using Laravel's Storage facade
                $path = $this->image->storeAs(
                    'services/images',
                    $imageName,
                    'public'
                );

                // Delete old image if exists and we're updating
                if ($this->serviceId && $this->existingImage) {
                    Storage::disk('public')->delete('services/images/' . $this->existingImage);
                }

                Log::channel('stderr')->info('Image Storage Details', [
                    'original_name' => $this->image->getClientOriginalName(),
                    'stored_name' => $imageName,
                    'path' => $path,
                ]);
            } catch (\Exception $e) {
                Log::channel('stderr')->error('Image Upload Failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                session()->flash('error', 'Image upload failed: ' . $e->getMessage());
                return back();
            }
        }

        // Create or update service
        try {
            if ($this->serviceId) {
                // Update existing service
                $service = Service::findOrFail($this->serviceId);
                $service->update([
                    'name' => $this->name,
                    'description' => $this->description,
                    'icon' => $this->icon,
                    'image_url' => $imageName,
                    'status' => $this->status
                ]);
                $message = 'Service updated successfully.';
            } else {
                // Create new service
                $service = Service::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'icon' => $this->icon,
                    'image_url' => $imageName,
                    'status' => $this->status
                ]);
                $message = 'Service created successfully.';
            }

            Log::channel('stderr')->info('Service Saved', [
                'service_id' => $service->id,
                'image_name' => $imageName,
            ]);

            // Flash success message
            session()->flash('message', $message);

            // Reset form
            $this->reset();
            $this->image = null;

            return redirect()->route('create.service');
        } catch (\Exception $e) {
            Log::channel('stderr')->error('Service Save Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            session()->flash('error', 'Failed to save service: ' . $e->getMessage());
            return back();
        }
    }

    public function render()
    {
        return view('livewire.service-create')->layout('layouts.volt');
    }
}
