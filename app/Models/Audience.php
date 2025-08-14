<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    protected $primaryKey = 'audience';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['audience'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'audience_student', 'audience', 'student_uuid', 'audience', 'uuid')
                    ->withTimestamps();
    }
}