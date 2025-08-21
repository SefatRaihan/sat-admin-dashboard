<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralHowSectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_how_section_id',
        'image',
        'alt_text',
        'title',
        'description',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(ReferralHowSection::class, 'referral_how_section_id');
    }
}
