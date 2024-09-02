<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard', session('org_id') ) }}"><i
                        class='bx bx-line-chart'></i> {{ Auth::user()->organization ? Auth::user()->organization->name :
                    'No organization' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <div class="box-item h-100">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="welcome-box">
                            <h4 class="mb-1"><span class="fw-normal">Hi {{ Auth::guard(session('guard'))->user()->name
                                    }}</span>,</h4>
                            <h3><b>Welcome back</b></h3>
                            {{-- @if(session()->has('newly_registered'))
                            <p class="text-muted">You have successfully registered. Please check your email to verify
                                your account.</p>
                            @endif --}}
                            {{-- {{ Auth::user()->roles->pluck('name') }} --}}
                        </div>
                    </div>
                    <div class="col-md-5 text-end">
                        <div class="welcome-box-img">
                            {{-- <img src="{{ asset('') }}assets/images/welcome-img.png" alt="Kaykewalk Welcome" /> --}}
                            <img src="{{ asset('assets/images/welcome-img.png') }}" alt="Kaykewalk Welcome" />
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
                        <h6>In Progress <b><span class="text-success">
                                    {{ round($users_tasks->where('status','completed')->count() > 0 ?
                                    ($users_tasks->where('status','completed')->count() / $users_tasks->count()) * 100 :
                                    0)}}%
                                </span></b></h6>
                        <div class="row mt-5">
                            <div class="col-auto"><img src="{{ asset('') }}assets/images/dashboard_chart_small.png"
                                    alt=""></div>
                            <div class="col">
                                <h5 class="mb-0"><b>{{ $users_tasks->count()}}</b></h5>
                                <div>Total Tasks</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <div id="progress-chart-gauge" style="width: 100%;height: 250px;">

                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-auto pe-md-0">
                                        <div class="text-success"><i class='bx bxs-circle'></i></div>
                                    </div>
                                    <div class="col ps-md-2">
                                        <h6><b>{{ $users_tasks->where('status','in_progress')->count()}}</b></h6>
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
                                        <h6><b>{{ $users_tasks->where('status','pending')->count()}}</b></h6>
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
                @foreach($mostImportantProjects as $project)
                <div>
                    <div class="row mb-3">
                        <div class="col-auto pe-md-1">
                            <img src="{{ asset('') }}assets/images/project_img1.png" alt="" width="60">
                        </div>
                        <div class="col">
                            <h5 class="mb-1">{{ $project->name }}</h5>
                            <div>{{ $project->client->name}}</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        @if($project->teams)
                        @foreach($project->teams as $team)
                        <a href="#" class="btn btn-success rounded-pill btn-xs text-uppercase">{{$team->name}}</a>
                        @endforeach
                        @endif
                    </div>
                    @php
                    $taskDone = $project->tasks->where('status', 'completed')->count();
                    $totalTask = $project->tasks->count();

                    if ($totalTask > 0) {
                    $percentage = ($taskDone / $totalTask) * 100;
                    } else {
                    $percentage = 0;
                    }
                    @endphp
                    <div class="progress mt-4">
                        <div class="progress-bar progress-secondary" role="progressbar" aria-label="Task Done"
                            style="width: {{$percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col"><b>{{ $taskDone }}</b> <span>Task Done</span></div>
                        <div class="col text-end text-danger"><i class="bx bx-calendar"></i> <span>{{ $project->due_date
                                ?? 'No Due Date' }}</span></div>
                    </div>
                </div>
                <hr class="my-4">
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="box-item h-100">
                        <h4>Your Progress</h4>
                        <hr>
                        <div class="text-center" id="user-progress-pie-chart" style="width: 100%;height: 250px;"></div>
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
                                <h6 class="mb-0 text-secondary"><b>{{$active_projects}}</b></h6>
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
                                <h6 class="mb-0 text-danger"><b>{{ $users_tasks->where('due_date', '<', now())->where('status','!=','completed')->
                                            count();}}</b></h6>
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
                                <h6 class="mb-0 text-warning"><b>{{ $users_tasks->where('status',
                                        'in_progress')->count();}}</b></h6>
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
                                <h6 class="mb-0 text-success"><b>{{
                                        $users_tasks->where('status','completed')->count();}}</b></h6>
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
                                <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-upcoming" type="button" role="tab"
                                    aria-controls="pills-upcoming" aria-selected="true">Upcoming <span
                                        class="btn-batch">{{ $users_tasks->where('due_date', '>',
                                        now())->where('status','!=','completed')->count();}}</span></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-overdue-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-overdue" type="button" role="tab"
                                    aria-controls="pills-overdue" aria-selected="false">Overdue <span
                                        class="btn-batch">{{ $users_tasks->where('due_date', '<', now())->where('status','!=','completed')->
                                            count();}}</span></button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                                aria-labelledby="pills-upcoming-tab" tabindex="0">
                                @foreach($users_tasks->where('due_date', '>', now())->take(10) as $task)
                                <div class="taskList scrollbar">
                                    <div style="height: 307px;">
                                        <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="taskList_col taskList_col_title">
                                                        <div class="taskList_col_title_open edit-task" data-id="1"><i
                                                                class="bx bx-chevron-right"></i></div>
                                                        <div class="edit-task" data-id="1">
                                                            <div>{{$task->name}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="taskList_col"><span class="btn-batch ">{{
                                                            Carbon\Carbon::parse($task->due_date)->format('d M')
                                                            }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="text-center mt-2"><a href="{{ route('task.index') }}" wire:navigate
                                        class="btn-link">See More</a></div>
                            </div>
                            <div class="tab-pane fade" id="pills-overdue" role="tabpanel"
                                aria-labelledby="pills-overdue-tab" tabindex="0">
                                @foreach($users_tasks->where('due_date', '<', now())->where('status','!=','completed')->take(10) as $task)
                                    <div class="taskList_row edit-task" data-id="1" wire:key="task-row-1">
                                        <div class="row">
                                            <div class="col">
                                                <div class="taskList_col taskList_col_title">
                                                    <div class="taskList_col_title_open edit-task" data-id="1"><i
                                                            class="bx bx-chevron-right"></i></div>
                                                    <div class="edit-task" data-id="1">
                                                        <div>{{ $task->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="taskList_col"><span class="btn-batch ">{{
                                                        Carbon\Carbon::parse($task->due_date)->format('d M') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="box-item h-100">
                <h4>Calendar</h4>
                <hr>
                <div id="calendar"></div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="box-item h-100">
                <h4>Recent Comments</h4>
                <hr>
                @foreach($recent_comments as $comment)
                <div class="cmnt_item_row">
                    <div class="cmnt_item_user">
                        <div class="cmnt_item_user_img">
                            <x-avatar :user="$comment->user" />
                        </div>
                        <div class="cmnt_item_user_name-wrap">
                            <div class="cmnt_item_user_name">{{ $comment->user->name }}</div>
                            <div class="cmnt_item_date">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div>
                            <div class="cmnt_item_user_text">{!! $comment->comment !!}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@php
    $tour = session()->get('tour');
    $events = [];
    foreach($users_tasks as $task){
        $color = '';
        if($task->status == 'completed'){
            $color = 'green';
        }else{
            if($task->due_date < now()){ $color='red' ; }else{ $color='green' ; } 
        } 
        $events[]=[ 'title'=> $task->name,
            'start' => $task->due_date,
            'url' => route('task.view', $task->id),
            'backgroundColor' => $color,
            ];
    }

    @endphp

    @assets
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://fastly.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    @if(isset($tour) && $tour != null && isset($tour['main_tour']))
    <link href="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/minified/introjs.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/intro.min.js"></script>
    @endif
    @endassets

    @script
    <script>
        $(document).ready(function () {

            var events = @json($events);
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events,
            });
            calendar.render();

            // progress pie chart

            var dom = document.getElementById('progress-chart-gauge');
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option;

            option = {
                series: [
                    {
                        type: 'gauge',
                        startAngle: 180,
                        endAngle: 0,
                        min: 0,
                        max: 100,
                        splitNumber: 10,
                        itemStyle: {
                            color: '#7407ff',
                            shadowColor: 'rgba(0,138,255,0.45)',
                        },
                        progress: {
                            show: true,
                            roundCap: false,
                            width: 18,
                            itemStyle: {
                                color: 'rgb(220 53 69)',
                                shadowColor: 'rgba(0,138,255,0.45)',
                                shadowBlur: 10,
                                shadowOffsetX: 2,
                                shadowOffsetY: 2,
                            },
                        },
                        pointer: {
                            icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
                            length: '80%',
                            width: 16,
                            offsetCenter: [0, '5%'],
                            
                        },
                        axisLine: {
                            roundCap: false,
                            lineStyle: {
                                width: 18
                            }
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            show: false
                        },
                        axisLabel: {
                            show: false
                        },
                        title: {
                            show: false
                        },
                        detail: {
                            backgroundColor: '#fff',
                            borderColor: '#999',
                            borderWidth: 2,
                            width: '60%',
                            lineHeight: 15,
                            height: 15,
                            borderRadius: 8,
                            offsetCenter: [0, '45%'],
                            valueAnimation: true,
                            formatter: function (value) {
                                return '{value|' + value.toFixed(0) + '}{unit|%}';
                            },
                            rich: {
                                value: {
                                    fontSize: 15,
                                    fontWeight: 'bolder',
                                    color: '#777'
                                },
                                unit: {
                                    fontSize: 15,
                                    color: '#999',
                                }
                            }
                        },
                        data: [
                            {
                                value:  {{ round($users_tasks->where('status','completed')->count() > 0 ?
                                    ($users_tasks->where('status','completed')->count() / $users_tasks->count()) * 100 :
                                    0)}}                               
                            }
                        ]
                    }
                ]
            };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }
            window.addEventListener('resize', myChart.resize);


            // user progress pie chart

            var dom = document.getElementById('user-progress-pie-chart');

            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });

            var app = {};

            var option;

            option = {
                color: ['#8B00FF', '#FF6347', '#FFD700', '#32CD32'],
                tooltip: {
                    trigger: 'item',
                    formatter: '{b}: {c} ({d}%)',
                },
                legend: {
                    show: false
                },
                series: [
                    {
                    name: 'Your Progress',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                        show: true,
                        fontSize: 20,
                        fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        {value: {{$active_projects}}, name: 'Active Projects'},
                        {value: {{$users_tasks->where('due_date', '<', now())->where('status','!=','completed')->count()}}, name: 'Overdue Tasks'},
                        {value: {{$users_tasks->where('status','in_progress')->count()}}, name: 'Active Tasks'},
                        {value: {{$users_tasks->where('status','completed')->count()}}, name: 'Completed Tasks'}

                    ]
                    }
                ]
                };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }
            window.addEventListener('resize', myChart.resize);


        });
    </script>
    @if(isset($tour) && $tour != null && isset($tour['main_tour']))
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
    @endif
    @endscript