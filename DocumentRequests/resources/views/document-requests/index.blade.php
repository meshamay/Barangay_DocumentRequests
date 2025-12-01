@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Document Requests</h1>
        <a href="{{ route('document-requests.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            New Request
        </a>
    </div>

    @if($documentRequests->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Transaction ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Last Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">First Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Document Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date Requested</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentRequests as $request)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $request->transaction_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $request->last_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $request->first_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $request->document_type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $request->date_requested->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                                    @if($request->status === 'pending') bg-yellow-500
                                    @elseif($request->status === 'approved') bg-blue-500
                                    @elseif($request->status === 'completed') bg-green-500
                                    @elseif($request->status === 'rejected') bg-red-500
                                    @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('document-requests.show', $request) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $documentRequests->links() }}
        </div>
    @else
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <p class="text-gray-600 mb-4">No document requests found.</p>
            <a href="{{ route('document-requests.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create First Request
            </a>
        </div>
    @endif
</div>
@endsection
