<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;
use App\Models\Scopes\OrganizationScope;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
