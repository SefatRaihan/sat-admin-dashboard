<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsWhySection extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'cta_text', 'cta_link'];

    public function items()
    {
        return $this->hasMany(AboutUsWhySectionItem::class);
    }
}
