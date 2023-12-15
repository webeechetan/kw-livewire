<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'task_id',
    ];

    public function user()
    {
        // check if the user is from web or organization
        $guard = $this->created_by;
        if($guard == 'web'){
            return $this->belongsTo(User::class);
        }else{
            return $this->belongsTo(Organization::class);
        }
    }
}
