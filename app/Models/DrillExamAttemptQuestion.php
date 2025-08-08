<?php

namespace App\Models;

use App\Models\DrillExamAttempt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DrillExamAttemptQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'drill_exam_attempt_questions';


    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'attempt_id' => 'integer',
        'question_id' => 'integer',
        'is_correct' => 'boolean',
        'time_spent' => 'integer',
        'image_urls' => 'array',
        'video_urls' => 'array',
    ];

    /**
     * Relationships
     */
    public function attempt()
    {
        return $this->belongsTo(DrillExamAttempt::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id');
    }

    /**
     * Scope a query to filter correct answers.
     */
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    /**
     * Scope a query to filter incorrect answers.
     */
    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }

    /**
     * Scope a query to filter answers by exam attempt.
     */
    public function scopeByAttempt($query, $attemptId)
    {
        return $query->where('attempt_id', $attemptId);
    }
}
