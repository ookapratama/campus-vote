<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilrekCandidate;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class PilrekCandidateController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService) {}

    public function index()
    {
        $data = PilrekCandidate::orderBy('order')->get();
        return view('pages.admin.pilrek-candidate.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.pilrek-candidate.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('photo')) {
            $media = $this->fileUploadService->upload($request->file('photo'), 'pilrek/candidates', 'public', [
                'width' => 500, 'height' => 600, 'crop' => true
            ]);
            $validated['photo'] = $media->path;
        }

        PilrekCandidate::create($validated);
        return redirect()->route('admin.pilrek-candidate.index')
            ->with('success', 'Bakal calon berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PilrekCandidate::findOrFail($id);
        return view('pages.admin.pilrek-candidate.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $candidate = PilrekCandidate::findOrFail($id);

        if ($request->hasFile('photo')) {
            $media = $this->fileUploadService->upload($request->file('photo'), 'pilrek/candidates', 'public', [
                'width' => 500, 'height' => 600, 'crop' => true
            ]);
            $validated['photo'] = $media->path;
        }

        $candidate->update($validated);
        return redirect()->route('admin.pilrek-candidate.index')
            ->with('success', 'Bakal calon berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PilrekCandidate::findOrFail($id)->delete();
        if (request()->wantsJson()) {
            return \App\Helpers\ResponseHelper::success(null, 'Bakal calon berhasil dihapus!');
        }
        return redirect()->route('admin.pilrek-candidate.index')
            ->with('success', 'Bakal calon berhasil dihapus!');
    }
}
