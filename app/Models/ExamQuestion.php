<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exam_questions';

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

    protected $casts = [
        'options' => 'array',
        'tags' => 'array',
        'images' => 'array',
        'videos' => 'array',
    ];

    /**
     * Get the sections associated with this question.
     */
    public function sections()
    {
        return $this->belongsToMany(
            ExamSection::class,
            'section_question_pivot',
            'question_id',
            'section_id'
        );
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
     * Scope a query to filter questions by difficulty.
     */
    public function scopeDifficulty($query, $level)
    {
        $validLevels = ['Easy', 'Medium', 'Hard', 'Very Hard'];
        if (!in_array($level, $validLevels)) {
            return $query;
        }
        return $query->where('difficulty', $level);
    }

    /**
     * Scope a query to only include active questions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive questions.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
