@if($user->image && $user->image != 'default.png')
    <a href="#" class="avatarGroup-avatar">
        <span class="avatar avatar-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">
            <img alt="avatar" src="{{ asset('storage/'.$user->image) }}" class="rounded-circle">
        </span>
    </a>
@else
    <a href="#" class="avatarGroup-avatar">
        <span class="avatar avatar-sm avatar-{{$user->color}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $user->name }}">{{ $user->initials }}</span>
    </a>
@endif