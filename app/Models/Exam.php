<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exams';

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'scheduled_at',
        'duration',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Auto-generate UUID on creation.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($exam) {
            if (empty($exam->uuid)) {
                $exam->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the creator of the exam.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the sections associated with the exam.
     */
    public function sections()
    {
        return $this->hasMany(ExamSection::class, 'exam_id');
    }

    /**
     * Get all questions associated with this exam through sections.
     */
    public function questions()
    {
        return $this->hasManyThrough(
            ExamQuestion::class,
            ExamSection::class,
            'exam_id',                 // Foreign key on ExamSection table linking to Exam
            'id',                      // Primary key on ExamQuestions table
            'id',                      // Local key on Exams table
            'id'                       // Local key on ExamSections table
        )
        ->join('section_question_pivot', 'exam_questions.id', '=', 'section_question_pivot.question_id')
        ->select('exam_questions.*');
    }
}
