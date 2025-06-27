<div>
    <div class="signup-content">
        <div class="container">

            <div class="row ">
                <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                    <div id="onboarding">
                        <span class="d-block text-light" id="step-counter">Step 3 of 4</span>
                        <div class="row mt-2 mb-4">
                            <div class="col-xxl-5 col-lg-6 mx-auto">
                                <div id="progress-container">
                                    <div id="progress-bar" style="width:75%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div class="row step" id="step-3">
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
                                                <span class="checkbox" id="handle_facebook"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_facebook">
                                                    <i class="bx bxl-facebook bx-sm me-2 text-secondary"></i> Facebook
                                                </label>
                                                <input type="text" wire:model="facebook"
                                                    class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_instagram"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_instagram">
                                                    <i class="bx bxl-instagram bx-sm me-2 text-secondary"></i> Instagram
                                                </label>
                                                <input type="text" wire:model="instagram"
                                                    class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_twitter"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_twitter">
                                                    <i class="bx bxl-twitter bx-sm me-2 text-secondary"></i> Twitter
                                                </label>
                                                <input type="text" wire:model="twitter"
                                                    class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_linkedin"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_linkedin">
                                                    <i class="bx bxl-linkedin bx-sm me-2 text-secondary"></i> LinkedIn
                                                </label>
                                                <input type="text" wire:model="linkedin"
                                                    class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_youtube"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_youtube">
                                                    <i class="bx bxl-youtube bx-sm me-2 text-secondary"></i> YouTube
                                                </label>
                                                <input type="text" wire:model="youtube"
                                                    class="mt-2 text-center w-100" placeholder="@username" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="social-input">
                                                <span class="checkbox" id="handle_tiktok"><i
                                                        class='bx bx-check text-white'></i></span>
                                                <label
                                                    class="form-check-label d-flex align-items-center justify-content-center flex-column"
                                                    for="handle_tiktok">
                                                    <i class="bx bxl-tiktok bx-sm me-2 text-secondary"></i> TikTok
                                                </label>
                                                <input type="text" wire:model="tiktok" class="mt-2 text-center w-100"
                                                    placeholder="@username" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-md-6"><button
                                            class="w-100 btn btn-outline-secondary btn-smt text-lg"
                                            wire:click="movePrev">Go Back</button></div>
                                    <div class="col-md-6"><button class="w-100 btn btn-primary btn-smt text-lg"
                                            wire:click="moveNext">Continue</button></div>
                                </div>
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

</div>

@script
    <script>
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
    </script>
@endscript
