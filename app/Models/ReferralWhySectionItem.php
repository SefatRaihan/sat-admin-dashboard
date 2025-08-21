<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralWhySectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_why_section_id',
        'image',
        'alt_text',
        'title',
        'description',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(ReferralWhySection::class, 'referral_why_section_id');
    }
}
