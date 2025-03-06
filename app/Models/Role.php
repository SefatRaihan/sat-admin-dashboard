<?php

namespace App\Models;

use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(User::class, 'active_role_id');
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function supervisorUsers()
    {
        return $this->hasMany(User::class, 'active_role_id')->where('active_role_id', 2);
    }
    
}
