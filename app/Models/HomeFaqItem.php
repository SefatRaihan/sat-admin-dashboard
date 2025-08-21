<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFaqItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function faq()
    {
        return $this->belongsTo(HomeFaq::class);
    }
}
