<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Team;
use App\Models\UserDetail;
use App\Models\Project;
use App\Models\Notification;
use App\Models\Scopes\OrganizationScope;
use App\Models\Organization;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected function getDefaultGuardName(): string { return 'web'; }

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

    // public function projects(){
    //     return $this->belongsToMany(Project::class);
    // }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function getProjectsAttribute(){
        $users_projects_ids = $this->tasks->pluck('project_id')->toArray();
        $users_projects_ids = array_unique($users_projects_ids);
        $projects = Project::whereIn('id', $users_projects_ids)->get();
        return $projects;
    }

    public function details(){
        return $this->belongsTo(UserDetail::class);
    }

    public function getInitialsAttribute(){
        // only take first 2 words and get their first letter if the name is in one word then take first 2 letters
        $words = explode(' ', $this->name);
        if(count($words) == 1){
            return substr($this->name, 0, 2);
        }
        return $words[0][0].$words[1][0];
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function getIsManagerAttribute(){
        $teams = Team::where('manager_id', $this->id)->get();
        if($teams->count() > 0){
            return true;
        }
        return false;
    }

    public function myTeam(){
        return $this->hasOne(Team::class,'manager_id');
    }
}
