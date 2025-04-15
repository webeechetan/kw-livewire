
<div>
    <div class="signup-content">
        <div class="container">

            <div class="row ">
                <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                    <div id="onboarding" 
                    @if(!$emailSended)
                        style="display:block;"
                    @else
                     style="display:none;"
                     @endif
                    >
                        <span class="d-block text-light" id="step-counter">Step 4/4</span>
                        <div class="row mt-2 mb-4">
                            <div class="col-xxl-5 col-lg-6 mx-auto"><div id="progress-container"><div id="progress-bar" style="width:100%"></div></div></div>
                        </div>
                        <!-- Step 3 -->
                        <!-- Step 4 -->
                        <div class="step" id="step-4">
                            <h2 class="mb-3 title">Invite teammates</h2>
                            <p class="text-muted mb-4">Copy this link and share in your work messenger:</p>

                            <!-- Copy Link Section -->
                            <div class="input-group mb-4 position-relative d-none">
                                <input type="text" id="inviteLink" class="form-control bg-light text-muted" readonly value="https://yourapp.com/join/ABC123">
                                <button id="copyBtn" class="btn btn-primary" onclick="copyLink()">COPY</button>
                                <div id="copiedText" class="text-success small position-absolute" style="right: 10px; top: 100%; display: none;">Copied!</div>
                            </div>

                            <!-- Enter Emails -->
                            <div class="mb-4" wire:ignore>
                                <input type="text" id="emailInput" class="form-control" placeholder="Enter emails here (comma separated)">
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-6"><button class="w-100 btn btn-primary btn-smt text-lg" wire:click="finishOnboarding()" >Send invitations</button></div>
                                <div class="col-lg-6"><button class="w-100 btn btn-outline-secondary btn-smt text-lg" wire:click="finishOnboarding()" >Skip for now</button></div>
                            </div>
                        </div>

                    </div>

                    <!-- 🎉 Welcome Message -->
                    <div id="welcome-message" class="text-center" 
                    @if($emailSended)
                        style="display:block;"
                    @else
                     style="display:none;"
                    @endif
                    >
                        <h2 class="title-big"><span class="d-block">🎉</span> Welcome Aboard!</h2>
                        <p>We're excited to have you with us.</p>
                        <a href="#" class="btn btn-primary btn-smt text-lg">Let's start</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
@endassets

@script
<script>
    const input = document.getElementById('emailInput');

    // Initialize Tagify
    const tagify = new Tagify(input, {
        delimiters: ",", // allow comma separated values
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // email validation
        keepInvalidTags: true, // show invalid emails as red
        dropdown: {
            enabled: 0 // no autocomplete dropdown
        },
        
    });

    // Optional: Listen for invalid email tags
    tagify.on('invalid', (e) => {
        console.log('Invalid email:', e.detail.data.value);
    });

    input.addEventListener('change', function(e){
        let emailsArray = e.target.value;
        if(emailsArray == ''){
            @this.set('inviteEmails', '');
            return false;
        }

        emailsArray = JSON.parse(emailsArray);

        emailsArray = emailsArray.map(function(item){
            return item.value;
        });

        console.log(emailsArray);

        let emails = JSON.stringify(emailsArray);
        @this.set('inviteEmails', emails);
    });

    document.addEventListener('email-sended', event => {
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


        setTimeout(() => {
            window.location.href = "{{ env('APP_URL') }}/{{ session('org_name') }}/dashboard";
        }, 3000);
    });
</script>
@endscript


