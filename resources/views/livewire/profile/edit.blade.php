<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h1>

        <form wire:submit="updateProfile" class="space-y-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input wire:model="phone" type="tel" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea wire:model="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red"></textarea>
                @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input wire:model="country" type="text" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('country') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-red hover:bg-secondary-red">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>