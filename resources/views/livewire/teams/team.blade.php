<div class="container">
   <!-- Dashboard Header -->
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a wire:navigate href="{{ route('dashboard') }}">
            <i class='bx bx-line-chart'></i> Dashboard </a>
         </li>
         <li class="breadcrumb-item">
            <a wire:navigate href="{{ route('team.index') }}">All Team</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Tech Team</li>
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
                  <h3 class="main-body-header-title mb-2">Tech Team</h3>
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span>
                        <i class="bx bx-user text-secondary"></i>
                        </span> Manager
                     </div>
                     <div class="col text-nowrap btn-batch">Roshan Jajoriya</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="text-end col">
            <div class="main-body-header-right">
               <a data-bs-toggle="modal" data-bs-target="#add-team-modal" href="javascript:void(0);" class="btn-sm btn-border btn-border-primary">
               <i class='bx bx-plus'></i> Add Team </a>
            </div>
         </div>
      </div>
   </div>
   <!--- Modal --->
   <div>
      <div class="modal fade" id="add-team-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header d-flex align-items-center justify-content-between gap-20">
                  <h3 class="modal-title">
                     <span class="btn-icon btn-icon-primary me-1">
                     <i class='bx bx-layer'></i>
                     </span>
                     <span class="project-form-text">Add Member</span>
                  </h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                     <div class="modal-form-body">
                        <div class="row">
                           <div class="col-md-4 mb-4 mb-md-0">
                              <label for="">Select Team <sup class="text-primary">*</sup>
                              </label>
                           </div>
                           <div class="col-md-8 mb-4">
                              <div class="custom-select">
                                 <select wire:model.live="client_id" class="form-style">
                                    <option value="">Select Team</option>
                                    <option value="">Tech Team</option>
                                    <option value="">Media Team</option>
                                    <option value="">Design Team</option>
                                    <option value="">Cs Team</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 mb-4">
                              <label for=""> Manger Name <sup class="text-primary">*</sup>
                              </label>
                           </div>
                           <div class="col-md-8 mb-4">
                              <input type="text" class="form-style" placeholder="Name">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 mb-4 mb-md-0">
                              <label for="">Start Date <sup class="text-primary">*</sup>
                              </label>
                           </div>
                           <div class="col mb-8 mb-4">
                              <a href="javascript:;" class="btn btn-sm w-100 btn-border-secondary project_start_date">
                              <i class='bx bx-calendar-alt'></i> Start Date </a>
                           </div>
                        </div>
                     </div>
                     <div class="modal-form-btm">
                        <div class="row">
                           <div class="col-md-6 ms-auto text-end">
                              <button type="submit" class="btn btn-primary project-form-btn">Add Member</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
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
                        <h5 class="title-md mb-0">12</h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Clients</div>
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
                        <h5 class="title-md mb-0"> 5 </h5>
                     </div>
                     <div class="col-auto">
                        <span class="font-400 text-grey">|</span>
                     </div>
                     <div class="col-auto">
                        <div class="states_style-text">Project</div>
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
                        <div class="states_style-text">Members</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="column-box mb-4">
      <div class="row align-items-center">
         <div class="col-sm-auto pe-5">
            <h5 class="column-title mb-0">Clients</h5>
         </div>
         <div class="col">
            <!-- Teams -->
            <div class="team-list row">
               <div class="col-auto">
                  <div class="card_style-client-head taskList_col border rounded-3 me-0">
                     <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acma">AC</div>
                     <div>
                        <h6 class="mb-0">
                           <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Acma</a>
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <div class="card_style-client-head taskList_col border rounded-3 me-0">
                     <div class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="True Consultant">TC</div>
                     <div>
                        <h6 class="mb-0">
                           <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">True Consultant</a>
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <div class="card_style-client-head taskList_col border rounded-3 me-0">
                     <div class="avatar avatar-sm avatar-red" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Indestch">ID</div>
                     <div>
                        <h6 class="mb-0">
                           <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Indestuch</a>
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <div class="card_style-client-head taskList_col border rounded-3 me-0">
                     <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acma">AC</div>
                     <div>
                        <h6 class="mb-0">
                           <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Acma</a>
                        </h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="column-box mb-3">
      <div class="d-flex flex-wrap gap-20 align-items-center">
         <div>
            <h5 class=" column-title mb-0">Projects</h5>
         </div>
      </div>
   </div>
   <div class="project-tabs mb-2">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="project-all-tab" data-bs-toggle="tab" data-bs-target="#project-all-tab-pane" type="button" role="tab" aria-controls="project-all-tab-pane" aria-selected="true">All <span class="ms-2">1</span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-active-tab" data-bs-toggle="tab" data-bs-target="#project-active-tab-pane" type="button" role="tab" aria-controls="project-active-tab-pane" aria-selected="false" tabindex="-1">Active <span class="ms-2">1</span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-done-tab" data-bs-toggle="tab" data-bs-target="#project-done-tab-pane" type="button" role="tab" aria-controls="project-done-tab-pane" aria-selected="false" tabindex="-1">Completed <span class="ms-2">0</span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-overdue-tab" data-bs-toggle="tab" data-bs-target="#project-overdue-tab-pane" type="button" role="tab" aria-controls="project-overdue-tab-pane" aria-selected="false" tabindex="-1">Overdue <span class="ms-2">0</span></button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-archived-tab" data-bs-toggle="tab" data-bs-target="#project-archived-tab-pane" type="button" role="tab" aria-controls="project-archived-tab-pane" aria-selected="false" tabindex="-1">Archive <span class="ms-2">0</span></button>
         </li>
      </ul>
   </div>
   <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="project-all-tab-pane" role="tabpanel" aria-labelledby="project-all-tab" tabindex="0">
         <div class="row">
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="project-active-tab-pane" role="tabpanel" aria-labelledby="project-active-tab" tabindex="0">
         <div class="row">
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="project-list">
                  <div class="project project-align_left w-100">
                     <div class="project-icon"><i class="bx bx-layer"></i></div>
                     <div class="project-content">
                        <a href="#" class="project-title">Acma</a>
                        <div class="project-selected-date">Due on <span>4 April</span></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="project-done-tab-pane" role="tabpanel" aria-labelledby="project-done-tab" tabindex="0">
         <div class="project-list project-list-completed">
         </div>
      </div>
      <div class="tab-pane fade" id="project-overdue-tab-pane" role="tabpanel" aria-labelledby="project-overdue-tab" tabindex="0">
         <div class="project-list project-list-overdue">
         </div>
      </div>
      <div class="tab-pane fade" id="project-archived-tab-pane" role="tabpanel" aria-labelledby="project-archived-tab" tabindex="0">
         <div class="project-list project-list-archive">
         </div>
      </div>
   </div>
   <div class="row mt-4">
      <div class="col-lg-12">
         <h5 class="column-title mb-3">Member</h5>
      </div>
      <div class="col-md-12">
         <div class="column-box">
               <div class="taskList-dashbaord_header">
                  <div class="row">
                     <div class="col-md-4">
                           <div class="taskList-dashbaord_header_title taskList_col">Name</div>
                     </div>
                     <div class="col text-center">
                           <div class="taskList-dashbaord_header_title taskList_col">Position</div>
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
                              <div class="taskList_col"><span class="btn-batch">Jr. Web Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-success">Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ajay">Ajay</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Ajay Kumar</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Php Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-warning">In Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sharukh">SK</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Md. Sharukh</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Front End Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-success">Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chetan">CS</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Chetan Singh</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Sr. Php Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-warning">In Active</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                  <div class="taskList_row" wire:key="task-row-100">
                     <div class="row">
                           <div class="col-lg-4">
                              <div class="card_style-client-head taskList_col me-0">
                                 <div class="avatar avatar-sm avatar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Roshan">Rj</div>
                                 <div>
                                       <h6 class="mb-0">
                                          <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Roshan Jajoriya</a>
                                       </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class="btn-batch">Sr. Ui Developer</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span class=" badge bg-dark">Moderate</span></div>
                           </div>
                           <div class="col text-center">
                              <div class="taskList_col"><span><button class="btn-icon"><i class="bx bx-trash"></i></button></span></div>
                           </div>
                     </div>
                  </div>
                 
               </div>
         </div>
      </div>
   </div>
</div>