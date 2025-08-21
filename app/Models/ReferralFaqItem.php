<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralFaqItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faq()
    {
        return $this->belongsTo(ReferralFaq::class);
    }
}
