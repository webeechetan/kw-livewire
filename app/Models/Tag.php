<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'created_by',
        'name',
        'color',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
