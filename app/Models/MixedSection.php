<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MixedSection extends Model
{
    protected $fillable = [
        'title', 'tab_badge_label', 'subtitle', 'status', 'image', 
        'bullet_point_1', 'bullet_point_2', 'bullet_point_3'
    ];

    // Define the relationship with mixed_section_items
    public function items()
    {
        return $this->hasMany(MixedSectionItem::class);
    }
}
