<div>
    Welcome , {{ Auth::guard('orginizations')->user()->name }}
    <a href="{{ route('logout') }}">Logout</a>
</div>
