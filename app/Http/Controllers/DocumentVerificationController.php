<?php

namespace App\Http\Controllers;

use App\Models\DocumentVerification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentVerificationController extends Controller
{
    public function index()
    {
        $documents = DocumentVerification::orderByDesc('created_at')->get();

        return Inertia::render('Admin/Documents/Index', [
            'documents' => $documents
        ]);
    }

    public function show(DocumentVerification $documentVerification)
    {
        return Inertia::render('Admin/Documents/Show', [
            'document' => $documentVerification
        ]);
    }

    public function update(Request $request, DocumentVerification $documentVerification)
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'remarks' => ['nullable', 'string']
        ]);

        $documentVerification->update($validated);

        return back()->with('success', 'Document status updated.');
    }
}
