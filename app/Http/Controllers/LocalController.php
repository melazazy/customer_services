<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalController extends Controller
{
    public function setlocale($lang)
    {
        // Validate the locale
        if (in_array($lang, ['en', 'ar'])) {
            App::setLocale($lang); // Set the application locale
            Session::put(['locale', $lang]); // Store the locale in the session
        }

        return redirect()->back(); // Redirect back to the previous page
    }
}
