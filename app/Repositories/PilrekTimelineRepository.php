<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PilrekTimelineRepositoryInterface;
use App\Models\PilrekTimeline;

class PilrekTimelineRepository implements PilrekTimelineRepositoryInterface
{
    public function all()
    {
        return PilrekTimeline::orderBy('phase_order')->orderBy('start_date')->get();
    }

    public function find($id)
    {
        return PilrekTimeline::findOrFail($id);
    }

    public function create(array $data)
    {
        return PilrekTimeline::create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function getGroupedByPhase()
    {
        return PilrekTimeline::where('is_active', true)
            ->orderBy('phase_order')
            ->orderBy('start_date')
            ->get()
            ->groupBy('phase_name');
    }
}
