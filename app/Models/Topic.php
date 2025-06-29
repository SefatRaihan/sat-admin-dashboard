<?php

namespace App\Models;

use App\Models\ExamQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    protected $table = 'topics';
    protected $guarded = [];

    public function questions()
    {
        return $this->belongsTo(ExamQuestion::class);
    }
}
