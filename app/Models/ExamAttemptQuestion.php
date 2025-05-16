<?php

namespace App\Models;

use App\Traits\Historiable;
use Illuminate\Support\Str;
use App\Traits\UserTrackable;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExamAttemptQuestion extends Model
{
    use HasFactory, SoftDeletes, Historiable;

    protected $table = 'exam_attempt_questions';


    protected $guarded = [
        // 'id',
        // 'uuid',
        // 'attempt_id',
        // 'question_id',
        // 'student_answer',
        // 'is_correct',
        // 'time_spent',
        // 'image_urls',
        // 'video_urls',
        // 'created_at',
        // 'updated_at'
    ];

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
        return $this->belongsTo(ExamAttempt::class, 'attempt_id');
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

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->uuid)) {
    //             $model->uuid = (string) Str::uuid();
    //         }
    //     });
    // }

    /**
     * Log answer submission details.
     */
    public function logSubmission(): void
    {
        Log::info('Exam attempt question submitted', [
            'attempt_id' => $this->attempt_id,
            'question_id' => $this->question_id,
            'is_correct' => $this->is_correct,
        ]);
    }
}