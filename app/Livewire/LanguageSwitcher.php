<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public function switchLanguage($locale)
    {
        // Validate the locale
        if (in_array($locale, ['en', 'ar'])) {
            session(['locale' => $locale]); // Store the locale in the session
            app()->setLocale($locale); // Set the application locale
        }

        return redirect()->back(); // Redirect back to the previous page
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
