<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;
use App\Models\Scopes\OrganizationScope;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\Project\ProjectObserver;

#[ObservedBy(ProjectObserver::class)]
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function getInitialsAttribute(){
        $words = explode(' ', $this->name);
        if(count($words) == 1){
            return substr($this->name, 0, 2);
        }
        return $words[0][0].$words[1][0];
        
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }


    public function getMembersAttribute(){
        $project_tasks_ids = Task::where('project_id',$this->id)->pluck('id');
        $user_ids = [];
        foreach($project_tasks_ids as $task_id){
            $task = Task::find($task_id);
            $user_ids = array_merge($user_ids,$task->users->pluck('id')->toArray());
        }
        $user_ids = array_unique($user_ids);
        return User::whereIn('id',$user_ids)->get();
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function activities(){
        return $this->morphMany(Activity::class, 'activityable');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
