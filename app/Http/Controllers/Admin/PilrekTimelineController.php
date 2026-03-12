<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilrekTimeline;
use Illuminate\Http\Request;

class PilrekTimelineController extends Controller
{
    public function index()
    {
        $data = PilrekTimeline::orderBy('phase_order')->orderBy('start_date')->get();
        return view('pages.admin.pilrek-timeline.index', compact('data'));
    }

    public function create()
    {
        $phases = PilrekTimeline::select('phase_name', 'phase_order')
            ->distinct()->orderBy('phase_order')->pluck('phase_name', 'phase_order');
        return view('pages.admin.pilrek-timeline.form', compact('phases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phase_name' => 'required|string|max:255',
            'phase_order' => 'required|integer|min:1',
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        PilrekTimeline::create($validated);

        return redirect()->route('admin.pilrek-timeline.index')
            ->with('success', 'Event timeline berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PilrekTimeline::findOrFail($id);
        $phases = PilrekTimeline::select('phase_name', 'phase_order')
            ->distinct()->orderBy('phase_order')->pluck('phase_name', 'phase_order');
        return view('pages.admin.pilrek-timeline.form', compact('data', 'phases'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'phase_name' => 'required|string|max:255',
            'phase_order' => 'required|integer|min:1',
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        PilrekTimeline::findOrFail($id)->update($validated);

        return redirect()->route('admin.pilrek-timeline.index')
            ->with('success', 'Event timeline berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PilrekTimeline::findOrFail($id)->delete();

        if (request()->wantsJson()) {
            return \App\Helpers\ResponseHelper::success(null, 'Event timeline berhasil dihapus!');
        }
        return redirect()->route('admin.pilrek-timeline.index')
            ->with('success', 'Event timeline berhasil dihapus!');
    }
}
