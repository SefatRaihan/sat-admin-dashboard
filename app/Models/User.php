<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Historiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Historiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'active_role_id');
    }

    public function hasPermission($permission)
    {
        if ($this->active_role_id == 1) {
            return true; // Super admin has all permissions
        }

        return $this->role->permissions->contains('name', $permission);
    }

    public function supervisor()
    {
        return $this->hasOne(Supervisor::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
                    ->withPivot(['completed_at', 'course_id', 'chapter_id'])
                    ->withTimestamps();
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps()->withPivot('is_completed', 'completed_at');
    }

    public function routeNotificationForSms($notification): ?string
    {
        return $this->phone;
    }

}