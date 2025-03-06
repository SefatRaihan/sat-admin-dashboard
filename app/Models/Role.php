<?php

namespace App\Models;

use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Role extends Model
{
    use HasFactory, SoftDeletes, Historiable, UserTrackable;
    
    protected $guarded = ['id'];
    
    protected $table = 'roles';


    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
   
    /**
     * Boot function to generate a UUID before creating a new role.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($role) {
            if (empty($role->uuid)) {
                $role->uuid = (string) Str::uuid();
            }
        });
    }
}
