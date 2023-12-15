<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Scopes\OrganizationScope;

class Project extends Model
{
    use HasFactory;

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
