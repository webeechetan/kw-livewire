@if($user->image && $user->image != 'default.png')
    <a href="#" class="avatarGroup-avatar">
        <span title="{{$user->name}}" class="avatar {{$class}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">
            <img alt="{{ $user->name }}" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
        </span>
    </a>
@else
    <a href="#" class="avatarGroup-avatar">
        <span title="{{$user->name}}" class="avatar {{$class}} avatar-{{$user->color}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</span>
    </a>
@endif