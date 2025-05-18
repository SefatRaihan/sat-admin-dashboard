<?php

namespace App\Models;



use Carbon\Carbon;
use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Support\Facades\DB;
use App\Models\ExamAttemptQuestion;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExamAttempt extends Model
{
    use HasFactory, SoftDeletes, Historiable;

    protected $table = 'exam_attempts';

    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'exam_id',
        'start_time',
        'end_time',
        'remaining_time',
        'status',
        'score',
        'attempt_number',
        'correct_answers',
        'wrong_answers',
        'answers',
        'metadata',
        'ip_address',
        'device_info',
        'cheating_detected',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'answers' => 'array',
        'metadata' => 'array',
        'cheating_detected' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }


    public function examAttemptQuestions()
    {
        return $this->hasMany(ExamAttemptQuestion::class, 'attempt_id');
    }

    /**
     * Accessor: Calculate total duration including extra time.
     */
    public function getTotalDurationAttribute()
    {
        if (!$this->start_time || !$this->end_time) {
            return null;
        }
        return $this->start_time->diffInSeconds($this->end_time) + ($this->remaining_time ?? 0);
    }

    /**
     * Scope: Active attempts (in_progress or paused)
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['in_progress', 'paused']);
    }

    /**
     * Scope: Completed attempts
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Auto-submit overdue attempts based on exam duration + extra time.
     */
    public static function autoSubmitOverdueAttempts()
    {
        $expiredAttempts = self::where('status', 'in_progress')
            ->whereRaw("TIMESTAMPDIFF(SECOND, start_time, NOW()) > remaining_time")
            ->get();

        foreach ($expiredAttempts as $attempt) {
            DB::transaction(function () use ($attempt) {
                $attempt->update(['status' => 'expired', 'end_time' => now()]);
                Log::info('Auto-submitted expired exam attempt', ['attempt_id' => $attempt->id]);
            });
        }
    }

    /**
     * Event listeners for logging
     */
    protected static function booted()
    {
        static::creating(function ($attempt) {
            Log::info('New exam attempt created', ['user_id' => $attempt->user_id, 'exam_id' => $attempt->exam_id]);
        });

        static::updating(function ($attempt) {
            Log::info('Exam attempt updated', ['attempt_id' => $attempt->id, 'status' => $attempt->status]);
        });

        static::deleting(function ($attempt) {
            Log::warning('Exam attempt deleted', ['attempt_id' => $attempt->id]);
        });
    }

}