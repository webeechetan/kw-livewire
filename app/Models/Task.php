<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;
use App\Models\Scopes\OrganizationScope;


class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'assigned_by',
        'name',
        'description',
        'due_date'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
