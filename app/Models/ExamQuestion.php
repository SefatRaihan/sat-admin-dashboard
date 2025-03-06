<?php

namespace App\Models;
use Illuminate\Support\Str;

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
        'uuid',
        'question_text',
        'question_type',
        'options',
        'correct_answer',
        'difficulty',
        'tags',
        'explanation',
        'images',
        'videos',
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($question) {
            // Ensure question_type is one of the allowed types
            if (!in_array($question->question_type, ['MCQ', 'Fill-in-the-Blank', 'Paragraph'])) {
                throw new \InvalidArgumentException("Invalid question type: {$question->question_type}");
            }

            // Ensure difficulty level is valid
            if (!in_array($question->difficulty, ['Easy', 'Medium', 'Hard', 'Very Hard'])) {
                throw new \InvalidArgumentException("Invalid difficulty level: {$question->difficulty}");
            }
        });

        static::creating(function ($question) {
            if (empty($question->question_id)) {
                $question->question_id = (string) Str::uuid(); // ✅ Auto-generate question_id
            }
        });
    }

}
