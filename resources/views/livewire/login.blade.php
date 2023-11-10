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
                        <h2 class="title">Sign In to your account</h2>
                        <a href="#" class="signin-google-btn w-100">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Google SVG paths -->
                            </svg>
                            <span>google</span>
                        </a>
                        <p><small>or sign in with your E-mail</small></p>
                    </div>
                    <div class="signin-content-right-btm mt-4">
                        <form wire:submit="login" method="POST">
                            <div class="mb-3" controlId="signinEmail">
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <MarkEmailReadTwoToneIcon />
                                    </div>
                                    <input type="email" wire:model="email" class="form-control" placeholder="Enter Email" required />
                                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="mb-3" controlId="signinPassword">
                                <div class="form-field">
                                    <div class="form-field-icon">
                                        <LockOpenTwoToneIcon />
                                    </div>
                                    <input type="password" wire:model="password" class="form-control" placeholder="Enter Password" required />
                                    @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#" class="text-link">Forgot Password?</a>
                                </div>
                            </div>
                            @if(session()->has('error'))
                                <div class="col">
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            <div class="btn-group mt-2">
                                <div class="col">
                                    <button class="w-100 btn btn-primary" type="submit">Sign In</button>
                                </div>
                            </div>
                        </form>
                        <div class="col mt-3">
                            <a wire:navigate href="/register">
                                <button class="w-100 btn btn-primary-border">Sign Up</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>