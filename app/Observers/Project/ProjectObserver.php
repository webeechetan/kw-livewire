<?php

namespace App\Observers\Project;
use App\Models\Project;
use App\Models\Activity;

class ProjectObserver
{
    public function created($project)
    {
        $activity = new Activity();
        $activity->org_id = $project->org_id;
        $activity_text = auth()->guard(session('guard'))->user()->name.' created a project '.$project->name;
        $activity->text = $activity_text;
        $activity->activityable_id = $project->id;
        $activity->activityable_type = 'App\Models\Project';
        $activity->created_by = auth()->guard(session('guard'))->user()->id;
        $activity->save();
    }

    public function updated($project)
    {
        $activity = new Activity();
        $activity->org_id = $project->org_id;
        $activity_text = 'updated ';

        $original = $project->getOriginal();
        $updated = $project->getAttributes();

        foreach($updated as $key => $value){
            if($original[$key] != $value){
                $activity_text .= $key.' from <b>'.$original[$key].'</b> to <b>'.$value .'</b> </br>';
            }
        }

        


        $activity->text = $activity_text;
        $activity->activityable_id = $project->id;
        $activity->activityable_type = 'App\Models\Project';
        $activity->created_by = auth()->guard(session('guard'))->user()->id;
        $activity->save();
    }

}
