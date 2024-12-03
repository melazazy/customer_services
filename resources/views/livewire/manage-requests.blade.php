<div>
    <h1 class="text-2xl font-bold mb-4">Manage Service Requests</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">User</th>
                <th class="py-2">Service</th>
                <th class="py-2">Status</th>
                <th class="py-2">Notes</th>
                <th class="py-2">Documents</th>
                <th class="py-2">Price</th>
                <th class="py-2">Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td class="border px-4 py-2">{{ $request->user->name }}</td>
                    <td class="border px-4 py-2">{{ $request->service->name }}</td>
                    <td class="border px-4 py-2">{{ $request->status }}</td>
                    <td class="border px-4 py-2">{{ $request->notes }}</td>
                    <td class="border px-4 py-2">
                        @if(is_array($request->documents))
                            {{ implode(', ', $request->documents) }}
                        @else
                            No documents
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $request->price }}</td>
                    <td class="border px-4 py-2">{{ $request->expiry_date->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>