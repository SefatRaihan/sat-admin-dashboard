<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePricingSectionItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo(HomePricingSection::class, 'pricing_section_id');
    }
}
