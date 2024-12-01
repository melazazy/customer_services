<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Service Management Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Service Management</h3>
                            <p class="text-gray-600 mb-4">Manage your services, add new ones, or edit existing services.</p>
                            <a href="{{ route('services.manage') }}" 
                               class="inline-block bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                                Manage Services
                            </a>
                        </div>

                        <!-- Service Requests Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Service Requests</h3>
                            <p class="text-gray-600 mb-4">View and manage customer service requests.</p>
                            <a href="{{ route('requests.index') }}" 
                               class="inline-block bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                                View Requests
                            </a>
                        </div>

                        <!-- Documents Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-semibold mb-4">Documents</h3>
                            <p class="text-gray-600 mb-4">Access and manage uploaded documents.</p>
                            <a href="{{ route('documents.index') }}" 
                               class="inline-block bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                                View Documents
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
