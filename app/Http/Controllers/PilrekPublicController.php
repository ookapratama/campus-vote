<?php

namespace App\Http\Controllers;

use App\Models\PilrekTimeline;
use App\Models\PilrekCandidate;
use App\Models\PilrekAnnouncement;
use App\Models\PilrekDocument;
use Illuminate\Http\Request;

class PilrekPublicController extends Controller
{
    /**
     * Landing page / home
     */
    public function index()
    {
        $timelineGroups = PilrekTimeline::where('is_active', true)
            ->orderBy('phase_order')
            ->orderBy('start_date')
            ->get()
            ->groupBy('phase_name');

        $announcements = PilrekAnnouncement::published()->take(6)->get();
        $candidates = PilrekCandidate::active()->get();
        $documents = PilrekDocument::active()->get();

        // Hitung progress
        $totalEvents = PilrekTimeline::where('is_active', true)->count();
        $completedEvents = PilrekTimeline::where('is_active', true)->get()
            ->filter(fn($t) => $t->computed_status === 'selesai')->count();
        $progress = $totalEvents > 0 ? round(($completedEvents / $totalEvents) * 100) : 0;

        return view('pages.pilrek.landing', compact(
            'timelineGroups',
            'announcements',
            'candidates',
            'documents',
            'progress',
            'totalEvents',
            'completedEvents'
        ));
    }

    /**
     * Detail pengumuman/berita
     */
    public function showAnnouncement($slug)
    {
        $announcement = PilrekAnnouncement::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $recentAnnouncements = PilrekAnnouncement::published()
            ->where('id', '!=', $announcement->id)
            ->take(5)
            ->get();

        return view('pages.pilrek.announcement-detail', compact('announcement', 'recentAnnouncements'));
    }

    /**
     * Download dokumen
     */
    public function downloadDocument($id)
    {
        $document = PilrekDocument::findOrFail($id);
        $document->increment('download_count');

        $filePath = storage_path('app/public/' . $document->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $document->file_name);
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
