<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PilrekTimeline extends Model
{
    protected $fillable = [
        'phase_name',
        'phase_order',
        'event_name',
        'description',
        'start_date',
        'end_date',
        'status',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Auto-calculate status based on current date
     */
    public function getComputedStatusAttribute(): string
    {
        $now = Carbon::now()->startOfDay();
        $start = $this->start_date;
        $end = $this->end_date ?? $this->start_date;

        if ($now->gt($end)) {
            return 'selesai';
        } elseif ($now->gte($start) && $now->lte($end)) {
            return 'berlangsung';
        } else {
            return 'akan_datang';
        }
    }

    /**
     * Scope: group by phase
     */
    public function scopeGroupedByPhase($query)
    {
        return $query->where('is_active', true)
            ->orderBy('phase_order')
            ->orderBy('start_date')
            ->get()
            ->groupBy('phase_name');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->computed_status) {
            'selesai' => 'success',
            'berlangsung' => 'primary',
            'akan_datang' => 'secondary',
            default => 'secondary',
        };
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->computed_status) {
            'selesai' => 'Selesai',
            'berlangsung' => 'Berlangsung',
            'akan_datang' => 'Akan Datang',
            default => 'Belum Diketahui',
        };
    }
}
