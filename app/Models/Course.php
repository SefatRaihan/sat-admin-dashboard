<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $guarded = [];

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'course_chapter');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot(['is_completed', 'completed_at'])
                    ->withTimestamps();
    }
}
