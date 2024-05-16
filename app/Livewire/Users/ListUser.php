<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Client;
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
     public $byClient = 'all';
     public $byProject = 'all';

     public $clients = [] ;

    // //  filters & sorts

      public $sort = 'all';
      public $filter = 'all';


      public $user;

    public function render()
    {

        $this->allUsers = User::count();
        $this->activeUsers = User::where('status', 'active')->count();
        $this->completedUsers = User::where('status', 'completed')->count();
       // $this->archivedUsers = User::onlyTrashed()->count();


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

        
          
        if($this->byClient != 'all'){

           
            $users->whereHas('clients', function($query){
                $query->where('client_id', $this->byClient);
            });
        }
        
        

       
        
        // if($this->byProject != 'all'){
        //     $users->whereHas('projects', function($query){
        //         $query->where('id', $this->byProject);
        //     });
        // }

        

        $users->orderBy('created_at', 'desc');
        $users = $users->paginate(9);

        // dd($users);

        //$clients = Client::all();
        $projects = Project::all();


        return view('livewire.users.list-user',[
            'users' => $users,
            //'clients' => $clients,
            'projects' => $projects,
        ]);
       
        // return view('livewire.users.list-user',[
        //     'users' => User::orderBy('id','desc')->paginate(10)
        // ]);
        
    }


    public function mount(){

        $this->clients = Client::all();
    }

    public function search()
    {
        $this->resetPage();
    }



}
