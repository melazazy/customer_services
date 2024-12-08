@extends('layouts.app')

@section('title', 'Request #' . $request->id)

@push('styles')
<style>
    /* Header Styles */
    .s-header {
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 1rem 0;
    }

    .header__wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navigation {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav__menu {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .menu__link {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .menu__link:hover {
        color: #E53935;
    }

    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        padding: 0.5rem;
        min-width: 200px;
        z-index: 50;
    }

    .dropdown-item {
        display: block;
        padding: 0.5rem 1rem;
        color: #1a1a1a;
        text-decoration: none;
        transition: background 0.3s;
    }

    .dropdown-item:hover {
        background: #f5f5f5;
    }

    /* Service Card Styles */
    .service-card {
        padding-top: 5rem;
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        margin: 2rem auto;
        max-width: 1200px;
        display: flex;
        gap: 2rem;
    }

    .service-image {
        width: 50%;
        height: 500px;
        object-fit: cover;
    }

    .service-content {
        width: 50%;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .service-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .service-status {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .status-active {
        background-color: #E8F5E9;
        color: #2E7D32;
    }

    .service-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .service-actions {
        display: flex;
        gap: 1rem;
    }

    .btn {
        flex: 1;
        padding: 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: #E53935;
        color: white;
    }

    .btn-primary:hover {
        background-color: #C62828;
    }

    @media (max-width: 768px) {
        .service-card {
            flex-direction: column;
        }

        .service-image,
        .service-content {
            width: 100%;
        }

        .service-image {
            height: 300px;
        }

        .service-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="s-header">
        <div class="container mx-auto px-4">
            <div class="header__wrapper">
                <div class="brand-logo">
                    <a href="/" class="block" style="background-image: url({{ asset('assets/goldenspeed/logo.png') }}); width: 150px; height: 50px; background-position: right; background-size: contain; background-repeat: no-repeat;">
                        <span class="sr-only">{{ __('messages.welcome') }}</span>
                    </a>
                </div>

                <nav class="navigation">
                    <!-- [Same navigation code as in service page] -->
                </nav>
            </div>
        </div>
    </header>
        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8 !important">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold">Request #{{ $request->id }}</h1>
                    <div class="service-status {{ $this->getStatusColor() === 'active' ? 'status-active' : 'status-inactive' }}">
                        <i class="fas fa-circle text-{{ $this->getStatusColor() }}-500 text-xs animate-pulse"></i>
                        {{ ucfirst($request->status) }}
                    </div>
                </div>

                @if($request->service->image_url)
                    <img src="{{ asset('storage/services/images/' . $request->service->image_url) }}"
                         alt="{{ $request->service->name }}"
                         class="w-full h-64 object-cover rounded-t-lg">
                @endif

                <div class="p-4">
                    <p class="text-gray-700 mb-4">
                        {{ $request->description ?? 'No description provided' }}
                    </p>

                    <div class="flex justify-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Back to Dashboard
                        </a>

                        @if(Auth::user()->is_admin)
                            <button wire:click="updateStatus" class="btn btn-primary">
                                <i class="fas fa-sync"></i>
                                Update Status
                            </button>
                        @endif
                    </div>
                </div>

                <div class="mt-6 bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-primary-red"></i>
                        Request Information
                    </h2>
                    <div class="grid gap-4">
                        <div class="detail-item">
                            <div class="text-sm font-medium text-gray-500">Service Name</div>
                            <div class="text-gray-900 mt-1">{{ $request->service->name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="text-sm font-medium text-gray-500">Price</div>
                            <div class="text-gray-900 mt-1 font-semibold">{{ $request->price ?? 'Not specified' }} EGP</div>
                        </div>
                        <div class="detail-item">
                            <div class="text-sm font-medium text-gray-500">Created At</div>
                            <div class="text-gray-900 mt-1">{{ $request->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-file text-primary-red"></i>
                        Uploaded Documents
                    </h2>
                    @if($request->documents && count($request->documents) > 0)
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($request->documents as $document)
                                <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
                                    <span>{{ basename($document) }}</span>
                                    <a href="{{ Storage::url($document) }}" download class="text-primary-red hover:underline">
                                        Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No documents uploaded.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer (unchanged) -->
        <footer class="s-footer">
            <div class="container">
                <div class="footer__wrap">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.rights') }}</p>
                </div>
            </div>
        </footer>
    </div>
    @endsection
