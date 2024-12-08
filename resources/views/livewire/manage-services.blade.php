<div class="">
    <a href="{{ route('create.service') }}" class="btn btn-primary btn-lg rounded-pill shadow">Create
        Service</a>
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">Manage Services</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="border-0 rounded-start" style="width: 40%;">Name</th>
                                <th class="border-0" style="width: 40%;">Description</th>
                                <th class="border-0 rounded-end" style="width: 20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr class="hover:bg-gray-100">
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $service->name }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $service->description }}</td>
                                    <td>
                                        <a href="{{ route('services.edit', $service->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit

                                        </a>
                                        <button wire:click="delete({{ $service->id }})"
                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control"
                                wire:model.defer="editService.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" wire:model.defer="editService.description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
