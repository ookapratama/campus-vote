<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilrekAnnouncement;
use App\Services\PilrekService;
use Illuminate\Http\Request;

class PilrekAnnouncementController extends Controller
{
    public function __construct(protected PilrekService $service) {}

    public function index()
    {
        $data = PilrekAnnouncement::orderByDesc('is_pinned')->orderByDesc('published_at')->get();
        return view('pages.admin.pilrek-announcement.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.pilrek-announcement.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|in:pengumuman,berita,informasi',
            'is_pinned' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_pinned'] = $request->boolean('is_pinned');
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();
        $validated['user_id'] = auth()->id();

        $this->service->createAnnouncement($validated);

        return redirect()->route('admin.pilrek-announcement.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PilrekAnnouncement::findOrFail($id);
        return view('pages.admin.pilrek-announcement.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|in:pengumuman,berita,informasi',
            'is_pinned' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_pinned'] = $request->boolean('is_pinned');
        $validated['is_published'] = $request->boolean('is_published');

        PilrekAnnouncement::findOrFail($id)->update($validated);

        return redirect()->route('admin.pilrek-announcement.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PilrekAnnouncement::findOrFail($id)->delete();
        if (request()->ajax() || request()->wantsJson()) {
            return \App\Helpers\ResponseHelper::success(null, 'Pengumuman berhasil dihapus!');
        }
        return redirect()->route('admin.pilrek-announcement.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}
