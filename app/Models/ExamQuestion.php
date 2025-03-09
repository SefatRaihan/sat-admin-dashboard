<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ExamQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exam_questions';

    protected $fillable = [
        'uuid',  // ✅ Added missing uuid
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
        'difficulty' => 'string',
        'status' => 'string',
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_pivot', 'question_id', 'exam_id');
    }

    public function sections()
    {
        return $this->belongsToMany(ExamSection::class, 'section_question_pivot', 'question_id', 'section_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeDifficulty($query, $level)
    {
        return $query->where('difficulty', $level);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Auto-generate UUID on creation
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            if (empty($question->uuid)) {
                $question->uuid = (string) Str::uuid();
            }
        });
    }
}
