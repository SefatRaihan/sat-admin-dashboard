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
     * Indicates that the primary key is not auto-incrementing.
     */
    public $incrementing = false;

    /**
     * Specifies the primary key type as a string (UUID).
     */
    protected $keyType = 'string';

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
        'id', 'exam_id', 'section_name', 'section_type', 'num_questions', 'duration'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'num_questions' => 'integer',
        'duration' => 'integer',
    ];

    /**
     * Boot function to generate a UUID before creating a new section.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            if (empty($section->id)) {
                $section->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationship: A section belongs to an exam.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    /**
     * Relationship: A section has many questions.
     */
    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'section_id');
    }
}
