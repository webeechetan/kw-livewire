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
                        <div class="card-body d-flex justify-content-between flex-wrap">
                            <div>
                                <h4 class="card-title mb-2">Hey Welcome, John 🤖</h4>
                                <div onclick="openChat()">
                                    <div class="robot"></div>
                                    <div class="typing text-muted" id="typing-text"></div>
                                </div>
                                <div class="avatars mt-3" id="avatars"></div>
                            </div>
                            <div class="welcome-box-img">
                                <img src="{{ asset('assets/images/welcome-img.png') }}" width="150" style="margin-top: -50px;" alt="Kaykewalk Welcome" />                            
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <!-- <div class="col-md-4">
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
                </div> -->

                <!-- Total Projects -->
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

                <!-- Total Teams -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#FFF4E6;">
                                    <i class='bx bx-sitemap text-warning'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Total Teams</span>
                                    <h5 class="mb-0 font-500">10</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Total Tasks -->
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
                                        <span class="text-muted">Pending Tasks</span>
                                        <small>Last 15 days</small>
                                        <h5 class="mb-0">10</h5>
                                    </div>
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

                <!-- Content Plan -->
                <div class="col-md-4">
                    <a href="#">
                        <div class="card shadow-sm border-0">
                            <span class="card-open"><i class="bx bx-chevron-right"></i></span>
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="icon-box" style="background-color:#eafaf0;">
                                    <i class='bx bxs-edit text-success'></i>
                                </div>
                                <div>
                                    <span class="text-muted">Content Plan</span>
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

                <!-- Projects Statistics -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-0">Projects Overview</h5>
                            <p class="text-muted">Overview of your post performance.</p>
                        </div>
                        <div id="projectChart" style="height: 480px; margin-top: -140px;"></div>
                    </div>
                </div>

                <!-- Post Statistics -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-0">Post Overview</h5>
                            <p class="text-muted">Overview of your post performance.</p>
                        </div>
                        <div id="postStatsChart" style="height: 400px; margin-top: -60px;"></div>
                    </div>
                </div>

                <!-- Storage -->
                <div class="col-md-4">
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
                <div class="col-md-4">
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
                <div class="col-md-4">
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

                <!-- Latest Post -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0">Upcoming Posts</h5>
                                <a href="#" class="btn-link">View All</a>
                            </div>
                            <a href="#" class="btn-border btn-border-sm btn-border-primary"><i class="bx bx-plus"></i></a>
                        </div>
                        <div class="card-body pt-0">

                            <div class="row g-3">

                                <!-- Post Card -->
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <img src="https://placehold.co/600x400" class="post-img">
                                        <div class="card-body">
                                            <h6 class="mb-1 text-lg">Fathers Day</h6>
                                            <span class="text-muted text-sm">Microsoft · <i class="text-secondary">6 minuts ago</i></span>
                                            <ul class="social-icons my-2">
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-facebook"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-linkedin"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-instagram"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-github"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-twitter"></i></a></li>
                                            </ul>
                                            <span class="badge bg-success-light text-success rounded-pill mt-2">Published</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <img src="https://placehold.co/600x400" class="post-img">
                                        <div class="card-body">
                                            <h6 class="mb-1 text-lg">Fathers Day</h6>
                                            <span class="text-muted text-sm">Microsoft · <i class="text-secondary">6 minuts ago</i></span>
                                            <ul class="social-icons my-2">
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-facebook"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-linkedin"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-instagram"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-github"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-twitter"></i></a></li>
                                            </ul>
                                            <span class="badge bg-danger-light text-danger rounded-pill mt-2">Draft</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <img src="https://placehold.co/600x400" class="post-img">
                                        <div class="card-body">
                                            <h6 class="mb-1 text-lg">Fathers Day</h6>
                                            <span class="text-muted text-sm">Microsoft · <i class="text-secondary">6 minuts ago</i></span>
                                            <ul class="social-icons my-2">
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-facebook"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-linkedin"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-instagram"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-github"></i></a></li>
                                                <li><a class="add-social-link" href="javascript:"><i class="bx bxl-twitter"></i></a></li>
                                            </ul>
                                            <span class="badge bg-warning-light text-warning rounded-pill mt-2">Scheduled</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="h-100">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <h5 class="mb-0">AI Usage Stats</h5>
                    </div>
                    <div id="aiUsageChart" style="height: 550px; margin-top: -15px; margin-bottom: -170px;"></div>
                </div>
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

    <!-- Onboarding Popup -->
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
            <i class='bx bx-user'></i> Complete your profile
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-objects-horizontal-left'></i> Add your first project
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-sitemap'></i> Create your teams
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-calendar'></i> Create your first content calendar
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-edit'></i> Create your first post
        </div>
        <div class="onboarding-step" onclick="completeStep(this)">
            <i class='bx bx-task'></i> Add your first task
        </div>

        <div id="stepCounter">
            <i class='bx bx-rocket'></i> <span id="completedCount">0/5</span>
        </div>
    </div>

    <!-- Welcome Profile Complete Popup -->
    <div id="popupOverlay" class="popup-overlay" style="display: none;">
        <div class="rounded-4 position-relative shadow-lg" style="max-width: 750px; width: 90%;">

            <div id="popupOverlay" class="popup-overlay d-flex">
                <div class="rounded-4 position-relative shadow-lg" style="max-width: 750px; width: 90%;">
                    <div class="chat-container">
                        <div class="chat-header d-flex align-items-center">
                            <div class="ai-icon">🤖</div>
                            AI Brand Assistant
                        </div>

                        <div id="chat-box">
                            <div class="chat-message ai">Welcome to the brand setup! To optimize content for your brand, we need some details.</div>
                            <div class="chat-message ai">Firstly, what's the exact name of your brand?</div>
                        </div>

                        <div class="d-flex gap-2 mt-5">
                            <div class="flex-grow-1 d-flex justify-content-between align-items-center gap-2 position-relative border-radius-10">
                                <input type="text" id="user-input" class="form-control chat-input w-100" placeholder="Type your answer...">
                                
                                <!-- Mic Icon -->
                                <span onclick="startListening()" class="btn p-0 text-white position-absolute end-0 me-4">
                                    <i class='bx bx-microphone'></i>
                                </span>
                            </div>

                            <!-- Send Button -->
                            <button class="btn p-0 w-50 h-50 btn-primary rounded send-message"><i class='bx bx-send' ></i></button>
                        </div>

                        <!-- Word Count -->
                        <div id="word-count" class="text-light mt-3 text-sm">Word Count: 0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@assets
