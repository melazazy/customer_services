<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use App\Models\ServiceRequest;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StateUpdate extends Component
{
    use WithFileUploads;

    public $request;
    public $status;
    public $price;
    public $priceOfferDocument;
    public $priceOfferDocuments;
    public $legacyDocuments;

    public function mount($id)
    {
        $this->request = ServiceRequest::with(['service', 'user', 'documents'])->findOrFail($id);

        if (!Auth::user()->is_admin && Auth::id() !== $this->request->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $this->status = $this->request->status;
        $this->price = $this->request->price;
        // dd($this->request);
        $this->loadDocuments();
    }

    public function loadDocuments()
    {
        // Load documents from the documents table
        $this->priceOfferDocuments = $this->request->documents()->latest()->get();

        // Load legacy documents from the JSON column
        $this->legacyDocuments = collect($this->request->documents ?? [])->map(function ($doc) {
            return [
                'name' => $doc['name'] ?? 'Unknown',
                'path' => $doc['path'] ?? '',
                'type' => $doc['type'] ?? 'document',
                'uploaded_at' => $doc['uploaded_at'] ?? now()->toDateTimeString()
            ];
        })->toArray();
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required|in:pending,active,in_progress,completed,cancelled',
        ]);

        $this->request->status = $this->status;

        if ($this->request->save()) {
            session()->flash('message', 'Request status updated successfully.');
        } else {
            session()->flash('error', 'Failed to update request status.');
        }
    }
    public function updateRequest()
    {

        $this->validate([
            'status' => 'required|in:pending,active,in_progress,completed,cancelled',
            'price' => 'nullable|numeric|min:0'
        ]);

        try {
            $this->request->status = $this->status;
            $this->request->price = $this->price;

            // dd($this->request);
            if ($this->request->save()) {
                Log::info('Request Updated', [
                    'request_id' => $this->request->id,
                    'new_status' => $this->status,
                    'new_price' => $this->price
                ]);

                session()->flash('message', 'Request updated successfully.');
            } else {
                throw new \Exception('Failed to save request');
            }
        } catch (\Exception $e) {
            Log::error('Request Update Error: ' . $e->getMessage());
            session()->flash('error', 'Error updating request: ' . $e->getMessage());
        }
    }
    public function uploadPriceOffer()
    {
        $this->validate([
            'priceOfferDocument' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
        ]);

        try {
            if (!$this->priceOfferDocument) {
                throw new \Exception('No file uploaded');
            }

            $file = $this->priceOfferDocument;
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');
            // dd($this->request);
            $document = Document::create([
                'user_id' => Auth::id(),
                'service_id' => $this->request->service_id,
                'request_id' => $this->request->id,
                'file_url' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);

            Log::info('Document Uploaded', [
                'request_id' => $this->request->id,
                'document_id' => $document->id,
                'file_name' => $filename
            ]);

            $this->priceOfferDocument = null;
            $this->loadDocuments();
            session()->flash('message', 'Document uploaded successfully.');
        } catch (\Exception $e) {
            Log::error('Document Upload Error: ' . $e->getMessage());
            session()->flash('error', 'Error uploading document: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.state-update')->layout('layouts.volt');
    }
}
