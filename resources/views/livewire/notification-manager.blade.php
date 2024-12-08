<div class="">
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">Notifications</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="border-0 rounded-start" style="width: 15%;">User Name</th>
                                <th class="border-0" style="width: 15%;">title</th>
                                <th class="border-0" style="width: 55%;">message</th>
                                <th class="border-0 rounded-end" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        {{-- @dd($notification['request_id']) --}}
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr class="hover:bg-gray-100">
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{-- <a href="{{ route('user.profile', ['id' => $notification['user']->id]) }}"> --}}
                                        {{ $notification['user']->name }}
                                        {{-- </a> --}}
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <a class="text-info fw-bolder font-monospace" href="{{ route('requests.show', ['id' => $notification['request_id']]) }}">
                                            {{ $notification['title'] }}
                                        </a>
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $notification['message'] }}
                                    </td>
                                    <td>
                                        <button wire:click="show({{ $notification['id'] }})"
                                            class="btn btn-sm btn-outline-info">Show</button>
                                        <button wire:click="delete({{ $notification['id'] }})"
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


    <!-- Notification Details Modal -->
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification Details</h5>
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($selectedNotification)
                        <p><strong>Title:</strong> {{ $selectedNotification->title }}</p>
                        <p><strong>Message:</strong> {{ $selectedNotification->message }}</p>
                        <p><strong>Request Page:</strong>
                            <a class="btn btn-primary" href="{{ route('requests.show', ['id' => $selectedNotification->request_id]) }}">
                                ID # {{ $selectedNotification->request_id }}
                            </a>
                        </p>
                        <p><strong>Created At:</strong> {{ $selectedNotification->created_at }}</p>
                    @else
                        <p>No notification details available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
