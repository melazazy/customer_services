<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ShowService extends Component
{
    public Service $service;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function getWhatsAppLink()
    {
        $message = "Hello, I'm interested in the {$this->service->name} service.";
        // Replace with your WhatsApp number
        $phoneNumber = "201011111111"; // Update this with your actual WhatsApp number
        return "https://wa.me/{$phoneNumber}?text=" . urlencode($message);
    }

    public function requestService()
    {
        return redirect()->route('request.service');
    }

    // #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.show-service')->layout('layouts.gold');;
    }
}
