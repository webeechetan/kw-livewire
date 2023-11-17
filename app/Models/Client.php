<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;

class Client extends Model
{
    use HasFactory;

    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

}
