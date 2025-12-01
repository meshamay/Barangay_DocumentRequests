<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentRequestController extends Controller
{
    /**
     * Display a listing of all document requests for admin.
     */
    public function index(Request $request): View
    {
        // simple admin guard
        if (! $request->user() || ! $request->user()->is_admin) {
            abort(403);
        }

        $documentRequests = DocumentRequest::orderBy('date_requested', 'desc')->paginate(20);

        return view('admin.document-requests.index', compact('documentRequests'));
    }
}
