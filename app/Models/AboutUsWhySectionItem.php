<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsWhySectionItem extends Model
{
    use HasFactory;
    protected $fillable = ['about_us_why_section_id', 'image', 'title', 'description', 'status'];

    public function section()
    {
        return $this->belongsTo(AboutUsWhySection::class, 'about_us_why_section_id');
    }
}
