<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;
use App\Models\Scopes\MainClientScope;
use App\Models\Team;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new MainClientScope);
    }

    public function getVisibleNameAttribute(){
        if($this->use_brand_name){
            return $this->brand_name;
        }
        return $this->name;
    }

    public function getInitialsAttribute(){
        $name = $this->name;
        $name = explode(' ', $name);
        if(count($name) == 1){
            return strtoupper(substr($name[0], 0, 2));
        }else{
            return strtoupper(substr($name[0], 0, 1).substr($name[1], 0, 1));
        }
        
    }

    public function getNameAttribute($value){
        if($this->use_brand_name){
            return $this->brand_name;
        }else{
            return $value;
        }
    }

    public function getOrignalNameAttribute(){
        return $this->attributes['name'];
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function getUsersAttribute(){
        $projects = $this->projects->pluck('id')->toArray();
        // $tasks = Task::whereIn('project_id', $projects)->get();
        // $task_users = [];
        // foreach ($tasks as $task) {
        //     $task_users = array_merge($task_users, $task->users->pluck('id')->toArray());
        // }
        // return User::whereIn('id', $task_users)->get();

        $users = [];
        foreach ($projects as $project) {
            $users = array_merge($users, Project::find($project)->members->pluck('id')->toArray());
        }

        return User::whereIn('id', $users)->get();
        
    }

    public function getTeamsAttribute(){
        $projects = $this->projects->pluck('id')->toArray();
        $teams = [];
        foreach ($projects as $project) {
            $teams = array_merge($teams, Project::find($project)->teams->pluck('id')->toArray());
        }
        return Team::whereIn('id', $teams)->get();
    }

    // scopes

    public function scopeMain($query){
        return $query->where('is_main', 1);
    }

    

}
