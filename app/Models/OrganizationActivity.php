<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrganizationActivityTask;

class OrganizationActivity extends Model
{
    use HasFactory;

    public function getInitialsAttribute(){
        $words = explode(' ', $this->name);
        
        if (empty($this->name)) {
            return '';
        }
        
        if (count($words) == 1) {
            return substr($this->name, 0, 2);
        }
        
        $firstInitial = !empty($words[0]) ? $words[0][0] : '';
        $secondInitial = !empty($words[1]) ? $words[1][0] : '';
        
        return $firstInitial . $secondInitial;
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function tasks(){
        return $this->hasMany(OrganizationActivityTask::class);
    }



}
