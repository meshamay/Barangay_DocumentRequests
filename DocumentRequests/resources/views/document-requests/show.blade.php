@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Document Request Details</h1>
            <a href="{{ route('document-requests.index') }}" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Back
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 text-sm font-semibold mb-1">Transaction ID</label>
                <p class="text-gray-800 text-lg">{{ $documentRequest->transaction_id }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm font-semibold mb-1">Status</label>
                <span class="inline-block px-3 py-1 rounded-full text-white text-sm font-semibold
                    @if($documentRequest->status === 'pending') bg-yellow-500
                    @elseif($documentRequest->status === 'approved') bg-blue-500
                    @elseif($documentRequest->status === 'completed') bg-green-500
                    @elseif($documentRequest->status === 'rejected') bg-red-500
                    @endif">
                    {{ ucfirst($documentRequest->status) }}
                </span>
            </div>

            <div>
                <label class="block text-gray-600 text-sm font-semibold mb-1">Last Name</label>
                <p class="text-gray-800">{{ $documentRequest->last_name }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm font-semibold mb-1">First Name</label>
                <p class="text-gray-800">{{ $documentRequest->first_name }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 text-sm font-semibold mb-1">Document Type</label>
                <p class="text-gray-800">{{ $documentRequest->document_type }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-600 text-sm font-semibold mb-1">Date Requested</label>
                <p class="text-gray-800">{{ $documentRequest->date_requested->format('M d, Y H:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
