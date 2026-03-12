<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PilrekCandidateRepositoryInterface;
use App\Models\PilrekCandidate;

class PilrekCandidateRepository implements PilrekCandidateRepositoryInterface
{
    public function all() { return PilrekCandidate::orderBy('order')->get(); }
    public function find($id) { return PilrekCandidate::findOrFail($id); }
    public function create(array $data) { return PilrekCandidate::create($data); }
    public function update($id, array $data) { $item = $this->find($id); $item->update($data); return $item; }
    public function delete($id) { return $this->find($id)->delete(); }
    public function getActive() { return PilrekCandidate::where('is_active', true)->orderBy('order')->get(); }
}
