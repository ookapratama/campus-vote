<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilrekCandidate extends Model
{
    protected $fillable = [
        'name',
        'title',
        'position',
        'photo',
        'bio',
        'vision',
        'mission',
        'education',
        'experience',
        'order',
        'is_active',
        'is_top_three',
    ];

    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'is_active' => 'boolean',
        'is_top_three' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeTopThree($query)
    {
        return $query->where('is_top_three', true)->orderBy('order');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->photo)) {
            return '/storage/' . $this->photo;
        }
        return asset('assets/img/avatars/1.png'); // Fallback to existing avatar
    }
}
