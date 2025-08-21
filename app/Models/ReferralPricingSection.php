<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralPricingSection extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items()
    {
        // return $this->hasMany(ReferralPricingSectionItem::class);
        return $this->hasMany(ReferralPricingSectionItem::class, 'pricing_section_id');

    }
}
