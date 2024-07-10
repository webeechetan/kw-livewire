<div class="container">
    <!-- Dashboard Header -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i> {{ Auth::user()->organizations ? Auth::user()->organizations->name : 'No organization' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-8">
            <div class="box-item">
                <div class="row align-items-center">
                    <div class="col-md">
                        <div class="welcome-box">
                            <h2 class="title">Hi {{ Auth::guard(session('guard'))->user()->name }}, <br /><b>Welcome back</b></h2>
                            @if(session()->has('newly_registered'))
                                <p class="text-muted">You have successfully registered. Please check your email to verify your account.</p>
                            @endif
                            {{-- {{ Auth::user()->roles->pluck('name') }} --}}
                        </div>
                    </div>
                    <div class="col-md-auto text-end">
                        <div class="welcome-box-img">
                            <img src="./assets/images/welcome-img.png" alt="Kaykewalk Welcome" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>