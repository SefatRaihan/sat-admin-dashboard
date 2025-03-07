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
        'uuid',          // ✅ Ensure this is auto-generated in the controller
        'title',         // ✅ This is correct
        'description',   // ✅ Nullable field
        'scheduled_at',  // ✅ Make sure this exists in the migration
        'duration',      // ✅ Make sure this exists in the migration
        'created_by',    // ✅ Foreign key reference
        'updated_by',    // ✅ Foreign key reference
        'deleted_by',    // ✅ Add this since it exists in migration (important for soft deletes)
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
}
