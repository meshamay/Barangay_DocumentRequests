<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentRequestController extends Controller
{
    /**
     * Display a listing of document requests for the authenticated user.
     */
    public function index(): View
    {
        $documentRequests = DocumentRequest::where('user_id', auth()->id())
            ->orderBy('date_requested', 'desc')
            ->paginate(10);

        return view('document-requests.index', compact('documentRequests'));
    }

    /**
     * Show the form for creating a new document request.
     */
    public function create(): View
    {
        return view('document-requests.create');
    }

    /**
     * Store a newly created document request in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'document_type' => 'required|string|max:255',
        ]);

        $transactionId = 'TXN-' . strtoupper(uniqid());

        DocumentRequest::create([
            'user_id' => auth()->id(),
            'transaction_id' => $transactionId,
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'document_type' => $validated['document_type'],
            'date_requested' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('document-requests.index')
            ->with('success', 'Document request submitted successfully!');
    }

    /**
     * Display the specified document request.
     */
    public function show(DocumentRequest $documentRequest): View
    {
        $this->authorize('view', $documentRequest);

        return view('document-requests.show', compact('documentRequest'));
    }
}
