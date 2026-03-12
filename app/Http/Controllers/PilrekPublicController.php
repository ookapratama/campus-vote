<?php

namespace App\Http\Controllers;

use App\Services\PilrekService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PilrekPublicController extends Controller
{
    public function __construct(protected PilrekService $service) {}

    public function index()
    {
        $data = $this->service->getLandingData();
        return view('pages.pilrek.landing', $data);
    }

    public function showAnnouncement($slug)
    {
        $announcement = $this->service->findAnnouncementBySlug($slug);
        $recentAnnouncements = $this->service->getRecentAnnouncements($announcement->id);
            
        return view('pages.pilrek.announcement-detail', compact('announcement', 'recentAnnouncements'));
    }

    public function downloadDocument($id)
    {
        $document = $this->service->findDocument($id);
        if (!$document->is_active) abort(404);
        
        $document->increment('download_count');
        
        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    public function showCandidate($id)
    {
        $candidate = $this->service->findCandidate($id);
        if (!$candidate->is_active) abort(404);

        return view('pages.pilrek.candidate-detail', compact('candidate'));
    }
}
