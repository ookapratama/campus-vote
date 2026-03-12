<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PilrekAnnouncementRepositoryInterface;
use App\Models\PilrekAnnouncement;

class PilrekAnnouncementRepository implements PilrekAnnouncementRepositoryInterface
{
    public function all() { return PilrekAnnouncement::orderByDesc('is_pinned')->orderByDesc('published_at')->get(); }
    public function find($id) { return PilrekAnnouncement::findOrFail($id); }
    public function create(array $data) { return PilrekAnnouncement::create($data); }
    public function update($id, array $data) { $item = $this->find($id); $item->update($data); return $item; }
    public function delete($id) { return $this->find($id)->delete(); }
    public function findBySlug($slug) { return PilrekAnnouncement::where('slug', $slug)->where('is_published', true)->firstOrFail(); }
    
    public function getPublished($limit = null) 
    { 
        $query = PilrekAnnouncement::where('is_published', true)->orderByDesc('is_pinned')->orderByDesc('published_at');
        return $limit ? $query->take($limit)->get() : $query->get();
    }
}
