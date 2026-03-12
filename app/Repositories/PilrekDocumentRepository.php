<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PilrekDocumentRepositoryInterface;
use App\Models\PilrekDocument;

class PilrekDocumentRepository implements PilrekDocumentRepositoryInterface
{
    public function all() { return PilrekDocument::orderBy('order')->get(); }
    public function find($id) { return PilrekDocument::findOrFail($id); }
    public function create(array $data) { return PilrekDocument::create($data); }
    public function update($id, array $data) { $item = $this->find($id); $item->update($data); return $item; }
    public function delete($id) { return $this->find($id)->delete(); }
    public function getActive() { return PilrekDocument::where('is_active', true)->orderBy('order')->get(); }
}