<!-- Include echarts CDN -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
@endassets

@script
<script>
    
    const text = "Hey there! Glad to have you back. Let’s see what’s new and keep things running smoothly.";
    const typingElement = document.getElementById('typing-text');

    let i = 0;

    function typeText() {
        if (i < text.length) {
            typingElement.innerHTML += text.charAt(i);
            i++;
            setTimeout(typeText, 40);
        } else {
            typingElement.innerHTML += '<span class="cursor">|</span>';
        }
    }

    function openChat() {
        // Replace this with your chat popup logic or URL
        window.location.href = "https://your-chat-popup-link.com";
    }

    typeText();
    // Function to open chat
    const steps = document.querySelectorAll('.onboarding-step');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const completedCount = document.getElementById('completedCount');
    const onboardingPopup = document.getElementById('onboardingPopup');
    const closePopup = document.getElementById('closePopup');

    function completeStep(element) {
        element.classList.toggle('completed');

        const completedSteps = document.querySelectorAll('.onboarding-step.completed').length;
        const totalSteps = steps.length;
        const progressPercent = Math.round((completedSteps / totalSteps) * 100);

        progressBar.style.width = progressPercent + '%';
        progressText.innerText = progressPercent + '% Complete';
        completedCount.innerText = completedSteps + '/' + totalSteps;

        if (completedSteps === totalSteps) {
            onboardingPopup.style.display = 'none';
        }
    }

    steps.forEach(step => {
        step.addEventListener('click', function() {
            completeStep(this);
        });
    });

    closePopup.addEventListener('click', function() {
        onboardingPopup.style.display = 'none';
    });

    document.addEventListener('brandCreated', event => {
        console.log('Brand created:', event.detail);
        // hide popup
        document.getElementById('popupOverlay').style.display = 'none';
    });


    // JQery
    $(document).ready(function() {

        $(".send-message").click(function(){
            sendMessage()
        });

        // ----- AI Profile Chat

        const chatBox = document.getElementById('chat-box');
        const userInput = document.getElementById('user-input');
        const wordCount = document.getElementById('word-count');
        const popupOverlay = document.getElementById('popupOverlay');
        const popupContainer = document.querySelector('.chat-container');

        const steps = [
            {
                question: "What's the exact name of your brand?",
                key: 'brandName'
            },
            {
                question: "What type of content do you create?",
                key: 'contentType'
            },
            {
                question: "What are your brand colors?",
                key: 'brandColors'
            },
            {
                question: "What are your brand's main goals?",
                key: 'goals'
            },
            {
                question: "What's your monthly content goal?",
                key: 'contentGoal'
            },
            {
                question: "Describe your brand's tone of voice?",
                key: 'toneOfVoice'
            },
            {
                question: "Are there any topics or words to avoid?",
                key: 'avoidWords'
            },
            {
                question: "Who are your main competitors?",
                key: 'competitors'
            },
            {
                question: "What's your brand's unique selling point?",
                key: 'uniqueSellingPoint'
            },
            {
                question: "Which platforms do you focus on most?",
                key: 'platforms'
            }
        ];

        let stepIndex = 0;
        const answers = {};

        // Send Message Function
        function sendMessage() {
            const userText = userInput.value.trim();
            if (!userText) return;

            appendMessage(userText, 'user');
            answers[steps[stepIndex]?.key] = userText;

            userInput.value = '';
            updateWordCount();

            console.log(answers); // Log the answers object to see the collected data

            // current question

            setTimeout(() => {
                getBotResponse();
            }, 600);
        }

        // Append Message
        function appendMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message');
            if (sender === 'ai') {
                messageDiv.classList.add('ai');
            }
            messageDiv.innerText = text;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Get Dynamic Bot Response
        function getBotResponse() {
            if (stepIndex < steps.length - 1) {
                stepIndex++;
                appendMessage(steps[stepIndex].question, 'ai');
            } else { 
                @this.createBrand(answers);
                appendMessage("Thank you! Your brand setup is complete. 🎉", 'ai');
                // close the popup
                setTimeout(() => {
                    popupOverlay.style.display = 'none';
                }, 2000);
            }
        }

        // Voice Recognition Function
        function startListening() {
            if (!('webkitSpeechRecognition' in window)) {
                alert('Sorry, your browser does not support voice recognition.');
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            recognition.start();

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                userInput.value = transcript;
                updateWordCount();
            };

            recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
            };
        }

        // Word Count Function
        function updateWordCount() {
            const text = userInput.value.trim();
            const words = text === '' ? 0 : text.split(/\s+/).length;
            wordCount.innerText = `Word Count: ${words}`;
        }

        // Update word count on typing
        userInput.addEventListener('input', updateWordCount);

        // Close popup when clicking outside
        popupOverlay.addEventListener('click', (event) => {
            if (!popupContainer.contains(event.target)) {
                popupOverlay.style.display = 'none';
            }
        });

        // ----- End AI Profile Chat

        // Avatar Images
        const users = [
            'https://i.pravatar.cc/150?img=1',
            'https://i.pravatar.cc/150?img=2',
            'https://i.pravatar.cc/150?img=3',
            'https://i.pravatar.cc/150?img=4',
            'https://i.pravatar.cc/150?img=5',
            'https://i.pravatar.cc/150?img=6',
            'https://i.pravatar.cc/150?img=7',
            'https://i.pravatar.cc/150?img=8',
            'https://i.pravatar.cc/150?img=9',
            'https://i.pravatar.cc/150?img=10',
            'https://i.pravatar.cc/150?img=11',
            'https://i.pravatar.cc/150?img=12'
        ];

        const avatarContainer = document.getElementById('avatars');
        const maxVisible = 7;

        users.slice(0, maxVisible).forEach(url => {
            const img = document.createElement('img');
            img.src = url;
            img.className = 'avatar';
            avatarContainer.appendChild(img);
        });

        if (users.length > maxVisible) {
            const more = document.createElement('div');
            more.className = 'avatar more';
            more.textContent = `+${users.length - maxVisible}`;
            avatarContainer.appendChild(more);
        }
        // End Avatar Images

        // AI Usage Chart
        const aiUsageChartDom = document.getElementById('aiUsageChart');
        const aiUsageChart = echarts.init(aiUsageChartDom);

        const aiUsageData = [
            { value: 120, name: 'Content Creation' },
            { value: 80, name: 'Image Generation' },
            { value: 60, name: 'Chat Support' },
            { value: 40, name: 'Automation Tasks' },
            { value: 20, name: 'Research' }
        ];

        // Total for % Calculation
        const totalValue = aiUsageData.reduce((sum, item) => sum + item.value, 0);

        const aiUsageOption = {
            color: ['#556ee6', '#34c38f', '#f46a6a', '#50a5f1', '#f1b44c'],
            tooltip: { 
                trigger: 'item',
                formatter: '{b} : {c} ({d}%)' 
            },
            legend: {
                orient: 'horizontal',
                left: 8,
                top: '15px',
                textStyle: { fontSize: 12 },
                formatter: function(name) {
                    const item = aiUsageData.find(i => i.name === name);
                    const percent = ((item.value / totalValue) * 100).toFixed(1);
                    return `${name} (${percent}%)`;
                }
            },
            series: [{
                name: 'Usage',
                type: 'pie',
                radius: ['30%', '80%'],
                roseType: 'area', // For Nightingale Chart Style
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 0,
                    borderColor: '#fff',
                    borderWidth: 5
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 20,
                        fontWeight: 'bold',
                        formatter: function(params) {
                            const percent = ((params.value / totalValue) * 100).toFixed(1);
                            return `${params.name}\n${percent}%`;
                        }
                    }
                },
                labelLine: { show: false },
                data: aiUsageData
            }]
        };

        aiUsageChart.setOption(aiUsageOption);

        // Project Chart
        const projectChartDom = document.getElementById('projectChart');
        const projectChart = echarts.init(projectChartDom);

        const projectData = [
            { value: 12, name: 'Upcoming' },
            { value: 20, name: 'Ongoing' },
            { value: 8, name: 'Completed' }
        ];

        const projectOption = {
            color: ['#e7bf1d', '#e5d1ff', '#2ecc71'],
            tooltip: {
                trigger: 'item',
                formatter: '{b} : {c} Projects ({d}%)'
            },
            legend: {
                bottom: '15px',
                formatter: name => {
                    const item = projectData.find(i => i.name === name);
                    return `${name} (${item.value})`;
                }
            },
            series: [{
                name: 'Projects',
                type: 'pie',
                radius: ['20%', '40%'],
                roseType: 'area',
                data: projectData,
                label: {
                    show: true,
                    formatter: '{b}\n{c} Projects'
                }
            }]
        };

        projectChart.setOption(projectOption);

        window.addEventListener('resize', function() {
            aiUsageChart.resize();
            projectChart.resize();
        });

        // Post Stats Chart
        const postData = {
            Facebook: { total: 100, scheduled: 60, pending: 40 },
            Instagram: { total: 120, scheduled: 80, pending: 40 },
            Twitter: { total: 90, scheduled: 50, pending: 40 },
            LinkedIn: { total: 110, scheduled: 90, pending: 20 }
        };

        const platforms = Object.keys(postData);
        const scheduledData = [];
        const pendingData = [];

        $.each(postData, function(platform, data) {
            const total = data.total || 1;
            const scheduledPercent = Math.round((data.scheduled / total) * 100);
            const pendingPercent = Math.round((data.pending / total) * 100);
            scheduledData.push(scheduledPercent);
            pendingData.push(pendingPercent);
        });

        if ($('#postStatsChart').length) {
            const postStatsChart = echarts.init(document.getElementById('postStatsChart'));

            const postStatsOption = {
                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' }},
                legend: { bottom: '12px', data: ['Scheduled', 'Pending'] },
                xAxis: { type: 'category', data: platforms },
                yAxis: { type: 'value', max: 100 },
                series: [
                    { name: 'Scheduled', type: 'bar', stack: 'total', data: scheduledData, itemStyle: { color: '#cfedda' }, label: { show: true, position: 'inside' }},
                    { name: 'Pending', type: 'bar', stack: 'total', data: pendingData, itemStyle: { color: '#FFF4E6' }, label: { show: true, position: 'inside' }}
                ]
            };

            postStatsChart.setOption(postStatsOption);

            $(window).on('resize', function () {
                postStatsChart.resize();
            });
        }

    });

</script>
@endscript