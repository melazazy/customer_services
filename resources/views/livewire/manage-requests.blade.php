<div class="">
    @if (!Auth::user()->is_admin)
        <a href="{{ route('request.service') }}" class="btn btn-primary btn-lg rounded-pill shadow">Request
            Service</a>
    @endif
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">Manage Service Requests</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                @if (Auth::user()->is_admin)
                                    <th class="border-0 rounded-start" style="width: 15%;">User</th>
                                @endif
                                <th class="border-0" style="width: 15%;">Service</th>
                                <th class="border-0" style="width: 10%;">Status</th>
                                <th class="border-0" style="width: 20%;">Notes</th>
                                <th class="border-0" style="width: 20%;">Documents</th>
                                <th class="border-0" style="width: 10%;">Price</th>
                                <th class="border-0" style="width: 10%;">Expiry Date</th>
                                <th class="border-0 rounded-end" style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr class="hover:bg-gray-100">
                                    @if (Auth::user()->is_admin)
                                        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                            {{ $request->user->name }}</td>
                                    @endif
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->service->name }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ ucfirst($request->status) }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->notes }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        @if (is_array($request->documents))
                                            {{ implode(', ', $request->documents) }}
                                        @else
                                            No documents
                                        @endif
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->price }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->expiry_date->format('Y-m-d') }}</td>
                                    <td>

                                        @if (Auth::user()->is_admin)
                                            <button class="btn btn-sm btn-success"
                                                wire:click="edit({{ $request->id }})">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="delete({{ $request->id }})">Delete</button>
                                        @else
                                            {{-- <button class="btn btn-sm btn-warning" --}}
                                            <button class="btn btn-sm" style="background-color: #ff6b5b"
                                                wire:click="edit({{ $request->id }})">Show</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Request</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        @if (Auth::user()->is_admin)
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" wire:model="editRequest.status" class="form-control">
                                    <option value="pending">pending</option>
                                    <option value="in_progress">in_progress</option>
                                    <option value="complated">complated</option>
                                </select>
                            </div>

                            <!-- Notes -->
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea id="notes" wire:model="editRequest.notes" class="form-control">{{ $editRequest['notes'] ?? '' }}</textarea>
                            </div>

                            <!-- Expiry Date -->
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="date" id="expiry_date" wire:model="editRequest.expiry_date"
                                    class="form-control" value="{{ $editRequest['expiry_date'] ?? '' }}">
                            </div>
                        @endif

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" wire:model="editRequest.price" class="form-control"
                                value="{{ $editRequest['price'] ?? '' }}">
                        </div>

                        <!-- Documents -->
                        <div class="form-group">
                            <label for="documents">Documents</label>
                            @if (isset($editRequest['documents']) && is_array($editRequest['documents']))
                                <ul class="list-group mb-2">
                                    @foreach ($editRequest['documents'] as $index => $document)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                wire:model="editRequest.documents.{{ $index }}"
                                                class="form-control" value="{{ $document }}">
                                            <button type="button" class="btn btn-danger btn-sm ml-2"
                                                wire:click="removeDocument({{ $index }})">Remove</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="addDocument">Add
                                Document</button>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
