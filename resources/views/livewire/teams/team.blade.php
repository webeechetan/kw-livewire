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
  <div class="dashboard-head mb-4 pb-0">
    <div class="row align-items-center">
      <div class="col">
        <div class="dashboard-head-title-wrap">
          <div class="client_head_logo">
            <img src="" alt="">
          </div>
          <div>
            <h3 class="main-body-header-title mb-2">Tech Team</h3>
            <div class="mb-2">
              <span class="font-500">
                <i class='bx bx-user text-success'></i> Manager </span>
              <span class="btn-batch ms-2">Roshan Jajoriya</span>
            </div>
          </div>
        </div>
      </div>
      <div class="text-end col">
        <div class="main-body-header-right">
          <a data-bs-toggle="modal" data-bs-target="#add-team-member-modal" href="javascript:void(0);" class="btn-sm btn-border btn-border-primary">
            <i class='bx bx-plus'></i> Add Member </a>
        </div>
      </div>
    </div>
  </div>
  <!--- Modal --->
  <div>
    <div class="modal fade" id="add-team-member-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="">Name <sup class="text-primary">*</sup>
                    </label>
                  </div>
                  <div class="col-md-8 mb-4">
                    <input type="text" class="form-style" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <label for="">Email <sup class="text-primary">*</sup>
                    </label>
                  </div>
                  <div class="col-md-8 mb-4">
                    <input type="email" class="form-style" placeholder="Enter Your Email">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <label for="">Designation <sup class="text-primary">*</sup>
                    </label>
                  </div>
                  <div class="col-md-8 mb-4">
                    <input type="text" class="form-style" placeholder="Enter Your Designation">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4 mb-md-0">
                    <label for="">Joining Date <sup class="text-primary">*</sup>
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
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="column-box states_style-progress">
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
                <div class="states_style-text">Project</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="column-box states_style-active">
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
                <div class="states_style-text">Clients</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="column-box states_style-success">
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
  <div class="row">
    <div class="col-lg-4">
        <div class="column-box font-500 mb-3">
          <div class="row align-items-center">
            <div class="col">
              <span>
                <i class="bx bx-layer text-secondary"></i>
              </span> Created By
            </div>
            <div class="col text-secondary">
 
					 Auto Generated
  
            </div>
          </div>
        
      </div>
      <div class="column-box">
        <div class="column-head row align-items-center">
          <div class="col">
            <div class="column-title">Projects</div>
          </div>
        </div>
        <div class="mt-3">
          <div class="row space-last_child_0">
            <div class="team-member col-auto pe-0">
              <a href="javascript:" class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Website Development" data-bs-original-title="Website Development">WD</a>
            </div>
            <div class="team-text col">
              <div class="mb-0 font-500">Website Development</div>
              <span class="text-sm">ACMA</span>
            </div>
          </div>
          <div class="row space-last_child_0">
            <div class="team-member col-auto pe-0">
              <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dashboard" data-bs-original-title="Dashboard">DB</a>
            </div>
            <div class="team-text col">
              <div class="mb-0 font-500">Dashboard</div>
              <span class="text-sm">True Consultant</span>
            </div>
          </div>
          <div class="row space-last_child_0">
            <div class="team-member col-auto pe-0">
              <a href="javascript:" class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dashboard" data-bs-original-title="Website Maintenance">WM</a>
            </div>
            <div class="team-text col">
              <div class="mb-0 font-500">Website Maintenance</div>
              <span class="text-sm">Prunelle</span>
            </div>
          </div>
          <div class="row space-last_child_0">
            <div class="team-member col-auto pe-0">
              <a href="javascript:" class="avatar avatar-sm avatar-green" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Dashboard" data-bs-original-title="Team Management">TM</a>
            </div>
            <div class="team-text col">
              <div class="mb-0 font-500">Team Management</div>
              <span class="text-sm">Kakeywalk</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="row">
        <div class="col-lg-6">
          <div class="column-box h-100">
            <div class="column-head row align-items-center">
              <div class="col">
                <div class="column-title">Clients</div>
              </div>
            </div>
            <div class="mt-3">
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Acma" data-bs-original-title="Acma">AC</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Acma</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-green" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Indestuch" data-bs-original-title="Indestuch">ID</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Indestuch</div>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Prunelle" data-bs-original-title="Prunelle">PL</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Prunelle</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="column-box h-100">
            <div class="column-head row align-items-center">
              <div class="col">
                <div class="column-title">Member</div>
              </div>
            </div>
            <div class="mt-2">
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-yellow" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Ajay" data-bs-original-title="Ajay">AJ</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Ajay</div>
                  <span class="text-sm">Php Developer</span>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-blue" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Chetan" data-bs-original-title="Chetan">CH</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Chetan Singh</div>
                  <span class="text-sm">Sr. Backend Developer</span>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-primary" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Roshan Jajoriya" data-bs-original-title="Roshan Jajoriya">RJ</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Roshan Jajoriya</div>
                  <span class="text-sm">Sr. UI Developer</span>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-pink" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Himanshu Sharma" data-bs-original-title="Himanshu Sharma">HS</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Himanshu Sharma</div>
                  <span class="text-sm">Jr. Frontend Developer</span>
                </div>
              </div>
              <div class="row space-last_child_0">
                <div class="team-member col-auto pe-0">
                  <a href="javascript:" class="avatar avatar-sm avatar-brown" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Sharuakh" data-bs-original-title="Sharuakh">Sk</a>
                </div>
                <div class="team-text col">
                  <div class="mb-0 font-500">Sharuakh</div>
                  <span class="text-sm">Jr. Frontend Developer</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column-box mt-4">
    <div class="column-title">Description</div>
    <div> Est molestiae pariatur temporibus tempora qui molestias itaque occaecati. Voluptas et ut quo. Voluptates nemo libero rerum qui commodi quam vel. Autem error nulla exercitationem architecto quod qui. </div>
  </div>
</div>
<!--- Modal Popup ---->