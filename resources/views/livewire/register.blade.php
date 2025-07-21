<div>
    <div class="header-signup d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <img class="img-fluid" src="{{ asset('') }}assets/images/logo.png" alt="Kaykewalk Logo" />
                </div>
                <div class="col-sm-6 text-md-end">
                    <a wire:navigate href="/login">
                        <button class="btn btn-primary-border btn-smt">Sign In</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="signup-content">
        <div class="container">

            <div class="row signup-form-card">
                <div class="col-lg-6 mx-auto">
                    <div class="mx-auto text-center">
                        <img class="signup-welcome-img" src="{{ asset('') }}assets/images/signup_welcome.png"
                            alt="Sign Up Welcome" />
                        <div class="title-wrap">
                            <h2 class="title mt-3">Welcome to Kaykewalk</h2>
                            <p>Let’s get started with a few simple steps</p>
                        </div>
                    </div>
                    <div class="signup-form">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-field mb-4" controlId="signupName">
                                        <div class="form-field-icon"><i class='bx bx-building'></i></div>
                                        <input type="text" wire:model="name" class="form-control"
                                            placeholder="Organization Name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-user'></i></div>
                                        <input type="text" wire:model="user_name" class="form-control"
                                            placeholder="Enter First Name" />
                                        @error('user_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Added Last Name -->
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-user'></i></div>
                                        <input type="text" wire:model="last_name" class="form-control"
                                            placeholder="Enter Last Name" />
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-envelope'></i></div>
                                        <input type="email" wire:model="email" class="form-control"
                                            placeholder="Enter Email" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupPassword">
                                        <div class="form-field-icon"><i class='bx bx-lock-open'></i></div>
                                        <input type="password" wire:model="password" class="form-control"
                                            placeholder="Password 8+ Characters" />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-field" controlId="signupEmail">
                                        <div class="form-field-icon"><i class='bx bx-lock-open'></i></div>
                                        <input type="password" wire:model="confirm_password" class="form-control"
                                            placeholder="Confirm Password" />
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="my-3">
                                <button class="w-100 btn btn-primary btn-smt text-lg " wire:click="register"
                                    type="button">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
