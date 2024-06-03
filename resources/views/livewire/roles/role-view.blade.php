<div class="container">
<!-- Dashboard Header -->
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a wire:navigate href="{{ route('dashboard') }}">
            <i class='bx bx-line-chart'></i> Dashboard </a>
         </li>
         <!-- <li class="breadcrumb-item">
            <a wire:navigate href="{{ route('team.index') }}">All </a>
            </li> -->
         <li class="breadcrumb-item active" aria-current="page">Admin</li>
      </ol>
   </nav>
   <div class="dashboard-head mb-4">
      <div class="row align-items-center">
         <div class="col">
            <div class="dashboard-head-title-wrap">
               <div class="client_head_logo">
                  <img src="" alt="">
               </div>
               <div>
                  <h3 class="main-body-header-title mb-1">{{$role->name}}</h3>
               </div>
            </div>
         </div>
         <div class="text-end col">
            <div class="main-body-header-right">
               @can('Create Role')
               <a data-bs-toggle="modal" data-bs-target="#add-team-modal" href="javascript:void(0);" class="btn-sm btn-border btn-border-primary">
               <i class='bx bx-plus'></i> Add Role</a>
               @endcan
            </div>
         </div>
      </div>
   </div>
   <!--- Dashboard Body --->
   <div class="row mb-4">
      <div class="col-lg-4">
         <div class="column-box states_style-progress h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0">{{ $role->permissions->count() }}</h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Permission</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="column-box states_style-active h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0"> 4 </h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">User</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="column-box states_style-success h-100">
            <div class="row align-items-center">
               <div class="col-auto">
                  <div class="states_style-icon">
                     <i class='bx bx-layer'></i>
                  </div>
               </div>
               <div class="col">
                  <div class="row align-items-center g-2">
                     <div class="col-auto">
                        <h5 class="title-md mb-0">5</h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Extra Permission</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="column-box mb-4">
      <div class="row">
         <div class="col-sm-auto pe-5">
               <h5 class="column-title mb-0">Permission</h5>
         </div>
         <div class="col">
               <!-- Teams -->
               <div class="d-flex column-gap-3">
                  <div><span class="btn-batch">Create</span></div>
                  <div><span class="btn-batch">Delete</span></div>
                  <div><span class="btn-batch">Update</span></div>
                  <div><span class="btn-batch">Edit</span></div>
               </div>
         </div>
      </div>
   </div>
   <div class="row mb-4">
      <div class="col-lg-12">
         <h5 class="column-title mb-3">User Details</h5>
      </div>
      <div class="col-md-12">
         <div class="column-box">
               <div class="taskList-dashbaord_header">
                  <div class="row">
                     <div class="col-md-4">
                           <div class="taskList-dashbaord_header_title taskList_col">User</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Team Name</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Status</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Action</div>
                     </div>
                  </div>
               </div>
               <div class="taskList scrollbar">
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Himanshu Sharma">HS</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Himanshu Sharma</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Tech Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-dark">In Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vikram">Vk</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Vikram Malhotra</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Cs Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-warning">Pending</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vikram">PR</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Pardeep Rajput</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Media Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-success">Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Himanshu Sharma">HS</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Himanshu Sharma</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Tech Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-dark">In Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vikram">Vk</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Vikram Malhotra</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Cs Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-warning">Pending</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vikram">PR</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Pardeep Rajput</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Media Team</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-success">Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
   <div class="column-box">
      <div class="row">
         <div class="col-sm-auto pe-5">
               <h5 class="column-title mb-0">Extra Permission</h5>
         </div>
         <div class="col">
               <!-- Teams -->
               <div class="d-flex column-gap-3">
                  <div><span class="btn-batch">View</span></div>
                  <div><span class="btn-batch">Add User</span></div>
               </div>
         </div>
      </div>
   </div>

</div>