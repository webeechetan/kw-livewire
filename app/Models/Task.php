<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Project;
use App\Models\Comment;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use App\Models\Attachment;


class Task extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'org_id',
        'assigned_by',
        'name',
        'description',
        'due_date'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function routeNotificationForSlack($notification){
        return env('SLACK_TASK_NOTIFICATION_WEBHOOK_URL');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function assignedBy(){
        $guard = $this->created_by;
        if($guard == 'web'){
            return $this->belongsTo(User::class, 'assigned_by');
        }else{
            return $this->belongsTo(Organization::class, 'assigned_by');
        }
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function notifiers(){
        return $this->belongsToMany(User::class, 'task_user_notify');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachable');
    }

    // scopes 

    public function scopeTasksByUserType($query){
        if(session('guard') == 'web'){
            return $query->whereHas('users', function($q){
                $q->where('user_id', auth()->user()->id);
            });
        }
    }
}
