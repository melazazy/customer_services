<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationManager extends Component
{
    public $notifications;
    public $selectedNotification;
    public $showModal = false; // Add this property

    // public $showModal = false; // Modal visibility


    public function mount()
    {
        // $this->notifications = Notification::where('user_id', Auth::id())->get();
        $this->notifications = Notification::with(['user', 'service'])
        ->where('user_id', Auth::id())
        ->get()
        ->map(function ($notification) {
            // Assuming the notification has a request_id that relates to the ServiceRequest model
            $serviceRequest = ServiceRequest::find($notification->request_id); // Adjust this to your actual model

            // Get user and service information from the service request
            $user = $serviceRequest ? User::find($serviceRequest->user_id) : null;
            $service = $serviceRequest ? Service::find($serviceRequest->service_id) : null;

            return [
                'id' => $notification->id,
                'request_id' => $notification->request_id,
                'title' => $notification->title,
                'message' => $notification->message,
                'created_at' => $notification->created_at,
                'user' => $user ? $user : 'User not found',
                'service_name' => $service ? $service->name : 'Service not found',
            ];
        });
    }

    public function loadNotifications()
    {
        // Load notifications for the authenticated user
    }

    public function markAsRead($notificationId)
    {
        // Mark a notification as read
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            $this->loadNotifications(); // Refresh notifications
        }
    }
    public function delete($notificationId, $locale)
{
    app()->setLocale($locale);
    $notification = Notification::find($notificationId);
    if ($notification) {
        $notification->delete();
        session()->flash('message', 'Notification deleted successfully.');
        $this->mount(); // Refresh notifications after deletion
    } else {
        session()->flash('error', 'Notification not found.');
    }
}
public function show($notificationId, $locale)
{
    app()->setLocale($locale);
    $notification = Notification::with(['user', 'service'])->find($notificationId);
    if ($notification) {
        // dd($notification);
        // You can either emit an event or set a property to display the notification details in a modal
        $this->selectedNotification = $notification; // Assuming you have a property to hold the selected notification
        $this->showModal = true; // Set showModal to true

    } else {
        session()->flash('error', 'Notification not found.');
    }
}
public function closeModal()
    {
        $this->showModal = false;
        $this->selectedNotification = null;
    }
    public function render()
    {
        return view('livewire.notification-manager')->layout('layouts.volt');
    }
}
