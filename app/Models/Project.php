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
use App\Models\Scopes\MainClientScope;

#[ObservedBy(ProjectObserver::class)]
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    // public function getInitialsAttribute(){
    //     $words = explode(' ', $this->name);
    //     if(count($words) == 1){
    //         return substr($this->name, 0, 2);
    //     }
    //     return $words[0][0].$words[1][0];
        
    // }

    public function getInitialsAttribute(){
        $words = explode(' ', $this->name);
        
        if (empty($this->name)) {
            return '';
        }
        
        if (count($words) == 1) {
            return substr($this->name, 0, 2);
        }
        
        $firstInitial = !empty($words[0]) ? $words[0][0] : '';
        $secondInitial = !empty($words[1]) ? $words[1][0] : '';
        
        return $firstInitial . $secondInitial;
    }


    public function client(){
        return $this->belongsTo(Client::class)->withoutGlobalScope(MainClientScope::class);
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

    public function getTeamsAttribute(){
        $users = $this->members->pluck('id');
        $users = array_unique($users->toArray());
        return Team::whereHas('users',function($query) use($users){
            $query->whereIn('user_id',$users);
        })->get();
        
       
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
