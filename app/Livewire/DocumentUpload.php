<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentUpload extends Component
{
    use WithFileUploads;

    public $document;
    public $service_id;
    public $request_id;

    public function mount($service_id, $request_id)
    {
        $this->service_id = $service_id;
        $this->request_id = $request_id;
    }

    public function uploadDocument()
    {
        $this->validate([
            'document' => 'required|file|max:10240', // 10MB max
        ]);

        $document = new Document([
            'user_id' => auth()->id(),
            'service_id' => $this->service_id,
            'request_id' => $this->request_id,
        ]);
        $document->save();
        
        $document->uploadDocument($this->document);

        $this->reset('document');
        $this->dispatch('document-uploaded');
    }

    public function render()
    {
        return view('livewire.document-upload');
    }
}