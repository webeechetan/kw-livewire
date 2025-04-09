@assets
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
<!-- Tagify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endassets
<div>
    @if($step == 1)
    <div class="header-signup d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <img class="img-fluid" src="./assets/images/logo.png" alt="Kaykewalk Logo" />
                </div>
                <div class="col-sm-6 text-md-end">
                    @if(!in_array($step, [2, 3]))
                    <a wire:navigate href="/login">
                        <button class="btn btn-primary-border btn-smt">Sign In</button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div> 
    <div class="signup-content">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-6 mx-auto text-center mx-auto">
                    <img class="signup-welcome-img" src="{{ asset('') }}assets/images/signup_welcome.png" alt="Sign Up Welcome" />
                    <div class="title-wrap">
                        <h2 class="title mt-3">Welcome to Kaykewalk</h2>
                        <p>Let’s get started with a few simple steps</p>
                    </div>
                    <div class="signup-form">
                        <form method="POST" wire:submit="register">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-user'></i></div>
                                        <input type="text" wire:model="user_name" class="form-control" placeholder="Enter Full Name"   />
                                        @error('user_name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-envelope'></i></div>
                                        <input type="email" wire:model="email" class="form-control" placeholder="Enter Email"   />
                                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupPassword">
                                        <div class="form-field-icon"><i class='bx bx-lock-open'></i></div>
                                        <input type="password" wire:model="password" class="form-control" placeholder="Password 8+ Characters"    />
                                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-lock-open'></i></div>
                                        <input type="password" wire:model="confirm_password" class="form-control" placeholder="Confirm Password"   />
                                        @error('confirm_password') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="my-3">
                                <button class="w-100 btn btn-primary btn-smt text-lg" type="submit">Sign Up</button>
                            </div>
                            {{-- <p>Or sign up with:</p>
                            <a href="#" class="signin-google-btn w-100">
                                <svg viewBox="0 0 48 48">
                                    <clipPath id="g">
                                        <path d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>
                                    </clipPath>
                                    <g class="colors" clip-path="url(#g)">
                                        <path fill="#FBBC05" d="M0 37V11l17 13z"/>
                                        <path fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/>
                                        <path fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/>
                                        <path fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                                    </g>
                                </svg>
                                <span>google</span>
                            </a> --}}
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                    <div id="onboarding">
                        <span class="d-block text-light" id="step-counter">Step 4/1</span>
                        <div class="row mt-2 mb-4">
                            <div class="col-xxl-5 col-lg-6 mx-auto"><div id="progress-container"><div id="progress-bar"></div></div></div>
                        </div>
                        <!-- Step 1 -->
                        <div class="row step" id="step-1">
                            <div class="col-12 text-center">
                                <h2 class="title mb-4">Who are you setting up Kaykewalk for?</h2>
                                <div class="options">
                                    <div class="option" onclick="toggleSelection(this)">
                                        <span class="checkbox"><i class='bx bx-check text-white'></i></span>
                                        <span class="d-block mb-2"><i class='bx bx-briefcase-alt-2 bx-md text-primary'></i></span>
                                        <span>I run/manage a</span>
                                        <p class="fw-bold">Creative Agency or Content Team</p>
                                    </div>
                                    
                                    <div class="option" onclick="toggleSelection(this)">
                                        <span class="checkbox"><i class='bx bx-check text-white'></i></span>
                                        <span class="d-block mb-2"><i class='bx bx-edit bx-md text-primary'></i></span>
                                        <span>I manage a</span>
                                        <p class="fw-bold">Brand/In-House Marketing Team</p>
                                    </div>
                                </div>
                                <button class="w-100 btn btn-primary btn-smt text-lg mt-4" onclick="nextStep()">Continue</button>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="row step" id="step-2" style="display:none">
                            <div class="col-12">
                                <h2 class="title mb-4">Set Up Your Organization</h2>
                            </div>
                            <div class="col-12">
                                <div class="upload-card mb-4">
                                    <div class="upload-frame" id="uploadFrame">
                                        <span class="placeholder-text">Click to <br/>upload logo</span>
                                        <img id="logoPreview" alt="Logo Preview" />
                                    </div>
                                    <input type="file" id="logoInput" accept="image/*" hidden />

                                    <!-- Modal -->
                                    <div class="modal" id="cropModal">
                                        <div class="modal-content">
                                        <img id="cropImage" />
                                        <button id="cropButton">Crop & Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 mx-auto">
                                <div class="form-field mb-4" controlId="signupName">
                                    <div class="form-field-icon"><i class='bx bx-building'></i></div>
                                    <input type="text" wire:model="name" class="form-control" placeholder="Organization Name"   />
                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-field mb-4" controlId="signupName">
                                    <div class="form-field-icon"><i class='bx bx-buildings'></i></div>
                                    {{-- industry type --}}
                                    <select class="form-control" wire:model="industry_type">
                                        <option value="" selected readonly desable>-- Select Industry --</option>
                                        <option value="marketing-agencies">Marketing Agencies</option>
                                        <option value="advertising-agencies">Advertising Agencies</option>
                                        <option value="pr-firms">PR Firms</option>
                                        <option value="branding-agencies">Branding Agencies</option>
                                        <option value="content-studios">Content Studios</option>
                                        <option value="influencer-management-agencies">Influencer Management Agencies</option>
                                        <option value="publishing-houses">Publishing Houses</option>
                                        <option value="podcast-networks">Podcast Networks</option>
                                        <option value="film-tv-studios">Film & TV Studios</option>
                                        <option value="music-labels-artist-management">Music Labels & Artist Management</option>
                                        <option value="fashion-apparel">Fashion & Apparel</option>
                                        <option value="beauty-skincare">Beauty & Skincare</option>
                                        <option value="home-decor-furniture">Home Decor & Furniture</option>
                                        <option value="lifestyle-wellness-brands">Lifestyle & Wellness Brands</option>
                                        <option value="food-beverage-brands">Food & Beverage Brands</option>
                                        <option value="startups">Startups</option>
                                        <option value="app-developers">App Developers</option>
                                        <option value="gaming-companies">Gaming Companies</option>
                                        <option value="software-companies">Software Companies</option>
                                        <option value="online-learning-platforms">Online Learning Platforms</option>
                                        <option value="universities-colleges">Universities & Colleges</option>
                                        <option value="coaching-training-companies">Coaching & Training Companies</option>
                                        <option value="health-fitness-brands">Health & Fitness Brands</option>
                                        <option value="healthcare-providers">Healthcare Providers</option>
                                        <option value="mental-health-platforms">Mental Health Platforms</option>
                                        <option value="hotels-resorts">Hotels & Resorts</option>
                                        <option value="travel-agencies">Travel Agencies</option>
                                        <option value="tourism-boards">Tourism Boards</option>
                                        <option value="airlines">Airlines</option>
                                        <option value="charities">Charities</option>
                                        <option value="advocacy-groups">Advocacy Groups</option>
                                        <option value="educational-nonprofits">Educational Nonprofits</option>
                                        <option value="brokerages">Brokerages</option>
                                        <option value="real-estate-agents">Real Estate Agents</option>
                                        <option value="property-management-companies">Property Management Companies</option>
                                        <option value="fintech-startups">Fintech Startups</option>
                                        <option value="insurance-companies">Insurance Companies</option>
                                        <option value="banks-investment-firms">Banks & Investment Firms</option>
                                        <option value="others">Others</option>                                
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><button class="w-100 btn btn-outline-secondary btn-smt text-lg" onclick="prevStep()">Go Back</button></div>
                                    <div class="col-md-6"><button class="w-100 btn btn-primary btn-smt text-lg" onclick="nextStep()">Continue</button></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="row step" id="step-3" style="display:none">
                            <div class="col-md-12">
                                <div class="mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-lg-7 mx-auto">
                                            <h2 class="title mb-4">Let's Add Your Brand Handle(s)</h2>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center social-input-list">
                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_facebook"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_facebook">
                                                <i class="bx bxl-facebook bx-sm me-2 text-secondary"></i> Facebook
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_instagram"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_instagram">
                                                <i class="bx bxl-instagram bx-sm me-2 text-secondary"></i> Instagram
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_twitter"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_twitter">
                                                <i class="bx bxl-twitter bx-sm me-2 text-secondary"></i> Twitter
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_linkedin"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_linkedin">
                                                <i class="bx bxl-linkedin bx-sm me-2 text-secondary"></i> LinkedIn
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_youtube"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_youtube">
                                                <i class="bx bxl-youtube bx-sm me-2 text-secondary"></i> YouTube
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_tiktok"><i class='bx bx-check text-white'></i></span>
                                                <label class="form-check-label d-flex align-items-center justify-content-center flex-column" for="handle_tiktok">
                                                <i class="bx bxl-tiktok bx-sm me-2 text-secondary"></i> TikTok
                                                </label>
                                                <input type="text" class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-md-6"><button class="w-100 btn btn-outline-secondary btn-smt text-lg" onclick="prevStep()">Go Back</button></div>
                                    <div class="col-md-6"><button class="w-100 btn btn-primary btn-smt text-lg" onclick="nextStep()">Continue</button></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="step" id="step-4" style="display:none">
                            <h2 class="mb-3 title">Invite teammates</h2>
                            <p class="text-muted mb-4">Copy this link and share in your work messenger:</p>

                            <!-- Copy Link Section -->
                            <div class="input-group mb-4 position-relative">
                                <input type="text" id="inviteLink" class="form-control bg-light text-muted" readonly value="https://yourapp.com/join/ABC123">
                                <button id="copyBtn" class="btn btn-primary" onclick="copyLink()">COPY</button>
                                <div id="copiedText" class="text-success small position-absolute" style="right: 10px; top: 100%; display: none;">Copied!</div>
                            </div>

                            <!-- Enter Emails -->
                            <div class="mb-4">
                                <input type="text" id="emailInput" class="form-control" placeholder="Enter emails here (comma separated)">
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-6"><button class="w-100 btn btn-primary btn-smt text-lg" onclick="sendInvitations()">Send invitations</button></div>
                                <div class="col-lg-6"><button class="w-100 btn btn-outline-secondary btn-smt text-lg" onclick="finishOnboarding()">Skip for now</button></div>
                            </div>
                        </div>
                    </div>

                    <!-- 🎉 Welcome Message -->
                    <div id="welcome-message" class="text-center" style="display:none;">
                        <h2 class="title-big"><span class="d-block">🎉</span> Welcome Aboard!</h2>
                        <p>We're excited to have you with us.</p>
                        <a href="#" class="btn btn-primary btn-smt text-lg">Let's start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step == 2)
    <div class="signin-content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center px-0">
                    <div class="signin-content-left bg-md-secondary">
                        <img class="img-fluid d-none d-md-block" src="./assets/images/logo-verticle-white.png" alt="Kaykewalk White Logo" />
                        <img class="img-fluid d-md-none" src="./assets/images/logo.png" alt="Kaykewalk Logo" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="signin-content-right text-center text-md-start space-sec">
                        <div class="signin-content-right-top">
                            <h2 class="title">Upload Logo</h2>
                        </div>
                        <div class="signin-content-right-btm mt-4">
                            <form wire:submit="registerStepOne" method="POST" enctype="multipart/form-data">
                                <div class="mb-3" >
                                    <input type="file" wire:model="image" class="form-control" />
                                    @error('image') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                @if(session()->has('error'))
                                    <div class="col text-center">
                                        <div class="text-danger">
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 mb-4">
                                    <button class="w-100 btn btn-primary" type="submit">Done</button>
                                </div>
                                <div class="col-12">
                                    <a wire:navigate href="{{ env('APP_URL') }}/{{session('org_name')}}/teams" class="text-link text-dark">Skip for now</a>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endif
</div>

@assets
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<!-- Tagify JS -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>

    // option Js
    function toggleSelection(selectedOption) {
    const options = document.querySelectorAll('.option');
    
    options.forEach(option => {
        option.classList.remove('selected');
    });

        selectedOption.classList.add('selected');
    }
    // end option js


    // Steps
    let currentStep = 1;
    const totalSteps = 4;
    const startProgress = 20; // Starting at 20%

    function nextStep() {
        if (currentStep < totalSteps) {
            document.getElementById(`step-${currentStep}`).style.display = "none";
            currentStep++;
            document.getElementById(`step-${currentStep}`).style.display = "block";
            updateStepCounter();
            updateProgressBar();
        } else {
            finishOnboarding();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            document.getElementById(`step-${currentStep}`).style.display = "none";
            currentStep--;
            document.getElementById(`step-${currentStep}`).style.display = "block";
            updateStepCounter();
            updateProgressBar();
        }
    }

    function updateStepCounter() {
        const counter = document.getElementById('step-counter');
        if (counter) {
            counter.textContent = `Step ${totalSteps}/${currentStep}`;
        }
    }

    function updateProgressBar() {
        const progressBar = document.getElementById('progress-bar');

        const progressPercent = startProgress + ((currentStep - 1) / (totalSteps - 1)) * (100 - startProgress);

        progressBar.style.width = `${progressPercent}%`;
    }

    function finishOnboarding() {
        document.getElementById('onboarding').style.display = 'none';
        document.getElementById('welcome-message').style.display = 'block';

        // Raining confetti
        const duration = 2 * 1000; // 3 seconds
        const end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 5,
                angle: 60,
                spread: 55,
                origin: { x: 0 }
            });
            confetti({
                particleCount: 5,
                angle: 120,
                spread: 55,
                origin: { x: 1 }
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        })();
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateStepCounter();
        updateProgressBar();
    });

    // end steps

    document.addEventListener('DOMContentLoaded', () => {
        const socialInputs = document.querySelectorAll('.social-input-list .social-input');

        socialInputs.forEach(input => {
            const textInput = input.querySelector('input[type="text"]');

            // Handle input focus or typing
            textInput.addEventListener('input', () => {
            if (textInput.value.trim() !== "") {
                input.classList.add('selected');
            } else {
                input.classList.remove('selected');
            }
            });

            // Also optional: when clicking anywhere on box, focus the input
            input.addEventListener('click', () => {
            textInput.focus();
            });
        });

        let cropper;
        const logoInput = document.getElementById('logoInput');
        const uploadFrame = document.getElementById('uploadFrame');
        const logoPreview = document.getElementById('logoPreview');
        const cropImage = document.getElementById('cropImage');
        const cropModal = document.getElementById('cropModal');
        const cropButton = document.getElementById('cropButton');

        // Open file picker
        uploadFrame.addEventListener('click', () => {
        logoInput.click();
        });

        // When file selected
        logoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            cropImage.src = event.target.result;
            cropModal.style.display = 'flex'; // Open modal
            if (cropper) {
            cropper.destroy();
            }
            cropper = new Cropper(cropImage, {
            aspectRatio: 1, // square crop
            viewMode: 1,
            autoCropArea: 1,
            responsive: true,
            background: false,
            movable: true,
            zoomable: true,
            });
        };
        reader.readAsDataURL(file);
        });

        // When user clicks "Crop & Save"
        cropButton.addEventListener('click', () => {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
                imageSmoothingQuality: 'high',
                });

                // Set cropped image to preview
                logoPreview.src = canvas.toDataURL('image/png');
                logoPreview.style.display = 'block';
                document.querySelector('.placeholder-text').style.display = 'none';

                // Close modal and destroy cropper
                cropModal.style.display = 'none';
                cropper.destroy();
                cropper = null;
                logoInput.value = ''; // Reset input
            }
        });


        // Tagify
        const input = document.getElementById('emailInput');

        // Initialize Tagify
        const tagify = new Tagify(input, {
            delimiters: ",", // allow comma separated values
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // email validation
            keepInvalidTags: true, // show invalid emails as red
            dropdown: {
                enabled: 0 // no autocomplete dropdown
            }
        });

        // Optional: Listen for invalid email tags
        tagify.on('invalid', (e) => {
            console.log('Invalid email:', e.detail.data.value);
        });

    });

</script>
@endassets
