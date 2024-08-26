<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> {{ Auth::user()->organization ? Auth::user()->organization->name : 'No organization' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <div class="box-item h-100">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="welcome-box">
                            <h4 class="mb-1"><span class="fw-normal">Hi {{ Auth::guard(session('guard'))->user()->name }}</span>,</h4>
                            <h3><b>Welcome back</b></h3>
                            {{-- @if(session()->has('newly_registered'))
                                <p class="text-muted">You have successfully registered. Please check your email to verify your account.</p>
                            @endif --}}
                            {{-- {{ Auth::user()->roles->pluck('name') }} --}}
                        </div>
                    </div>
                    <div class="col-md-5 text-end">
                        <div class="welcome-box-img">
                            <img src="./assets/images/welcome-img.png" alt="Kaykewalk Welcome" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-item h-100">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Task Overview</h4>
                        <h6>On Progress <b><span class="text-success">70%</span></b></h6>
                        <div class="row mt-5">
                            <div class="col-auto"><img src="./assets/images/dashboard_chart_small.png" alt=""></div>
                            <div class="col">
                                <h5 class="mb-0"><b>246</b></h5>
                                <div>Total Projects</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><img src="./assets/images/dashboard_chart_2.png" alt="" width="130"></div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-success"><i class='bx bxs-circle'></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6><b>167</b></h6>
                                        <div>On Going</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-warning"><i class='bx bxs-circle'></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6><b>28</b></h6>
                                        <div>Unfinished</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="box-item h-100">
                <h4>Important Projects</h4>
                <hr>
                <div>
                    <div class="row mb-3">
                        <div class="col-auto pe-md-1">
                            <img src="./assets/images/project_img1.png" alt="" width="60">
                        </div>
                        <div class="col">
                            <h5 class="mb-1">Big Wind</h5>
                            <div>Global Acma</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="btn btn-success rounded-pill btn-xs text-uppercase">SEO</a>
                        <a href="#" class="btn btn-secondary rounded-pill btn-xs text-uppercase">Website</a>
                        <a href="#" class="btn btn-primary rounded-pill btn-xs text-uppercase">Social Media</a>
                    </div>
                    <div class="progress mt-4">
                        <div class="progress-bar progress-secondary" role="progressbar" aria-label="Task Done" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col"><b>12</b> <span>Task Done</span></div>
                        <div class="col text-end text-danger"><i class="bx bx-calendar"></i> <span>24 Aug, 2024</span></div>
                    </div>
                </div>
                <hr class="my-4">
                <div>
                    <div class="row mb-3">
                        <div class="col-auto pe-md-1">
                            <img src="./assets/images/project_img2.png" alt="" width="60">
                        </div>
                        <div class="col">
                            <h5 class="mb-1">Circle Hunt</h5>
                            <div>Haldiraam</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="btn btn-success rounded-pill btn-xs text-uppercase">SEO</a>
                        <a href="#" class="btn btn-secondary rounded-pill btn-xs text-uppercase">Website</a>
                        <a href="#" class="btn btn-primary rounded-pill btn-xs text-uppercase">Social Media</a>
                    </div>
                    <div class="progress mt-4">
                        <div class="progress-bar progress-secondary" role="progressbar" aria-label="Task Done" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col"><b>12</b> <span>Task Done</span></div>
                        <div class="col text-end text-danger"><i class="bx bx-calendar"></i> <span>24 Aug, 2024</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="box-item h-100">
                        <h4>Your Progress</h4>
                        <hr>
                        <div class="text-center"><img src="./assets/images/dashboard_chart_3.png" alt=""></div>
                        <div class="row mt-4">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-secondary"><i class="bx bxs-circle"></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6 class="mb-0">Active Projects</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <h6 class="mb-0 text-secondary"><b>50</b></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-danger"><i class="bx bxs-circle"></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6 class="mb-0 text-danger">Overdue Tasks</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <h6 class="mb-0 text-danger"><b>150</b></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-warning"><i class="bx bxs-circle"></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6 class="mb-0">Active Tasks</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <h6 class="mb-0 text-warning"><b>150</b></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-success"><i class="bx bxs-circle"></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6 class="mb-0">Completed Tasks</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <h6 class="mb-0 text-success"><b>154</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="box-item h-100">
                        <h4>Your Tasks</h4>
                        <hr>
                        <ul class="nav nav-pills nav-pills-sm mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="true">Upcoming <span class="btn-batch">12</span></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-overdue-tab" data-bs-toggle="pill" data-bs-target="#pills-overdue" type="button" role="tab" aria-controls="pills-overdue" aria-selected="false">Overdue <span class="btn-batch">12</span></button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab" tabindex="0">
                                <div class="taskList scrollbar">
                                    <div style="height: 307px;">
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch ">31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>Add T&D in the policy page and add background color</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch">31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>add tsoi client smile</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-2"><a href="#" class="btn-link">See More</a></div>
                            </div>
                            <div class="tab-pane fade" id="pills-overdue" role="tabpanel" aria-labelledby="pills-overdue-tab" tabindex="0">
                                <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="taskList_col taskList_col_title">
                                                <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                <div class="edit-task" data-id="1">
                                                    <div>add tsoi client smile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="taskList_col"><span class="btn-batch ">31 Aug</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="taskList_col taskList_col_title">
                                                <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                <div class="edit-task" data-id="1">
                                                    <div>add tsoi client smile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="taskList_col"><span class="btn-batch">31 Aug</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="taskList_col taskList_col_title">
                                                <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                <div class="edit-task" data-id="1">
                                                    <div>add tsoi client smile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="taskList_col taskList_col_title">
                                                <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                <div class="edit-task" data-id="1">
                                                    <div>add tsoi client smile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                    <div class="row">
                                        <div class="col">
                                            <div class="taskList_col taskList_col_title">
                                                <div class="taskList_col_title_open edit-task" data-id="1"><i class="bx bx-chevron-right"></i></div>
                                                <div class="edit-task" data-id="1">
                                                    <div>add tsoi client smile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="taskList_col"><span class="btn-batch"> 31 Aug</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $tour = session()->get('tour');

    // if(isset($tour) && $tour != 'null'){
    //     dd($tour);
    // }else{
    //     dd('not set');
    // }

@endphp




{{-- @if($tour['main_tour']) --}}
@if(isset($tour) && $tour != null && isset($tour['main_tour']))

    @assets
        <link href="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/minified/introjs.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/intro.min.js"></script>
    @endassets
@endif


{{-- @if($tour['main_tour'])  --}}
@if(isset($tour) && $tour != null && isset($tour['main_tour']))

    @script
            <script>
                introJs() 
                .setOptions({
                showProgress: true,
                })
                .onbeforeexit(function () {
                    location.href = "{{ route('dashboard') }}?tour=close-main-tour";
                })
                .start();
            </script>
    @endscript
@endif