<div class="min-h-screen bg-gray-50">
    <!-- Main Content -->
    <div class="container mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">Request #{{ $request->id }}</h1>
                <div class="service-status flex items-center">
                    <i class="fas fa-circle text-info-500 text-xs animate-pulse mr-2"></i>
                    {{ ucfirst($request->status) }}
                </div>
            </div>

            <!-- Request Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">Request Information</h2>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <!-- Avatar -->
                            @if ($request->service->image_url)
                                <img class="rounded avatar-xl"
                                    src="{{ asset('storage/services/images/' . $request->service->image_url) }}"
                                    alt="{{ $request->service->name }}">
                            @else
                                <img class="rounded avatar-xl" src="../assets/img/profile-cover.jpg"
                                    alt="default cover">
                            @endif

                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <div class="d-flex">
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1">{{ $request->service->name }}</div>
                                        <div class="text-gray small"> {{ $request->price ?? 'Not specified' }} $
                                        </div>
                                        <div class="text-gray small">
                                            {{ $request->created_at ? $request->created_at->format('Y-m-d H:i:s') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <div class="d-flex">
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1"> Uploaded Documents</div>
                                        @if ($request->documents && count($request->documents) > 0)
                                            <div class="text-gray small">
                                                @foreach ($request->documents as $document)
                                                    <div>
                                                        <span>{{ basename($document) }}</span>

                                                        <a href="{{ url(asset('/storage/' . $document)) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-download bg-blue-500 text-info px-3 py-1 rounded hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-download mr-1"></i>
                                                            Download
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500 italic"></p>
                                            <div class="text-gray small">No documents uploaded.</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forms Section -->
            <div class="d-flex grid grid-cols-1 gap-6 h-[25vh] overflow-y-auto">
                <!-- Update Request Form -->
                <div class="card card-body border-0 shadow">
                    <h3 class="h5 mb-4">Update Request</h3>
                    <form wire:submit.prevent="updateRequest" class="space-y-4">
                        <!-- Status Update -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model.live="status"
                                class="form-control w-full p-2 border border-gray-300 rounded">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price Update -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price $: </label>
                            <input type="number" wire:model.live="price" id="price" step="0.01" min="0"
                                class="form-control w-full p-2 pl-7 border border-gray-300 rounded"
                                placeholder="Enter price">
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-full relative">
                            <span wire:loading.remove wire:target="updateRequest">
                                Update Request
                            </span>
                            <span wire:loading wire:target="updateRequest">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                Updating...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Upload Price Offer Form -->
                <!-- Display Flash Messages -->

                <div class="card card-body border-0 shadow">
                    <h3 class="h5 mb-4">Upload Price Offer</h3>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session('message') }}
                        </div>
                    @endif
                    {{-- <form wire:submit.prevent="uploadPriceOffer" class="space-y-4">
                        <div>
                            <label for="priceOfferDocument" class="block text-sm font-medium text-gray-700 mb-1">Price
                                Offer Document</label>
                            <div class="d-flex align-items-center">
                                <div class="file-field">
                                    <div class="d-flex justify-content-xl-center ms-xl-3">
                                        <div class="d-flex">

                                            <input type="file" wire:model="priceOfferDocument"
                                                id="priceOfferDocument"
                                                class="form-control w-full p-2 border border-gray-300 rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('priceOfferDocument')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-full relative">
                            <span wire:loading.remove wire:target="uploadPriceOffer">
                                Upload Document
                            </span>
                            <span wire:loading wire:target="uploadPriceOffer">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                Uploading...
                            </span>
                        </button>
                    </form> --}}
                    <form wire:submit.prevent="uploadPriceOffer" class="space-y-4">
                        <div>
                            <input type="file" wire:model="priceOfferDocument" class="form-control"
                                accept=".pdf,.doc,.docx">
                            <div wire:loading wire:target="priceOfferDocument">
                                <span class="text-sm text-gray-500">Uploading...</span>
                            </div>
                            @error('priceOfferDocument')
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled"
                            wire:target="uploadPriceOffer">
                            <span wire:loading.remove wire:target="uploadPriceOffer">
                                <i class="fas fa-upload mr-1"></i>
                                Upload Document
                            </span>
                            <span wire:loading wire:target="uploadPriceOffer">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                Uploading...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
