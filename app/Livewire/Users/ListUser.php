<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Team;
use App\Models\Project;
use Livewire\WithPagination;
use App\Helpers\Helper;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;



class ListUser extends Component
{

    use WithPagination;

     public $allUsers;
     public $activeUsers;
     public $completedUsers;
     public $archivedUsers;

     public $query = '';


     public $byTeam = 'all';
     public $byUser = 'all'; 
     public $byProject = 'all';

 
     public $teams = [] ;
     public $projects = [] ;


    // //  filters & sorts

      public $sort = 'all';
      public $filter = 'all';


      public $user;
  

    public function render()
    {

        $this->allUsers = User::count();
        $this->activeUsers = User::where('status', 'active')->count();
        $this->completedUsers = User::where('status', 'completed')->count();
        $this->archivedUsers = User::onlyTrashed()->count();


        $users = User::where('name', 'like', '%'.$this->query.'%');

        if($this->sort == 'newest'){
            $users->orderBy('created_at','desc');
        }elseif($this->sort == 'oldest'){
            $users->orderBy('created_at','asc');
        }elseif($this->sort == 'a_z'){
            $users->orderBy('name','asc');
        }elseif($this->sort == 'z_a'){
            $users->orderBy('name','desc');
        }

        
        if($this->filter == 'active'){
            $users->where('status','active');
        }elseif($this->filter == 'completed'){
            $users->where('status','completed');
        }elseif($this->filter == 'archived'){
            $users->onlyTrashed();
        }


        if($this->byTeam != 'all'){
            $users->whereHas('teams', function($query){
                $query->where('team_id', $this->byTeam);
            });
        }
       

        if($this->byProject != 'all'){
            $project_users = Project::find($this->byProject)->members->pluck('id');
            $users->whereIn('id', $project_users);
        }

        $users->orderBy('created_at', 'desc');
        $users = $users->paginate(9);

        return view('livewire.users.list-user',[
            'users' => $users,
        ]);
        
    }

    public function mount(){

        $this->authorize('View User');
        $this->teams = Team::orderBy('name')->get();
        $this->projects = Project::orderBy('name')->get();

        $tour = session()->get('tour');
        if(request()->tour == 'close-user-tour'){
            // $tour['user_tour'] = false;
            unset($tour['user_tour']);
            session()->put('tour',$tour);
        }
    }

    public function search()
    {
        $this->resetPage();
    }  

    public function doesAnyFilterApplied(){
        return $this->byTeam != 'all' || $this->byProject != 'all' || $this->sort != 'all' || $this->filter != 'all';
    }



}
