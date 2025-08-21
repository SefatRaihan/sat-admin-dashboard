<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralStepSection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle'];

    public function items()
    {
        return $this->hasMany(ReferralStepSectionItem::class);
    }
}