<?php

namespace App\Services;

use App\Interfaces\Repositories\PilrekTimelineRepositoryInterface;
use App\Interfaces\Repositories\PilrekCandidateRepositoryInterface;
use App\Interfaces\Repositories\PilrekAnnouncementRepositoryInterface;
use App\Interfaces\Repositories\PilrekDocumentRepositoryInterface;
use App\Models\PilrekTimeline;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PilrekService
{
    public function __construct(
        protected PilrekTimelineRepositoryInterface $timelineRepo,
        protected PilrekCandidateRepositoryInterface $candidateRepo,
        protected PilrekAnnouncementRepositoryInterface $announcementRepo,
        protected PilrekDocumentRepositoryInterface $documentRepo,
        protected FileUploadService $fileUploadService
    ) {}

    // --- Landing Data ---
    public function getLandingData()
    {
        $timelineGroups = $this->timelineRepo->getGroupedByPhase();
        $candidates = $this->candidateRepo->getActive();
        $announcements = $this->announcementRepo->getPublished(6);
        $documents = $this->documentRepo->getActive();

        $totalEvents = PilrekTimeline::where('is_active', true)->count();
        $completedEvents = PilrekTimeline::where('is_active', true)
            ->get()->filter(fn($e) => $e->computed_status === 'selesai')->count();
        
        $progress = $totalEvents > 0 ? round(($completedEvents / $totalEvents) * 100) : 0;

        return compact('timelineGroups', 'candidates', 'announcements', 'documents', 'totalEvents', 'completedEvents', 'progress');
    }

    // --- Universal CRUD Methods (Example for others) ---
    public function getAllTimeline() { return $this->timelineRepo->all(); }
    public function findTimeline($id) { return $this->timelineRepo->find($id); }
    public function createTimeline($data) { return $this->timelineRepo->create($data); }
    public function updateTimeline($id, $data) { return $this->timelineRepo->update($id, $data); }
    public function deleteTimeline($id) { return $this->timelineRepo->delete($id); }

    // --- Candidate Logic ---
    public function getAllCandidates() { return $this->candidateRepo->all(); }
    public function findCandidate($id) { return $this->candidateRepo->find($id); }
    public function createCandidate($data, $photoFile = null)
    {
        if ($photoFile) {
            $media = $this->fileUploadService->upload($photoFile, 'pilrek/candidates', 'public', ['width' => 500, 'height' => 600, 'crop' => true]);
            $data['photo'] = $media->path;
        }
        return $this->candidateRepo->create($data);
    }
    public function updateCandidate($id, $data, $photoFile = null)
    {
        if ($photoFile) {
            $media = $this->fileUploadService->upload($photoFile, 'pilrek/candidates', 'public', ['width' => 500, 'height' => 600, 'crop' => true]);
            $data['photo'] = $media->path;
        }
        return $this->candidateRepo->update($id, $data);
    }
    public function deleteCandidate($id) { return $this->candidateRepo->delete($id); }

    // --- Announcement Logic ---
    public function getAllAnnouncements() { return $this->announcementRepo->all(); }
    public function findAnnouncement($id) { return $this->announcementRepo->find($id); }
    public function findAnnouncementBySlug($slug) { return $this->announcementRepo->findBySlug($slug); }
    public function getRecentAnnouncements($excludeId) { 
        return $this->announcementRepo->getPublished(5)->where('id', '!=', $excludeId); 
    }
    public function createAnnouncement($data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->announcementRepo->create($data);
    }
    public function updateAnnouncement($id, $data) { return $this->announcementRepo->update($id, $data); }
    public function deleteAnnouncement($id) { return $this->announcementRepo->delete($id); }

    // --- Document Logic ---
    public function getAllDocuments() { return $this->documentRepo->all(); }
    public function findDocument($id) { return $this->documentRepo->find($id); }
    public function createDocument($data, $file)
    {
        if ($file) {
            $path = $file->store('documents', 'public');
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }
        return $this->documentRepo->create($data);
    }
    public function updateDocument($id, $data, $file = null)
    {
        $doc = $this->findDocument($id);
        if ($file) {
            if ($doc->file_path) Storage::disk('public')->delete($doc->file_path);
            $data['file_path'] = $file->store('documents', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }
        return $this->documentRepo->update($id, $data);
    }
    public function deleteDocument($id)
    {
        $doc = $this->findDocument($id);
        if ($doc->file_path) Storage::disk('public')->delete($doc->file_path);
        return $this->documentRepo->delete($id);
    }
}
