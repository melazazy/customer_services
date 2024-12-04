<div>
    <!-- Page Title -->
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Dashboard</h2>
            <p class="mb-0">Your creative services overview</p>
        </div>
    </div> --}}

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Dashboard</h1>
        @if (!Auth::user()->is_admin)
            <a href="{{ route('request.service') }}" class="btn btn-primary btn-lg rounded-pill shadow">Request
                Service</a>
        @endif
        @if (Auth::user()->is_admin)
            <!-- Admin Content -->
            <div class="admin-content">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Admin Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700">Total Services</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700">Active Requests</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active_requests'] }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700">Total Users</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700">Completed Requests</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_requests'] }}</p>
                    </div>
                </div>
            </div>
        @else
            <!-- User Content -->
            <div class="user-content">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-medium text-gray-700">Your Requests</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $userStats['your_requests'] }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Stats Row -->
    <div class="row">
        @if (Auth::user()->is_admin)
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Services</h2>
                                    <h3 class="fw-extrabold mb-1">{{ $stats['total_services'] }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Total Services</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $stats['total_services'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Active Requests</h2>
                                    <h3 class="fw-extrabold mb-1">{{ $stats['active_requests'] }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Active Requests</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $stats['active_requests'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Users</h2>
                                    <h3 class="fw-extrabold mb-1">{{ $stats['total_users'] }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Total Users</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $stats['total_users'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Completed Requests</h2>
                                    <h3 class="fw-extrabold mb-1">{{ $stats['completed_requests'] }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Completed Requests</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $stats['completed_requests'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Your Requests</h2>
                                    <h3 class="fw-extrabold mb-1">{{ $userStats['your_requests'] }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">Your Requests</h2>
                                    <h3 class="fw-extrabold mb-2">{{ $userStats['your_requests'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">


        <!-- Recent Services and Requests -->
        <div class="recent-section">
            @if (Auth::user()->is_admin)
                <div class="recent-services">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Services</h2>
                    <ul>
                        @foreach ($recentServices as $service)
                            <li>{{ $service->name }} - {{ $service->created_at->format('M d, Y') }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="recent-requests">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Requests</h2>
                    <ul>
                        @foreach ($recentRequests as $request)
                            <li>{{ $request->service->name }} by {{ $request->user->name }} -
                                {{ $request->created_at }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="recent-requests">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Recent Requests</h2>
                    <ul>
                        @foreach ($recentUserRequests as $request)
                            <li>{{ $request->service->name }} - {{ $request->created_at }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
