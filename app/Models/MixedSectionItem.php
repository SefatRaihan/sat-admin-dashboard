<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MixedSectionItem extends Model
{
    protected $fillable = ['image', 'title', 'mixed_section_id'];

    // Define the inverse relationship with mixed_sections
    public function section()
    {
        return $this->belongsTo(MixedSection::class);
    }
}
