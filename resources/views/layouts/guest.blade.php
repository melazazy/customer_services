<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link type="text/css" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body>
    <ul class="lang-switcher animate" data-animation="fadeInUpShort" data-duration="1900">
        {{-- <select onchange="window.location.href=this.value" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white"> --}}
            {{-- <div>
                <a href="locale/en" class="btn btn-primary">English</a>
                <a href="locale/ar" class="btn btn-primary">العربية</a>
            </div> --}}
        {{-- </select> --}}
        <select onchange="window.location.href=this.value" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white">
            <option value="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
        </select>
    </ul>
    {{ $slot }}

    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('js/volt.js') }}"></script>

    @livewireScripts
</body>
</html>
