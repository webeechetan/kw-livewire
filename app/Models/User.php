<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Team;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function routeNotificationForSlack($notification){
        return env('SLACK_TASK_NOTIFICATION_WEBHOOK_URL');
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
