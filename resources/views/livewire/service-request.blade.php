<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Request a Service</h1>
    <form wire:submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label for="service" class="block text-gray-700 text-sm font-bold mb-2">Service Name</label>
            <select wire:model="selectedService" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Select a service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            @error('selectedService') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="documents" class="block text-gray-700 text-sm font-bold mb-2">Attach Documents</label>
            <input type="file" wire:model="documents" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('documents.*') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
            <textarea wire:model="notes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4"></textarea>
            @error('notes') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit Request
            </button>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mt-4 rounded">
            {{ session('message') }}
        </div>
    @endif
</div>