<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ExamSection extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_sections';

    /**
     * The attributes that should be mass-assignable.
     */
    protected $fillable = [
        'uuid',
        'exam_id',
        'title',
        'description',
        'duration',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'duration' => 'integer',
    ];

    /**
     * Relationship: A section belongs to an exam.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    /**
     * Many-to-Many Relationship: Questions associated with this section.
     */
    public function questions()
    {
        return $this->belongsToMany(
            ExamQuestion::class,
            'section_question_pivot',
            'section_id',
            'question_id'
        );
    }

    /**
     * Auto-generate UUID on creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            if (empty($section->uuid)) {
                $section->uuid = (string) Str::uuid();
            }
        });
    }
}
