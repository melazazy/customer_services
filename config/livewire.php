<?php

use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

return [
    /*
    |--------------------------------------------------------------------------
    | Asset URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to load Livewire's JavaScript assets. By default, it
    | is null, meaning it will load the JS assets from the relative path.
    |
    */
    'asset_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Middleware Group
    |--------------------------------------------------------------------------
    |
    | Livewire's "livewire.message" and "livewire.upload-file" routes will
    | be assigned to this middleware group. You can add your own middleware
    | or change the default middleware group.
    |
    */
    'middleware_group' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Base URL for Livewire Requests
    |--------------------------------------------------------------------------
    |
    | If your application uses route prefixes (e.g., localization prefixes),
    | set the base URL for Livewire requests here. This ensures that Livewire
    | works seamlessly with your application's routing configuration.
    |
    */
    'base_url' => '/livewire',

    /*
    |--------------------------------------------------------------------------
    | Livewire Temporary File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing temporary files. You can
    | configure the location of these temporary files and their lifespan.
    |
    */
    'temporary_file_upload' => [
        'disk' => env('FILESYSTEM_DRIVER', 'local'),
        'rules' => null,
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        'max_upload_time' => 5, // Minutes
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | The default namespace for your Livewire components.
    |
    */
    'class_namespace' => 'App\\Http\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | Component Auto-Discovery
    |--------------------------------------------------------------------------
    |
    | Livewire can auto-discover components in the specified namespace.
    |
    */
    'component_auto_discovery' => [
        'enabled' => true,
        'namespace' => 'App\\Http\\Livewire',
    ],

    /*
    |--------------------------------------------------------------------------
    | Eloquent Model Binding
    |--------------------------------------------------------------------------
    |
    | When binding Eloquent models, Livewire will use these settings to
    | serialize and deserialize models across requests.
    |
    */
    'model_binding' => [
        'serialize_with_guarded_keys' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire Layout
    |--------------------------------------------------------------------------
    |
    | Specify the layout file Livewire will use for components without their
    | own layouts. You can customize this to use your application's layout.
    |
    */
    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Render On Redirect
    |--------------------------------------------------------------------------
    |
    | By default, Livewire will re-render components on redirects. Set this
    | to false if you prefer to handle redirects manually.
    |
    */
    'render_on_redirect' => true,
];
