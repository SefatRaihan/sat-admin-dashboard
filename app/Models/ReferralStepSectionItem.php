<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralStepSectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_step_section_id',
        'icon',
        'image',
        'alt_text',
        'title',
        'description',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo(ReferralStepSection::class, 'referral_step_section_id');
    }
}