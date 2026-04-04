<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'badge_1',
        'badge_2',
        'heading_normal',
        'heading_highlight',
        'heading_emoji',
        'description',
        'btn_primary_text',
        'btn_primary_link',
        'btn_secondary_text',
        'btn_secondary_link',
        'image',
        'stat_1',
        'stat_2',
        'stat_3',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
