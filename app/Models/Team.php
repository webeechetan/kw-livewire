<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;

use PDO;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function manager(){
        return $this->belongsTo(User::class,'manager_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function getProjectsAttribute(){
        $users = $this->users->pluck('id')->toArray();
        $projects = Task::whereHas('users', function ($query) use ($users) {
            $query->whereIn('user_id', $users);
        })->pluck('project_id')->toArray();
        return Project::whereIn('id', $projects)->get();
    }

    public function getClientsAttribute(){
        $projects = $this->projects->pluck('id')->toArray();
        return Client::whereIn('id', $projects)->get();
    }

    public function getTasksAttribute(){
        $projects = $this->projects->pluck('id')->toArray();
        return Task::whereIn('project_id', $projects)->get();
    }

    public function getInitialsAttribute(){
        // Split the name into words
        $words = explode(' ', $this->name);
        
        // Handle the case where the name is empty or just whitespace
        if (empty($this->name)) {
            return '';
        }
        
        // Handle the case where the name is a single word
        if (count($words) == 1) {
            return substr($this->name, 0, 2);
        }
        
        // Handle the case where the name has at least two words
        $firstInitial = !empty($words[0]) ? $words[0][0] : '';
        $secondInitial = !empty($words[1]) ? $words[1][0] : '';
        
        return $firstInitial . $secondInitial;
    }
    

    // public function getInitialsAttribute(){
    //     return $this->name;
    // }

}
