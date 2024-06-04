<?php
namespace App\Helpers;

class Filter
{
    public static function byProject($query, $project_id){
        if($project_id != 'all'){
            return $query->where('project_id', $project_id);
        }
        return $query;
    }

    public static function byClient($query, $client_id){
        if($client_id != 'all'){
            return $query->where('client_id', $client_id);
        }
        return $query;
    }

    public static function byUser($query, $user_id){
        if($user_id != 'all'){
            return $query->whereHas('users', function($q) use ($user_id){
                $q->where('user_id', $user_id);
            });
        }
        return $query;
    }

    public static function filterTasks($query, $byProject, $byClient, $byUser, $sort, $startDate, $dueDate, $status){
        $query = self::byProject($query, $byProject);
        $query = self::byClient($query, $byClient);
        $query = self::byUser($query, $byUser);

        if($startDate){
            $query->whereDate('due_date', '>=', $startDate);
        }

        if($dueDate){
            $query->whereDate('due_date', '<=', $dueDate);
        }

        if($status != 'all'){
            $query->where('status', $status);
        }

        switch ($sort) {
            case 'a_z':
                return $query->orderBy('name');
            case 'z_a':
                return $query->orderByDesc('name');
            case 'newest':
                return $query->latest();
            case 'oldest':
                return $query->oldest();
            default:
                return $query->orderBy('task_order');
        }
    }
}
?>