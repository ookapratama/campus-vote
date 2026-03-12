<?php

namespace App\Interfaces\Repositories;

interface PilrekAnnouncementRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPublished($limit = null);
    public function findBySlug($slug);
}
