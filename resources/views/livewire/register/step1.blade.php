
<div>
    <div class="signup-content">
        <div class="container">

            <div class="row ">
                <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                    <div id="onboarding" >
                        <span class="d-block text-light" id="step-counter">Step 4/1</span>
                        <div class="row mt-2 mb-4">
                            <div class="col-xxl-5 col-lg-6 mx-auto"><div id="progress-container"><div id="progress-bar" style="width:25%"></div></div></div>
                        </div>
                        <!-- Step 1 -->
                        <div class="row step" id="step-1">
                            <div class="col-12 text-center">
                                <h2 class="title mb-4">Who are you setting up Kaykewalk for?</h2>
                                <div class="options">
                                    <div class="option
                                    @if($for == 'agency') selected @endif" onclick="toggleSelection(this)" wire:click="registerOrgFor('agency')">
                                        <span class="checkbox"><i class='bx bx-check text-white'></i></span>
                                        <span class="d-block mb-2"><i class='bx bx-briefcase-alt-2 bx-md text-primary'></i></span>
                                        <span>I run/manage a</span>
                                        <p class="fw-bold">Creative Agency or Content Team</p>
                                    </div>
                                    
                                    <div class="option @if($for == 'brand') selected @endif" onclick="toggleSelection(this)" wire:click="registerOrgFor('brand')">
                                        <span class="checkbox"><i class='bx bx-check text-white'></i></span>
                                        <span class="d-block mb-2"><i class='bx bx-edit bx-md text-primary'></i></span>
                                        <span>I manage a</span>
                                        <p class="fw-bold">Brand/In-House Marketing Team</p>
                                    </div>
                                </div>
                                <button class="w-100 btn btn-primary btn-smt text-lg mt-4" wire:click="moveNext">Continue</button>
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

@assets
<script>

    // option Js
    function toggleSelection(selectedOption) {
    const options = document.querySelectorAll('.option');
    
    options.forEach(option => {
        option.classList.remove('selected');
    });
        selectedOption.classList.add('selected');
    }

</script>
@endassets


