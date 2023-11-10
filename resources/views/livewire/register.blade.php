<div>
    <div class="header-signup text-center d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div class="logo">
                        <img src="./assets/images/logo.png" alt="Kaykewalk Logo" />
                    </div>
                </div>
                <div class="col-sm-6 text-md-end">
                    <a wire:navigate href="/login">
                        <button class="btn btn-primary-border">Sign In</button>
                    </a>
                </div>
            </div>
        </div>
    </div> 
    <div class="signup-content space-sec">
        <div class="container">
            <div class="row">
                <div class="col text-center mx-auto">
                    <img class="signup-welcome-img" src="./assets/images/signup_welcome.png" alt="Sign Up Welcome" />
                    <div class="title-wrap">
                        <h2 class="title text-primary mt-3">Welcome to Kaykewalk</h2>
                        <p>Let’s get started with a few simple steps</p>
                    </div>
                    <div class="signup-form">
                        <form method="POST" wire:submit="register">
                            <div class="form-field mb-3" controlId="signupName">
                                <div class="form-field-icon"><PersonOutlineIcon /></div>
                                <input type="text" wire:model="name" class="form-control" placeholder="Enter Name"   />
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3 form-field" controlId="signupEmail">
                                <div class="form-field-icon"><MailOutlinedIcon /></div>
                                <input type="email" wire:model="email" class="form-control" placeholder="Work Email"   />
                                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3 form-field" controlId="signupPassword">
                                <div class="form-field-icon"><LockOpenOutlinedIcon /></div>
                                <input type="password" wire:model="password" class="form-control" placeholder="Password 8+ Characters"    />
                                @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <button class="w-100 btn btn-primary" type="submit">Sign Up</button>
                            </div>
                            <p>Or sign up with:</p>
                            <a href="#" class="signin-google-btn w-100">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Google SVG paths -->
                                </svg>
                                <span>google</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
