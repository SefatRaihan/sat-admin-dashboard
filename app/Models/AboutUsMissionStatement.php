<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsMissionStatement extends Model
{
    use HasFactory;
    protected $fillable = [
        'small_description',
        'large_description',
    ];
}
