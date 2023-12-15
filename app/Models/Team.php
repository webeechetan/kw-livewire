<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Scopes\OrganizationScope;

class Team extends Model
{
    use HasFactory;

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

}
