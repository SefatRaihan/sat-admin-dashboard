<?php

namespace App\Models;

use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory, SoftDeletes, Historiable, UserTrackable;
    
    protected $guarded = ['id'];
    
    protected $table = 'packages';

    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $casts = [
        'highlight_status' => 'boolean',
        'highlight_badge' => 'boolean',
        'status' => 'integer',
        'promotional_badge' => 'float',
        'price' => 'decimal:2',
        'activated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->created_by = auth()->id(); // Assuming authenticated user
        });
    }
}