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
            <div class="row">
                <div class="col text-center mx-auto">
                    <img class="signup-welcome-img" src="{{ asset('') }}assets/images/signup_welcome.png" alt="Sign Up Welcome" />
                    <div class="title-wrap">
                        <h2 class="title text-primary mt-3">Welcome to Kaykewalk</h2>
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
                                    <div class="form-field mb-3" controlId="signupName">
                                        <div class="form-field-icon"><i class='bx bx-building'></i></div>
                                        <input type="text" wire:model="name" class="form-control" placeholder="Organization Name"   />
                                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-field mb-3" controlId="signupName">
                                        <div class="form-field-icon"><i class='bx bx-buildings'></i></div>
                                        {{-- industry type --}}
                                        <select class="form-control" wire:model="industry_type">
                                            <option value="" selected >-- Select Industry --</option>
                                            <option value="Accounting">Accounting</option>
                                            <option value="Airlines/Aviation">Airlines/Aviation</option>
                                            <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                                            <option value="Alternative Medicine">Alternative Medicine</option>
                                            <option value="Animation">Animation</option>
                                            <option value="Apparel & Fashion">Apparel & Fashion</option>
                                            <option value="Architecture & Planning">Architecture & Planning</option>
                                            <option value="Arts and Crafts">Arts and Crafts</option>
                                            <option value="Automotive">Automotive</option>
                                            <option value="Aviation & Aerospace">Aviation & Aerospace</option>
                                            <option value="Banking">Banking</option>
                                            <option value="Biotechnology">Biotechnology</option>
                                            <option value="Broadcast Media">Broadcast Media</option>
                                            <option value="Building Materials">Building Materials</option>
                                            <option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
                                            <option value="Capital Markets">Capital Markets</option>
                                            <option value="Chemicals">Chemicals</option>
                                            <option value="Civic & Social Organization">Civic & Social Organization</option>
                                            <option value="Civil Engineering">Civil Engineering</option>
                                            <option value="Commercial Real Estate">Commercial Real Estate</option>
                                            <option value="Computer & Network Security">Computer & Network Security</option>
                                            <option value="Computer Games">Computer Games</option>
                                            <option value="Computer Hardware">Computer Hardware</option>
                                            <option value="Computer Networking">Computer Networking</option>
                                            <option value="Computer Software">Computer Software</option>
                                            <option value="Construction">Construction</option>
                                            <option value="Consumer Electronics">Consumer Electronics</option>
                                            <option value="Consumer Goods">Consumer Goods</option>
                                            <option value="Consumer Services">Consumer Services</option>
                                            <option value="Cosmetics">Cosmetics</option>
                                            <option value="Dairy">Dairy</option>
                                            <option value="Defense & Space">Defense & Space</option>
                                            <option value="Design">Design</option>
                                            <option value="Education Management">Education Management</option>
                                            <option value="E-Learning">E-Learning</option>
                                            <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Environmental Services">Environmental Services</option>
                                            <option value="Events Services">Events Services</option>
                                            <option value="Executive Office">Executive Office</option>
                                            <option value="Facilities Services">Facilities Services</option>
                                            <option value="Farming">Farming</option>
                                            <option value="Financial Services">Financial Services</option>
                                            <option value="Fine Art">Fine Art</option>
                                            <option value="Fishery">Fishery</option>
                                            <option value="Food & Beverages">Food & Beverages</option>
                                            <option value="Food Production">Food Production</option>
                                            <option value="Fund-Raising">Fund-Raising</option>
                                            <option value="Furniture">Furniture</option>
                                            <option value="Gambling & Casinos">Gambling & Casinos</option>
                                            <option value="Glass, Ceramics & Concrete">Glass, Ceramics & Concrete</option>
                                            <option value="Government Administration">Government Administration</option>
                                            <option value="Government Relations">Government Relations</option>
                                            <option value="Graphic Design">Graphic Design</option>
                                            <option value="Health, Wellness and Fitness">Health, Wellness and Fitness</option>
                                            <option value="Higher Education">Higher Education</option>
                                            <option value="Hospital & Health Care">Hospital & Health Care</option>
                                            <option value="Hospitality">Hospitality</option>
                                            <option value="Human Resources">Human Resources</option>
                                            <option value="Import and Export">Import and Export</option>
                                            <option value="Individual & Family Services">Individual & Family Services</option>
                                            <option value="Industrial Automation">Industrial Automation</option>
                                            <option value="Information Services">Information Services</option>
                                            <option value="Information Technology and Services">Information Technology and Services</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="International Affairs">International Affairs</option>
                                            <option value="International Trade and Development">International Trade and Development</option>
                                            <option value="Internet">Internet</option>
                                            <option value="Investment Banking">Investment Banking</option>
                                            <option value="Investment Management">Investment Management</option>
                                            <option value="Judiciary">Judiciary</option>
                                            <option value="Law Enforcement">Law Enforcement</option>
                                            <option value="Law Practice">Law Practice</option>
                                            <option value="Legal Services">Legal Services</option>
                                            <option value="Legislative Office">Legislative Office</option>
                                            <option value="Leisure, Travel & Tourism">Leisure, Travel & Tourism</option>
                                            <option value="Libraries">Libraries</option>
                                            <option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
                                            <option value="Luxury Goods & Jewelry">Luxury Goods & Jewelry</option>
                                            <option value="Machinery">Machinery</option>
                                            <option value="Management Consulting">Management Consulting</option>
                                            <option value="Maritime">Maritime</option>
                                            <option value="Market Research">Market Research</option>
                                            <option value="Marketing and Advertising">Marketing and Advertising</option>
                                            <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                                            <option value="Media Production">Media Production</option>
                                            <option value="Medical Devices">Medical Devices</option>
                                            <option value="Medical Practice">Medical Practice</option>
                                            <option value="Mental Health Care">Mental Health Care</option>
                                            <option value="Military">Military</option>
                                            <option value="Mining & Metals">Mining & Metals</option>
                                            <option value="Motion Pictures and Film">Motion Pictures and Film</option>
                                            <option value="Museums and Institutions">Museums and Institutions</option>
                                            <option value="Music">Music</option>
                                            <option value="Nanotechnology">Nanotechnology</option>
                                            <option value="Newspapers">Newspapers</option>
                                            <option value="Non-Profit Organization Management">Non-Profit Organization Management</option>
                                            <option value="Oil & Energy">Oil & Energy</option>
                                            <option value="Online Media">Online Media</option>
                                            <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                                            <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                                            <option value="Packaging and Containers">Packaging and Containers</option>
                                            <option value="Paper & Forest Products">Paper & Forest Products</option>
                                            <option value="Performing Arts">Performing Arts</option>
                                            <option value="Pharmaceuticals">Pharmaceuticals</option>
                                            <option value="Philanthropy">Philanthropy</option>
                                            <option value="Photography">Photography</option>
                                            <option value="Plastics">Plastics</option>
                                            <option value="Political Organization">Political Organization</option>
                                            <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                                            <option value="Printing">Printing</option>
                                            <option value="Professional Training & Coaching">Professional Training & Coaching</option>
                                            <option value="Program Development">Program Development</option>
                                            <option value="Public Policy">Public Policy</option>
                                            <option value="Public Relations and Communications">Public Relations and Communications</option>
                                            <option value="Public Safety">Public Safety</option>
                                            <option value="Publishing">Publishing</option>
                                            <option value="Railroad Manufacture">Railroad Manufacture</option>
                                            <option value="Ranching">Ranching</option>
                                            <option value="Real Estate">Real Estate</option>
                                            <option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
                                            <option value="Religious Institutions">Religious Institutions</option>
                                            <option value="Renewables & Environment">Renewables & Environment</option>
                                            <option value="Research">Research</option>
                                            <option value="Restaurants">Restaurants</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Security and Investigations">Security and Investigations</option>
                                            <option value="Semiconductors">Semiconductors</option>
                                              
                                        </select>
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
                                <button class="w-100 btn btn-primary btn-smt" type="submit">Sign Up</button>
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
