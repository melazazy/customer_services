<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManageRequests extends Component
{
    public $requests;
    public $showModal = false; // Modal visibility
    public $editRequest; // Request being edited

    public function mount()
    {
        $this->requests = ServiceRequest::with(['user', 'service'])
            ->when(!Auth::user()->is_admin, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
    }

    public function edit($requestId)
    {
        // Check if the user is authorized to edit
        $request = ServiceRequest::findOrFail($requestId);
        if (Auth::user()->is_admin || $request->user_id == Auth::id()) {
            // Open modal or perform inline editing
            // $this->editRequest = $request;
            $this->editRequest = $request->toArray(); // Ensure it's an array for binding
            $this->editRequest['documents'] = $this->editRequest['documents'] ?? [];
            $this->showModal = true;
        } else {
            session()->flash('error', 'You are not authorized to edit this request.');
        }
    }

    public function save()
    {
        // Validate and save the changes
        // $this->validate([
        //     'editRequest.notes' => 'nullable|string|max:500',
        //     'editRequest.price' => 'nullable|numeric',
        //     'editRequest.expiry_date' => 'nullable|date',
        // ]);
        $rules = [
            'editRequest.price' => 'nullable|numeric',
            'editRequest.documents' => 'nullable|string|max:255',
        ];
        if (Auth::user()->is_admin) {
            $rules = array_merge($rules, [
                'editRequest.notes' => 'nullable|string|max:500',
                'editRequest.expiry_date' => 'nullable|date',
                'editRequest.service_id' => 'required|exists:services,id',
                'editRequest.status' => 'required|in:active,inactive',
            ]);
        }
        $this->validate($rules);
        $this->editRequest->save();
        $this->showModal = false; // Close the modal
        session()->flash('success', 'Request updated successfully.');
        $this->requests = ServiceRequest::with(['user', 'service'])->get(); // Refresh the list
    }

    public function delete($requestId)
    {
        try {
            $request = ServiceRequest::findOrFail($requestId);
            if (Auth::user()->is_admin || $request->user_id == Auth::id()) {
                $request->delete();
                session()->flash('success', 'Request deleted successfully.');
                $this->requests = ServiceRequest::with(['user', 'service'])->get(); // Refresh the list
            } else {
                session()->flash('error', 'You are not authorized to delete this request.');
            }
        } catch (\Exception $e) {
            Log::error('Request Deletion Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'An error occurred while deleting the request. Please try again.');
        }
    }
    public function addDocument()
    {
        $this->editRequest['documents'][] = '';
    }

    public function removeDocument($index)
    {
        unset($this->editRequest['documents'][$index]);
        $this->editRequest['documents'] = array_values($this->editRequest['documents']); // Re-index the array
    }
    public function render()
    {
        return view('livewire.manage-requests')->layout('layouts.volt');
    }
}
