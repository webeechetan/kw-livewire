<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
