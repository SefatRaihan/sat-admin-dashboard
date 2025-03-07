<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_title',
        'question_description',
        'question_text',
        'question_type',
        'audience',
        'sat_type',
        'sat_question_type',
        'options',
        'correct_answer',
        'difficulty',
        'tags',
        'explanation',
        'images',
        'videos',
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
        'options' => 'array',
        'tags' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'difficulty' => 'string',
        'status' => 'string',
    ];

    /**
     * Many-to-Many Relationship: Exams associated with this question.
     */
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_pivot', 'question_id', 'exam_id');
    }

    /**
     * Many-to-Many Relationship: Sections associated with this question.
     */
    public function sections()
    {
        return $this->belongsToMany(ExamSection::class, 'section_question_pivot', 'question_id', 'section_id');
    }

    /**
     * Get the user who created the question.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the question.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope a query to only include questions of a certain difficulty.
     */
    public function scopeDifficulty($query, $level)
    {
        return $query->where('difficulty', $level);
    }

    /**
     * Scope a query to filter questions by status.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
