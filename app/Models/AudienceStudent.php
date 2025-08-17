<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudienceStudent extends Model
{
    protected $table = 'audience_student';

    protected $fillable = [
        'student_uuid',
        'audience',
    ];
}
