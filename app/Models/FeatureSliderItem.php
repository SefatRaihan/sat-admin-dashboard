<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSliderItem extends Model
{
    protected $fillable = ['feature_slider_id', 'image', 'title', 'description'];

    public function slider()
    {
        return $this->belongsTo(FeatureSlider::class);
    }
}
