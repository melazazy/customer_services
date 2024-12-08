<div class="container mt-5">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-3 text-center text-gray-800">
                {{ $serviceId ? 'Edit Service' : 'Create Service' }}
            </h1>

            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form wire:submit.prevent="save" class="mt-4">
                <!-- Service Name -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label">Service Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="name-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.28a2 2 0 01-1.17 1.83l-3.83 1.92a2 2 0 00-1 1.75V16a1 1 0 01-1 1h-6a1 1 0 01-1-1v-1.42a2 2 0 00-1-1.75l-3.83-1.92A2 2 0 012 11.28V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input id="name" type="text" wire:model="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter service name"
                            required aria-describedby="nameError" maxlength="255">
                    </div>
                    @error('name')
                        <div id="nameError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group mb-4">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="description-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror"
                            rows="4" placeholder="Service description (Required)" required aria-describedby="descriptionError"
                            maxlength="1000"></textarea>
                    </div>
                    @error('description')
                        <div id="descriptionError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Icon -->
                {{-- <div class="form-group mb-4">
                    <label for="icon" class="form-label">Icon</label>
                    <div class="input-group">
                        <span class="input-group-text" id="icon-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <input id="icon" type="text" wire:model="icon"
                            class="form-control @error('icon') is-invalid @enderror"
                            placeholder="Enter icon class or URL" aria-describedby="iconError" maxlength="255">
                    </div>
                    @error('icon')
                        <div id="iconError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <!-- Image File -->
                <div class="form-group mb-4">
                    <label for="image" class="form-label">Service Image (Optional)</label>
                    <input
                        type="file"
                        id="image"
                        wire:model="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*"
                    >

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($existingImage)
                    <div class="mt-2">
                        <img
                            src="{{ Storage::url('services/images/' . $existingImage) }}"
                            alt="Existing Service Image"
                            class="img-thumbnail"
                            style="max-width: 200px;"
                        >
                    </div>
                @endif
                    @if ($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <!-- Status -->
                <div class="form-group mb-4">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="status-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <select id="status" wire:model="status"
                            class="form-control @error('status') is-invalid @enderror" required
                            aria-describedby="statusError">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <div id="statusError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    {{-- <button type="submit" class="btn btn-primary">
                        {{ $serviceId ? 'Update Service' : 'Create Service' }}
                    </button> --}}
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary"
                        :disabled="!isFormValid">
                        <span wire:loading.remove>
                            {{ $serviceId ? 'Update Service' : 'Create Service' }}
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Processing...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
