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
    ];

    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && file_exists(public_path('storage/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        }
        return asset('assets/img/pilrek/default-candidate.png');
    }
}
