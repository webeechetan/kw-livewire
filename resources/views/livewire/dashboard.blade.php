<div>
    Welcome , {{ Auth::guard(session('guard'))->user()->name }} 
    <a href="{{ route('logout') }}">Logout</a>
</div>
