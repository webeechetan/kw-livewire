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
               <h3 class="main-body-header-title mb-2">Admin</h3>
               <div class="row align-items-center">
                  <div class="col">
                     <span>
                     <i class="bx bx-layer text-secondary"></i>
                     </span> Created By
                  </div>
                  <div class="col text-secondary text-nowrap">Auto Generated</div>
               </div>
            </div>
         </div>
      </div>
      <div class="text-end col">
         <div class="main-body-header-right">
            <a data-bs-toggle="modal" data-bs-target="#add-team-modal" href="javascript:void(0);" class="btn-sm btn-border btn-border-primary">
            <i class='bx bx-plus'></i> Add Role</a>
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
                  <span class="project-form-text">Add Role</span>
               </h3>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form method="POST" enctype="multipart/form-data">
                  <div class="modal-form-body">
                     <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                           <label for="">Select Role<sup class="text-primary">*</sup>
                           </label>
                        </div>
                        <div class="col-md-8 mb-4">
                           <div class="custom-select">
                              <select wire:model.live="client_id" class="form-style">
                                 <option value="">Select Role</option>
                                 <option value="">Admin</option>
                                 <option value="">Hr</option>
                                 <option value="">Manager</option>
                                 <option value="">Employee</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 mb-4">
                           <label for="">Permission<sup class="text-primary">*</sup>
                           </label>
                        </div>
                        <div class="col-md-8 mb-4">
                           <select wire:model.live="client_id" class="form-style">
                              <option value="">Select Permission</option>
                              <option value="">Edit</option>
                              <option value="">Create</option>
                              <option value="">Delete</option>
                              <option value="">Update</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-form-btm">
                     <div class="row">
                        <div class="col-md-6 ms-auto text-end">
                           <button type="submit" class="btn btn-primary project-form-btn">Add Role</button>
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
<div class="row">
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
                     <h5 class="title-md mb-0">4</h5>
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
                     <h5 class="title-md mb-0"> 12 </h5>
                  </div>
                  <div class="col-auto">
                     <span class="font-400 text-grey">|</span>
                  </div>
                  <div class="col-auto">
                     <div class="states_style-text">Assigned</div>
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
                     <div class="states_style-text">User</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12 mt-4">
      <h3 class="main-body-header-title mb-3">Roles</h3>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="table-responsive">
               <div class="row mx-1">
                  <div class="col-sm-12 col-md-3">
                     <div class="py-3">
                        <label>
                           <select class="form-select">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                           </select>
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-9">
                     <div class="d-flex justify-content-end py-3">
                        <div class="me-3">
                           <div><label><b>Search</b><input type="search" class="form-control d-inline-block w-auto ms-2" placeholder="Search.."></label></div>
                        </div>
                        <div class="pb-3 w-200 pb-sm-0">
                           <select class="form-select text-capitalize">
                              <option value=""> Select Role </option>
                              <option value="Admin" class="text-capitalize">Admin</option>
                              <option value="Manager" class="text-capitalize">Manager</option>
                              <option value="Employee" class="text-capitalize">Employee</option>
                              <option value="Hr class="text-capitalize">Hr</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <table class="dataTable table border-top">
                  <thead>
                     <tr>
                        <th class="sorting" rowspan="1" colspan="1">User</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Role">Role</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label=" Status">Status</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="View">View</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr class="odd">
                        <td>
                           <div class="card_style-client-head me-0">
                              <div class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Himanshu Sharma">HS</div>
                              <div>
                                 <h6 class="mb-0">
                                    <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Himanshu Sharma</a>
                                 </h6>
                              </div>
                           </div>
                        </td>
                        <td><span>Employee</span></td>
                        <td><span class=" badge bg-dark">In Active</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-show-alt"></i></button></span></td>
                     </tr>
                     <tr class="even">
                        <td>
                        <div class="card_style-client-head me-0">
                              <div class="avatar avatar-sm avatar-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vikram">VK</div>
                              <div>
                                 <h6 class="mb-0">
                                    <a href="#" wire:navigate="">Vikram</a>
                                 </h6>
                              </div>
                            </div>
                        </td>
                        <td><span>Manager</span></td>
                        <td><span class="badge bg-warning">pending</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-show-alt"></i></button></span></td>
                     </tr>
                     <tr class="odd">
                        <td>
                           <div class="card_style-client-head me-0">
                              <div class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chetan Singh">CS</div>
                              <div>
                                 <h6 class="mb-0">
                                    <a href="http://127.0.0.1:8000/project/view/701" wire:navigate="">Chetan Singh</a>
                                 </h6>
                              </div>
                            </div>
                        </td>
                        <td>Admin</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-show-alt"></i></button></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12 mt-4">
      <h3 class="main-body-header-title mb-3">Permission</h3>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="table-responsive">
               <div class="row mx-1">
                  <div class="col-sm-12 col-md-3">
                     <div class="py-3">
                        <label>
                           <select class="form-select">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                           </select>
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-9">
                     <div class="me-1 py-3 text-end">
                        <div><label><b>Search</b><input type="search" class="form-control d-inline-block w-auto ms-2" placeholder="Search.."></label></div>
                     </div>
                  </div>
               </div>
               <table class="dataTable table border-top">
                  <thead>
                     <tr>
                        <th class="sorting" rowspan="1" colspan="1">Name</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Assigned To">Assigned To</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Status">Created Date</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Actions">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr class="odd">
                        <td><span>Management</span></td>
                        <td><span><span class="badge bg-secondary m-1">Admin</span></span></td>
                        <td><span>14 Apr 2021, 8:43 PM</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></td>
                     </tr>
                     <tr class="even">
                        <td><span>Manage Billing &amp; Roles</span></td>
                        <td><span><span class="badge bg-primary m-1">Admin</span></span></td>
                        <td><span>16 Sep 2021, 5:20 PM</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></td>
                     </tr>
                     <tr class="odd">
                        <td><span>Add &amp; Remove Users</span></td>
                        <td><span><span class="badge bg-primary m-1">Admin</span><span class="badge bg-warning m-1">Manager</span></span></td>
                        <td><span>14 Oct 2021, 10:20 AM</span></td>
                        <td><span><button class="btn-icon me-2"><i class="bx bx-edit"></i></button><button class="btn-icon"><i class="bx bx-trash"></i></button></span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>