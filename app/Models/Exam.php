<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

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
    protected $fillable = [
        'uuid',
        'name',
        'audience',
        'total_questions',
        'total_duration',
        'has_time_gaps',
        'retake_cooldown',
        'result_processing',
        'status',
        'created_by',
        'updated_by',
    ];

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
        return $this->hasMany(ExamSection::class, 'exam_id');
    }

    /**
     * Scope a query to only include published exams.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
