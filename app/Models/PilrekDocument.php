<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilrekDocument extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'category',
        'download_count',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'formulir' => 'Formulir',
            'sk' => 'Surat Keputusan',
            'peraturan' => 'Peraturan',
            'lainnya' => 'Lainnya',
            default => 'Lainnya',
        };
    }

    public function getFileIconAttribute(): string
    {
        return match ($this->file_type) {
            'pdf' => 'ri-file-pdf-2-line',
            'doc', 'docx' => 'ri-file-word-line',
            'xls', 'xlsx' => 'ri-file-excel-line',
            'zip', 'rar' => 'ri-file-zip-line',
            default => 'ri-file-line',
        };
    }
}
