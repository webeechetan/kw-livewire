<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'client_id',
        'project_id',
        'created_by',
        'name',
        'settings',

    ];
}
