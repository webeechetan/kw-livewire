<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;
use App\Models\Team;
use App\Models\User;

class Client extends Model
{
    use HasFactory;

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

    public function users(){
        return $this->belongsToMany(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

}
