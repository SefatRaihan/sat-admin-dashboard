<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'exam_attempt_id',
        'question_id',
        'feedback_type',
        'description'
    ];

    protected $table = 'feedbacks';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examAttempt()
    {
        return $this->belongsTo(ExamAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }
}