<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;
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
    }

    public function getVisibleNameAttribute(){
        if($this->use_brand_name){
            return $this->brand_name;
        }
        return $this->name;
    }

    public function getInitialsAttribute(){
        // only take first 2 words and get their first letter if the name is in one word then take first 2 letters
        $words = explode(' ', $this->name);
        if(count($words) == 1){
            return substr($this->name, 0, 2);
        }
        return $words[0][0].$words[1][0];
        
    }

    public function getNameAttribute($value){
        if($this->use_brand_name){
            return $this->brand_name;
        }else{
            return $value;
        }
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function getUsersAttribute(){
        $projects = $this->projects->pluck('id')->toArray();
        $tasks = Task::whereIn('project_id', $projects)->get();
        $task_users = [];
        foreach ($tasks as $task) {
            $task_users = array_merge($task_users, $task->users->pluck('id')->toArray());
        }
        return User::whereIn('id', $task_users)->get();
        
    }

    

}
