<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExamAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exam_attempts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
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
    // Get current time
    $now = now();

    // Fetch overdue attempts where start_time + remaining_time < current time
    $expiredAttempts = self::where('status', 'in_progress')
        ->whereNotNull('start_time')
        ->whereNotNull('remaining_time')
        ->whereRaw('? >= DATE_ADD(start_time, INTERVAL remaining_time SECOND)', [$now])
        ->get();

    if ($expiredAttempts->isNotEmpty()) {
        DB::transaction(function () use ($expiredAttempts, $now) {
            foreach ($expiredAttempts as $attempt) {
                $attempt->update([
                    'status' => 'expired',
                    'end_time' => $now,
                ]);

                Log::info('Auto-submitted expired exam attempt', [
                    'attempt_id' => $attempt->id,
                    'user_id' => $attempt->user_id,
                    'exam_id' => $attempt->exam_id,
                    'expired_at' => $now,
                ]);
            }
        });

        Log::info('Auto-submitted overdue exam attempts', [
            'total_attempts' => $expiredAttempts->count()
        ]);
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
