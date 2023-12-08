<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;


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
        $guard = session('guard');
        if($guard == 'web'){
            return $this->belongsTo(User::class,'assigned_by');
        }
        return $this->belongsTo(Organization::class,'assigned_by', 'id');
    }
}
