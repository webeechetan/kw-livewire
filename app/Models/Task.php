<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;


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
