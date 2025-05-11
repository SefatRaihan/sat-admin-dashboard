<?php

namespace App\Models;

use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory, SoftDeletes, Historiable, UserTrackable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_time_gaps' => 'boolean',
        'retake_cooldown' => 'integer',
        'total_questions' => 'integer',
        'total_duration' => 'integer',
    ];

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
        return $this->hasMany(ExamSection::class);
    }

    /**
     * Many-to-Many Relationship: Get all questions associated with this exam.
     */
    public function questions()
    {
        return $this->belongsToMany(ExamQuestion::class, 'exam_question_pivot', 'exam_id', 'question_id');
    }

    /**
     * Scope a query to only include published exams.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getFormattedDurationAttribute(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        $parts = [];
        if ($hours) $parts[] = "{$hours}hr";
        if ($minutes) $parts[] = "{$minutes}min";

        return implode(' ', $parts);
    }

    public function userAttempt()
    {
        return $this->hasOne(ExamAttempt::class)->where('user_id', auth()->id());
    }
}
