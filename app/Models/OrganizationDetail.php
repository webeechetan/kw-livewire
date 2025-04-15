<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;

class OrganizationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'industry',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'tiktok'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}
