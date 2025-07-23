<div>
    <div class="signup-content">
        <div class="container">

            <div class="row ">
                <div class="col-xl-7 col-xxl-6 mx-auto text-center">
                    <div id="onboarding">
                        <span class="d-block text-light" id="step-counter">Step 2 of 3</span>
                        <div class="row mt-2 mb-4">
                            <div class="col-xxl-5 col-lg-6 mx-auto">
                                <div id="progress-container">
                                    <div id="progress-bar" style="width:66%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="row step" id="step-2">
                            <div class="col-12">
                                <h2 class="title mb-4">Set Up Your Organization</h2>
                            </div>
                            <div class="col-12">
                                <div class="upload-card mb-4">
                                    <div class="upload-frame" id="uploadFrame">
                                        <span class="placeholder-text">Click to <br />upload logo</span>
                                        <img id="logoPreview" alt="Logo Preview" style="display:none;"
                                            @if ($org->image) src="{{ asset('storage/' . $org->image) }}" @endif />
                                    </div>
                                    <input type="file" id="logoInput" accept="image/*" hidden />

                                    <!-- Modal -->
                                    <div class="modal" id="cropModal">
                                        <div class="modal-content" style="max-width: 600px; margin: auto;">
                                            <img id="cropImage" />
                                            <button id="cropButton">Crop & Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 mx-auto">

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
                                        <option value="influencer-management-agencies">Influencer Management Agencies
                                        </option>
                                        <option value="publishing-houses">Publishing Houses</option>
                                        <option value="podcast-networks">Podcast Networks</option>
                                        <option value="film-tv-studios">Film & TV Studios</option>
                                        <option value="music-labels-artist-management">Music Labels & Artist Management
                                        </option>
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
                                        <option value="coaching-training-companies">Coaching & Training Companies
                                        </option>
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
                                        <option value="property-management-companies">Property Management Companies
                                        </option>
                                        <option value="fintech-startups">Fintech Startups</option>
                                        <option value="insurance-companies">Insurance Companies</option>
                                        <option value="banks-investment-firms">Banks & Investment Firms</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button
                                            class="w-100 btn btn-outline-secondary btn-smt text-lg"
                                            wire:click="movePrev">Go Back</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="w-100 btn btn-primary btn-smt text-lg"
                                            wire:click="moveNext">Continue</button>
                                    </div>
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

@assets
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
@endassets

@script
    <script>
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
                cropper.getCroppedCanvas().toBlob((blob) => {
                    console.log('Blob generated:', blob);

                    // Create a FormData object to send the file
                    let formData = new FormData();
                    formData.append('user_image', blob, 'cropped-image.png');

                    let entries = formData.entries();
                    let file = entries.next().value[1];

                    @this.upload('image', file, (uploadedFilename) => {
                        @this.call('saveCroppedImage', uploadedFilename);

                        // Update UI
                        logoPreview.src = URL.createObjectURL(blob);
                        logoPreview.style.display = 'block';
                        document.querySelector('.placeholder-text').style.display = 'none';

                        // Close modal and destroy cropper
                        cropModal.style.display = 'none';
                        cropper.destroy();
                        cropper = null;
                        logoInput.value = ''; // Reset input
                    });
                }, 'image/png');
            }
        });

        document.addEventListener('success', event => {
            document.getElementById('logoPreview').style.display = 'block';
        });
    </script>
@endscript
