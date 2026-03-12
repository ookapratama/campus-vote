<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PilrekAnnouncement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'is_pinned',
        'is_published',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
            if (empty($model->published_at)) {
                $model->published_at = now();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at');
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'pengumuman' => 'Pengumuman',
            'berita' => 'Berita',
            'informasi' => 'Informasi',
            default => 'Lainnya',
        };
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'pengumuman' => 'danger',
            'berita' => 'primary',
            'informasi' => 'info',
            default => 'secondary',
        };
    }
}
