<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsWhySection extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'sub_title', 'x', 'x_status', 
        'email', 'email_status', 'phone_no', 'phone_no_status', 'cta_text'
    ];
}
