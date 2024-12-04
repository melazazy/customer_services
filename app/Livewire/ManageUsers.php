<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageUsers extends Component
{
    public $users;
    public $showModal = false; // Modal visibility
    public $editUser; // User being edited

    public function mount()
    {
        $this->users = User::all();
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        if (Auth::user()->is_admin) {
            $this->editUser = $user->toArray();
            $this->showModal = true;
        } else {
            session()->flash('error', 'You are not authorized to edit this user.');
        }
    }

    public function save()
    {
        // Validate and save the changes
        $rules = [
            'editUser.name' => 'required|string|max:255',
            'editUser.email' => 'required|email|max:255',
        ];
        $this->validate($rules);
        User::find($this->editUser['id'])->update($this->editUser);
        $this->showModal = false;
        session()->flash('success', 'User updated successfully.');
    }
    public function delete($userId)
{
    $user = User::findOrFail($userId);
    if (Auth::user()->is_admin) {
        $user->delete();
        session()->flash('success', 'User deleted successfully.');
        $this->mount(); // Refresh the user list
    } else {
        session()->flash('error', 'You are not authorized to delete this user.');
    }
}

    public function render()
    {
        return view('livewire.manage-users')->layout('layouts.volt');
    }
}
