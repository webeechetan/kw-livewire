<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard', session('org_id') ) }}"><i class='bx bx-line-chart'></i> {{ ucfirst(Auth::user()->organization->name)  }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row g-3">
        <div class="col-xl-9">
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0 h-100 py-2 px-3">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h4 class="mb-2">Hey Welcome, {{ Auth::guard(session('guard'))->user()->name }} 🤖</h4>
                                <p class="text-muted mb-0">Glad to have you back. Let’s see what’s new and keep things running smoothly.</p>
                            </div>
                            <div class="welcome-box-img">
                                <img src="{{ asset('assets/images/welcome-img.png') }}" width="115" style="margin-top: -65px;" alt="Kaykewalk Welcome" />                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="row g-3">
                        <!-- Active Projects -->
                        <div class="col-md-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="icon-box" style="background-color:#eafaf0;">
                                            <i class='bx bx-objects-horizontal-left text-success'></i>
                                        </div>
                                        <div>
                                            <span class="text-muted font-500">Active Projects</span>
                                            <h5 class="mb-0">{{ $totalProjects }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Overdue Tasks -->
                        <div class="col-sm-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-danger-light">
                                                <i class='bx bx-task text-danger'></i>
                                            </div>
                                            <div>
                                                <span class="text-muted font-500">Overdue Tasks</span>
                                                <h5 class="mb-0">
                                                    {{ $users_tasks->where('due_date', '<', today())->where('status','!=','completed')->count() }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- In Review Tasks -->
                        <div class="col-sm-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-warning-light">
                                                <i class='bx bx-task text-warning'></i>
                                            </div>
                                            <div>
                                                <span class="text-muted font-500">In Review Tasks</span>
                                                <h5 class="mb-0">
                                                    {{ $users_tasks->where('status', 'in_review')->count() }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Accepted Tasks -->
                        <div class="col-md-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box" style="background-color:#e8f7ff;">
                                                <i class='bx bx-task text-info'></i>
                                            </div>
                                            <div>
                                                <span class="text-muted font-500">Accepted Tasks</span>
                                                <h5 class="mb-0">
                                                    {{ $users_tasks->where('status','in_progress')->count() }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Priority Tasks -->
                        <div class="col-sm-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box" style="background-color:#F4F0FF;">
                                                <i class='bx bx-pin text-primary'></i>
                                            </div>
                                            <div>
                                                <span class="text-muted font-500">Priority Tasks</span>
                                                <h5 class="mb-0">
                                                    {{ $users_tasks->where('priority', 'high')->where('status','!=','completed')->count() }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Today's Tasks -->
                        <div class="col-sm-6">
                            <a href="#">
                                <div class="card shadow-sm border-0 h-100">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-secondary-light">
                                                <i class='bx bx-calendar text-secondary'></i>
                                            </div>
                                            <div>
                                                <span class="text-muted font-500">Meetings/Events</span>
                                                <h5 class="mb-0">
                                                    @php
                                                        $meetingCount = $users_tasks->filter(function ($task) {
                                                            return isset($task['tag']['name'], $task['status']) &&
                                                                strtolower(trim($task['tag']['name'])) === 'meeting' &&
                                                                strtolower($task['status']) !== 'completed';
                                                        })->count();

                                                        $eventTags = ['client event', 'office event'];
                                                        $eventCount = $users_tasks->filter(function ($task) use ($eventTags) {
                                                            return isset($task['tag']['name']) &&
                                                                in_array(strtolower(trim($task['tag']['name'])), $eventTags);
                                                        })->count();
                                                    @endphp

                                                    <span> <i class='bx bx-time text-secondary text-md' ></i>{{ $meetingCount }} / <i class='bx bx-calendar-event text-secondary text-md'></i>{{ $eventCount }}</span>

                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Tasks Overview -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">Performance Overview</h4>
                            <div class="text-center">
                                <div id="progress-chart-gauge" style="width: 100%;height: 260px; margin-top: -15px; margin-bottom: -102px;"></div>
                                <div>
                                    Progress
                                    <b>
                                        <span class="text-success">
                                            {{ round($users_tasks->where('status','completed')->count() > 0 ?
                                            ($users_tasks->where('status','completed')->count() / $users_tasks->count()) * 100 :
                                            0)}}%
                                        </span>
                                    </b>
                                </div>
                            </div>
                            <div class="row mt-1 task-details text-center">
                                <div class="col-md-6">
                                    <h6><b>{{ $users_tasks->where('status','in_progress')->count()}}</b></h6>
                                    <div>On Going</div>
                                </div>
                                <div class="col-md-6">
                                    <h6><b>{{ $users_tasks->where('status','pending')->count()}}</b></h6>
                                    <div>Unfinished</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="row g-3">
                <div class="col-12">
                    <!-- Todo's List -->
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="todo-box">
                                <h5 class="card-title">Todo List</h5>

                                <!-- Filter -->
                                <div class="filter d-flex gap-2">
                                    <button class="filter-btn" data-filter="all">All</button>
                                    <button class="filter-btn active" data-filter="pending">Pending</button>
                                    <button class="filter-btn" data-filter="completed">Completed</button>
                                </div>

                                <div class="todo-input mt-2">
                                    <input type="text" id="todo-input" placeholder="Add new task..." />
                                    <button onclick="addTodo()"><i class='bx bx-plus'></i></button>
                                </div>

                                <div class="position-relative">
                                    <ul id="todo-list" class="p-0 mt-2 mb-0 scrollbar"></ul>
                                    <div id="completed-image" class="todo-completed-image" style="display: none;">
                                        <h3 class="font-400 text-light">Todo-free <br/> Stress-free</h3>
                                        <picture>
                                            <source srcset="https://fonts.gstatic.com/s/e/notoemoji/latest/1f60e/512.webp" type="image/webp">
                                            <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f60e/512.gif" alt="😎" width="90" height="90">
                                        </picture>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-9">
            <div class="row g-3">
                <!-- Task Calendar -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h4 class="card-title">Weekly Tasks Summery </h4>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Tasks Statistics -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="mb-0">Tasks Overview</h5>
                            <p class="text-muted">Overview of your monthly post tasks.</p>
                        </div>
                        <div id="projectChart" style="height: 480px; margin-top: -130px;"></div>
                    </div>
                </div>

                <!-- Important Projects -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h4 class="card-title">Important Projects</h4>
                            <div class="row">
                                <div class="scrollbar">
                                    <div style="height: 350px;">
                                        @forelse($mostImportantProjects as $project)
                                            <a class="mb-2 d-block" href="{{ route('project.tasks', $project->id) }}">
                                                <div class="card bg-light shadow-sm border-0">
                                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                                    <div class="card-body">
                                                        <span class="text-muted"><i class="bx bx-briefcase-alt-2 text-secondary"></i> {{ $project->client->name}}</span>
                                                        <h6 class="mb-2 font-500">{{ $project->name }}</h6>
                                                        <div class="text-danger text-sm"><i class="bx bx-calendar"></i> <span>{{ \Carbon\Carbon::parse($project->due_date)->format('M d Y')
                                                        ?? 'No Due Date' }}</span></div>
                                                    </div>
                                                </div>
                                            </a>
                                            @empty
                                            <div class="d-flex justify-content-center align-items-center bg-grey h-100 border-radius-10">
                                                <span class="text-light">No Data Found!</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pin Projects -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h4 class="card-title">Pin Projects</h4>
                            <div class="row">
                                <div class="scrollbar">
                                    <div style="height: 350px;">
                                        @forelse($myPins as $pin)
                                        @php
                                            $project = $pin->pinnable;
                                        @endphp
                                            <div class="card hover-arrow bg-light shadow-sm border-0 mb-2 pin-id-{{ $pin->id }}">
                                                <a class="card-open" href="{{ route('project.profile', $pin->pinnable_id) }}" :key="$pin->pinnable_id"><i class="bx bx-chevron-right"></i></a>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-auto pe-0">
                                                            <livewire:components.pin-button pinnable_type="App\Models\Project" :pinnable_id="$project->id" content='' />
                                                        </div>
                                                        <div class="col">
                                                            <span class="text-muted"><i class="bx bx-briefcase-alt-2 text-secondary"></i> {{ $pin->project->client->name}}</span>
                                                            <h6 class="font-500"><a href="{{ route('project.profile', $pin->pinnable_id) }}" :key="$pin->pinnable_id">{{ $pin->project->name }}</a></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="d-flex justify-content-center align-items-center bg-grey h-100 border-radius-10">
                                                <span class="text-light">No Data Found!</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <!-- Recent Comments -->
            <div class="card shadow-sm border-0 h-100 h-100">
                <div class="card-body">
                    <h4 class="card-title">Recent Comments</h4>
                    <div class="scrollbar">
                        <div style="height: 820px;">
                            @foreach($recent_comments as $comment)
                                <div class="mb-4 border-bottom-list">
                                    <a class="d-block" href="javascript:void(0)" wire:click="$dispatch('editTask', [{{$comment->task_id}}] )">
                                        <div class="text-sm mb-2"><i class="bx bx-task"></i> {!! Str::limit(strip_tags($comment->task->name), 85, '...') !!}</div>
                                        <div class="d-flex gap-1 mb-3">
                                            <span><x-avatar :user="$comment->user" class="avatar-sm" /></span>
                                            <div class="comment-text">
                                                <span class="d-flex text-muted text-xs mb-1">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                                <span class="text-md">{!! Str::limit(strip_tags($comment->comment), 70, '...') !!}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
            $color = '#4F9F54';
        }else{ 
            if($task->status == 'in_progress'){ 
                $color='#e7bf1d';
            }elseif ($task->status == 'in_review') {
                $color='#7407ff';
            }else{
                $color='#48914d';
            }        
        } 
        $events[]=[ 'title'=> $task->name,
            'start' => $task->due_date,
            // 'url' => route('task.view', $task->id),
            'backgroundColor' => $color,
            'classNames' => 'edit-task',
            'extendedProps' => [
                'task_id' => $task->id,
            ],
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
    <script src="{{ asset('assets/js/todo.js') }}"></script>
    @endassets

    @script
    <script>
        // hide pin-id if togglePin event is dispatched
        window.addEventListener('togglePin', function (event) {
            const pinId = event.detail;
            const pinElement = document.querySelector('.pin-id-' + pinId);
            if (pinElement) {
                pinElement.style.display = 'none';
            }
        });

        $(document).ready(function () {

            // Project Chart
            const projectChartDom = document.getElementById('projectChart');
            const projectChart = echarts.init(projectChartDom);

            const projectData = [
                { value: 12, name: 'In-review' },
                { value: 20, name: 'Active' },
                { value: 8, name: 'Completed' }
            ];

            const projectOption = {
                color: ['#e7bf1d', '#e5d1ff', '#2ecc71'],
                tooltip: {
                    trigger: 'item',
                    formatter: '{b} : {c} Task ({d}%)'
                },
                legend: {
                    bottom: '15px',
                    formatter: name => {
                        const item = projectData.find(i => i.name === name);
                        return `${name} (${item.value})`;
                    }
                },
                series: [{
                    name: 'Task',
                    type: 'pie',
                    radius: ['20%', '40%'],
                    roseType: 'area',
                    data: projectData,
                    label: {
                        show: true,
                        formatter: '{b}\n{c} Tasks'
                    }
                }]
            };

            projectChart.setOption(projectOption);

            window.addEventListener('resize', function() {
                aiUsageChart.resize();
                projectChart.resize();
            });

            // calendar

            var events = @json($events);
            var calendarEl = document.getElementById('calendar');

            const originalEvents = [...events];

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listWeek',
                events: originalEvents,
                dayMaxEventRows: true,
                moreLinkClick: 'popover',
                moreLinkClassNames: 'calendar-more-link-btn',
                headerToolbar: {
                    left: 'title,todayBtn,resetBtn prev,next',
                    right: 'meetingBtn,clientEventBtn,officeEventBtn'
                },
                eventClick: function(info) {
                    const taskId = info.event.extendedProps.task_id;
                    // trigger the edit task event
                    Livewire.dispatch('editTask',[taskId]);
                },
                customButtons: {
                    todayBtn: {
                        text: "Today's Tasks",
                        click: function () {
                            setActiveButton('todayBtn');
                            const today = new Date().toISOString().split('T')[0];

                            const todayEvents = originalEvents.filter(event =>
                                new Date(event.start).toISOString().split('T')[0] === today
                            );

                            calendar.removeAllEvents();
                            calendar.addEventSource(todayEvents);
                            calendar.changeView('listDay', today);
                        }
                    },
                    meetingBtn: {
                        text: "Meetings",
                        click: function () {
                            setActiveButton('meetingBtn');
                            const filtered = originalEvents.filter(event =>
                                event.tag?.name?.toLowerCase().trim() === 'meeting'
                            );

                            calendar.removeAllEvents();
                            calendar.addEventSource(filtered);
                            calendar.changeView('listWeek');
                        }
                    },
                    clientEventBtn: {
                        text: "Client Events",
                        click: function () {
                            setActiveButton('clientEventBtn');
                            const filtered = originalEvents.filter(event =>
                                event.tag?.name?.toLowerCase().trim() === 'client event'
                            );

                            calendar.removeAllEvents();
                            calendar.addEventSource(filtered);
                            calendar.changeView('listWeek');
                        }
                    },
                    officeEventBtn: {
                        text: "Office Events",
                        click: function () {
                            setActiveButton('officeEventBtn');
                            const filtered = originalEvents.filter(event =>
                                event.tag?.name?.toLowerCase().trim() === 'office event'
                            );

                            calendar.removeAllEvents();
                            calendar.addEventSource(filtered);
                            calendar.changeView('listWeek');
                        }
                    },
                    resetBtn: {
                        text: '',
                        click: function () {
                            setActiveButton(null);
                            calendar.removeAllEvents();
                            calendar.addEventSource(originalEvents);
                            calendar.changeView('listWeek');
                        }
                    }
                }

            });

            function setActiveButton(buttonKey) {
                const buttons = ['meetingBtn', 'clientEventBtn', 'officeEventBtn', 'todayBtn'];

                buttons.forEach(key => {
                    const el = document.querySelector(`.fc-${key}-button`);
                    if (el) {
                        if (key === buttonKey) {
                            el.classList.add('active');
                        } else {
                            el.classList.remove('active');
                        }
                    }
                });
            }

            calendar.render();

            // Inject icon after render
            setTimeout(() => {
                const meetingBtn = document.querySelector('.fc-meetingBtn-button');
                if (meetingBtn && !meetingBtn.dataset.rendered) {
                    meetingBtn.innerHTML = '<i class="bx bx-group"></i> Meetings';
                    meetingBtn.dataset.rendered = 'true';
                }

                const clientBtn = document.querySelector('.fc-clientEventBtn-button');
                if (clientBtn && !clientBtn.dataset.rendered) {
                    clientBtn.innerHTML = '<i class="bx bx-user-voice"></i> Client Events';
                    clientBtn.dataset.rendered = 'true';
                }

                const officeBtn = document.querySelector('.fc-officeEventBtn-button');
                if (officeBtn && !officeBtn.dataset.rendered) {
                    officeBtn.innerHTML = '<i class="bx bx-building"></i> Office Events';
                    officeBtn.dataset.rendered = 'true';
                }

                const resetBtnEl = document.querySelector('.fc-resetBtn-button');
                if (resetBtnEl && !resetBtnEl.dataset.rendered) {
                    resetBtnEl.innerHTML = '<i class="bx bx-refresh"></i>';
                    resetBtnEl.title = 'Reset Calendar';
                    resetBtnEl.dataset.rendered = 'true';
                }
            }, 100);

            // Reset function
            function resetCalendar() {
                setTimeout(() => {
                    const todayBtnEl = document.querySelector('.fc-todayBtn-button');
                    if (todayBtnEl) todayBtnEl.classList.remove('active');

                    calendar.removeAllEvents();
                    calendar.addEventSource(originalEvents);
                    calendar.changeView('listWeek');
                }, 10);
            }


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
                            color: '#4F9F54',
                            shadowColor: 'rgba(0,138,255,0.45)',
                        },
                        progress: {
                            show: true,
                            roundCap: false,
                            width: 18,
                            itemStyle: {
                                color: '#4F9F54',
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
                            show:false
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
                color: [
                    '#f83890', 
                    '#7407ff', 
                    '#e7bf1d', 
                    '#dc3545',
                    '#48914d'
                ],
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
                        {value: {{$users_tasks->where('status', 'pending')->where('status','!=','completed')->count()}}, name: 'Assigned Tasks'},
                        {value: {{$users_tasks->where('status', 'in_progress')->where('status','!=','completed')->count()}}, name: 'Accepted Tasks'},
                        {value: {{$users_tasks->where('status', 'in_review')->where('status','!=','completed')->count()}}, name: 'In Review Tasks'},
                        {value: {{$users_tasks->where('due_date', '<', now())->where('status','!=','completed')->count()}}, name: 'Overdue Tasks'},
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

        // 
        document.addEventListener('DOMContentLoaded', function () {
            var meetingCalendarEl = document.getElementById('calendarMeetingEvent');

            // Filter only Meeting/Event tasks from existing events
            const meetingEvents = events.filter(event => {
                const title = event.title.toLowerCase();
                return title.includes('meeting') || title.includes('event');
            });

            const meetingCalendar = new FullCalendar.Calendar(meetingCalendarEl, {
                initialView: 'listWeek',
                events: meetingEvents,
                headerToolbar: {
                    left: 'title',
                    right: 'prev,next'
                },
                eventClick: function(info) {
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                        info.jsEvent.preventDefault(); // don't let the browser follow the link
                    }
                },
                dayMaxEventRows: true,
                moreLinkClick: 'popover',
                height: 'auto',
            });

            meetingCalendar.render();
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