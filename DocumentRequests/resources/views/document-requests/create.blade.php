@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">New Document Request</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('document-requests.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 font-semibold mb-2">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 font-semibold mb-2">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required>
            </div>

            <div class="mb-6">
                <label for="document_type" class="block text-gray-700 font-semibold mb-2">Document Type</label>
                <select id="document_type" name="document_type"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required>
                    <option value="">Select Document Type</option>
                    <option value="Birth Certificate" {{ old('document_type') === 'Birth Certificate' ? 'selected' : '' }}>Birth Certificate</option>
                    <option value="Marriage Certificate" {{ old('document_type') === 'Marriage Certificate' ? 'selected' : '' }}>Marriage Certificate</option>
                    <option value="Death Certificate" {{ old('document_type') === 'Death Certificate' ? 'selected' : '' }}>Death Certificate</option>
                    <option value="Barangay Clearance" {{ old('document_type') === 'Barangay Clearance' ? 'selected' : '' }}>Barangay Clearance</option>
                    <option value="Certificate of Residency" {{ old('document_type') === 'Certificate of Residency' ? 'selected' : '' }}>Certificate of Residency</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit Request
                </button>
                <a href="{{ route('document-requests.index') }}" class="flex-1 bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
