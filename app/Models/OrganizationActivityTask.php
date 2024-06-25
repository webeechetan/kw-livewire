<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attachment;
use App\Models\ActivityTaskComment;

class OrganizationActivityTask extends Model
{
    use HasFactory;

    public function organizationActivity(){
        return $this->belongsTo(OrganizationActivity::class);
    }

    public function assignedBy(){
        return $this->belongsTo(User::class, 'assigned_by');
    } 

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function notifiers(){ 
        return $this->belongsToMany(User::class, 'organization_activity_task_notify');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function comments(){
        return $this->hasMany(ActivityTaskComment::class, 'task_id');
    }

}
