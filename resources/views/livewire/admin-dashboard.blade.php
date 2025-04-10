<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard', session('org_id') ) }}"><i class='bx bx-line-chart'></i> {{ ucfirst(Auth::user()->organization->name)  }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-xl-9">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0 py-2 px-3">
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h4 class="card-title mb-2">Welcome back, John 👋</h4>
                                <p class="card-text text-muted mb-0">
                                    Here's what's happening with your dashboard today.
                                </p>
                            </div>
                            <div class="welcome-icon text-primary">
                                <span class="avatar avatar-xl avatar-green" data-toggle="tooltip" data-placement="top" data-bs-original-title="John Wick">JW</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box" style="background-color:#e8f7ff;">
                                        <i class='bx bx-briefcase-alt-2 text-info'></i>
                                    </div>
                                    <div>
                                        <span class="text-muted">Total Clients</span>
                                        <h5 class="mb-0">10</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Total Post -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#eafaf0;">
                                    <i class='bx bx-file text-success'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Total Projects</span>
                                    <h5 class="mb-0">10</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Storage Used -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#fff4e6;">
                                    <i class='bx bx-user text-warning'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Tottal User</span>
                                    <h5 class="mb-0">30</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Social Accounts -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#f4f0ff;">
                                    <i class='bx bx-link text-primary'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Social Accounts</span>
                                    <h5 class="mb-0">1</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Reactions -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#e8f7ff;">
                                    <i class='bx bx-like text-info'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Total Posts</span>
                                    <h5 class="mb-0">30</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Content Calendar -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#eafaf0;">
                                    <i class='bx bxs-edit text-success'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Content Calendar</span>
                                    <h5 class="mb-0">30</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Post Statistics -->
                <div class="col-md-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-0">Post Statistics</h5>
                            <p class="text-muted">Overview of your post performance.</p>
                        </div>
                        <div id="postStatsChart" style="height: 400px; margin-top: -60px;"></div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row gap-3">
                        <!-- Total Teams -->
                        <div class="col-12">
                            <a href="#">
                                <div class="card shadow-sm border-0">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="icon-box" style="background-color:#E8F7FF;">
                                            <i class='bx bx-sitemap text-info'></i>
                                        </div>
                                        <div>
                                            <span class="text-muted">Total Teams</span>
                                            <h6 class="mb-0 font-500">10</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Storage -->
                        <div class="col-12">
                            <a href="#">
                                <div class="card shadow-sm border-0">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="icon-box" style="background-color:#FDECCE;">
                                            <i class='bx bx-memory-card text-warning'></i>
                                        </div>
                                        <div>
                                            <span class="text-muted">Storage Used</span>
                                            <h6 class="mb-0 font-500">120.60 <span class="text-sm fw-normal">MB | 512 GB Left</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- AI Word Count -->
                        <div class="col-12">
                            <a href="#">
                                <div class="card shadow-sm border-0">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="icon-box" style="background-color:#EAFAF0;">
                                            <i class='bx bx-message-alt-dots text-success' ></i>
                                        </div>
                                        <div>
                                            <span class="text-muted">AI Word Counts</span>
                                            <h6 class="mb-0 font-500">50,000 <span class="text-sm fw-normal">| 35,000 Left</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Post Limit -->
                        <div class="col-12">
                            <a href="#">
                                <div class="card shadow-sm border-0">
                                    <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="icon-box" style="background-color:#f4f0ff;">
                                            <i class='bx bx-receipt text-primary'></i>
                                        </div>
                                        <div>
                                            <span class="text-muted">Post Limit</span>
                                            <h6 class="mb-0 font-500">500 <span class="text-sm fw-normal">| 150 Left</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="h-100">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header d-flex align-items-center gap-2"> 
                        <i class='bx bx-link text-primary bx-sm'></i>
                        <h6>Latest Activity</h6>
                    </div>
                    <div class="card-body" style="height: 365px;">
                        No Data
                    </div>
                </div>
                <div class="pricing-card">
                    <h5 class="mb-3">Premium Monthly</h5>
                    <p class="mb-4">Flexible monthly plan for consistent social media management.</p>
                    <button class="btn btn-upgrade">Upgrade Now</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pnboarding Popup -->
    <div class="onboarding-popup" id="onboardingPopup">
        <div class="onboarding-header">
            <div>Getting Started</div>
            <i class='bx bx-x' id="closePopup"></i>
        </div>

        <span class="text-sm" id="progressText">0% Complete</span>
        <div class="progress">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-user-plus'></i> Onboard your first client
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-folder-plus'></i> Add your first project
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-group'></i> Create your teams
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-calendar'></i> Create your first content calendar
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-edit'></i> Create your first post
        </div>

        <div id="stepCounter">
            <i class='bx bx-rocket'></i> <span id="completedCount">0/5</span>
        </div>
    </div>
</div>

@assets
<!-- Include echarts CDN -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
@endassets

@script
<script>
    const steps = document.querySelectorAll('.onboarding-step');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const completedCount = document.getElementById('completedCount');

    function completeStep(element) {
        element.classList.toggle('completed');

        const completedSteps = document.querySelectorAll('.onboarding-step.completed').length;
        const totalSteps = steps.length;
        const progressPercent = Math.round((completedSteps / totalSteps) * 100);

        progressBar.style.width = progressPercent + '%';
        progressText.innerText = progressPercent + '% Complete';
        completedCount.innerText = completedSteps + '/' + totalSteps;
    }

    steps.forEach(step => {
        step.addEventListener('click', function() {
            completeStep(this);
        });
    });

    // JQery
    $(document).ready(function() {

    // Post Stats Chart Data
    let postData = {
        Facebook: { total: 100, scheduled: 60, pending: 40 },
        Instagram: { total: 120, scheduled: 80, pending: 40 },
        Twitter: { total: 90, scheduled: 50, pending: 40 },
        LinkedIn: { total: 110, scheduled: 90, pending: 20 }
    };

    let platforms = Object.keys(postData);
    let scheduledData = [];
    let pendingData = [];

    $.each(postData, function(platform, data) {
        let total = data.total || 1; // Avoid divide by zero
        let scheduledPercent = Math.round((data.scheduled / total) * 100);
        let pendingPercent = Math.round((data.pending / total) * 100);

        scheduledData.push(scheduledPercent);
        pendingData.push(pendingPercent);
    });

    // First Chart - Post Stats Chart
    if ($('#postStatsChart').length) {
        let postStatsChart = echarts.init(document.getElementById('postStatsChart'));

        let option1 = {
            tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' }},
            legend: { bottom: '12px', data: ['Scheduled', 'Pending'] },
            xAxis: { type: 'category', data: platforms },
            yAxis: { type: 'value', max: 100 },
            series: [
                { name: 'Scheduled', type: 'bar', stack: 'total', data: scheduledData, itemStyle: { color: '#cfedda' }, label: { show: true, position: 'inside' }},
                { name: 'Pending', type: 'bar', stack: 'total', data: pendingData, itemStyle: { color: '#FFF4E6' }, label: { show: true, position: 'inside' }}
            ]
        };

        postStatsChart.setOption(option1);

        $(window).on('resize', function () {
            postStatsChart.resize();
        });
    }

});
</script>
@endscript