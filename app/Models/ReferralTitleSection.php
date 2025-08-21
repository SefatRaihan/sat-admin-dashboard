<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTitleSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'cta_text',
        'cta_link',
        'avater_1',
        'avater_2',
        'avater_3',
        'avater_subtitle',
        'whatsapp_link',
        'instagram_link',
        'tiktok_link',
        'youtube_link',
        'x_link',
        'facebook_link',
        'whatsapp_status',
        'instagram_status',
        'tiktok_status',
        'youtube_status',
        'x_status',
        'facebook_status',
    ];
}
