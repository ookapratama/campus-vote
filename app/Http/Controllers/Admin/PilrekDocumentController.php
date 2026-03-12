<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilrekDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PilrekDocumentController extends Controller
{
    public function index()
    {
        $data = PilrekDocument::orderBy('order')->get();
        return view('pages.admin.pilrek-document.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.pilrek-document.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:10240',
            'category' => 'required|in:formulir,sk,peraturan,lainnya',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        PilrekDocument::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'category' => $validated['category'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pilrek-document.index')
            ->with('success', 'Dokumen berhasil diunggah!');
    }

    public function edit($id)
    {
        $data = PilrekDocument::findOrFail($id);
        return view('pages.admin.pilrek-document.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:10240',
            'category' => 'required|in:formulir,sk,peraturan,lainnya',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $document = PilrekDocument::findOrFail($id);
        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $file = $request->file('file');
            $updateData['file_path'] = $file->store('documents', 'public');
            $updateData['file_name'] = $file->getClientOriginalName();
            $updateData['file_type'] = $file->getClientOriginalExtension();
            $updateData['file_size'] = $file->getSize();
        }

        $document->update($updateData);
        return redirect()->route('admin.pilrek-document.index')
            ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $doc = PilrekDocument::findOrFail($id);
        if ($doc->file_path) {
            Storage::disk('public')->delete($doc->file_path);
        }
        $doc->delete();

        if (request()->wantsJson()) {
            return \App\Helpers\ResponseHelper::success(null, 'Dokumen berhasil dihapus!');
        }
        return redirect()->route('admin.pilrek-document.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
