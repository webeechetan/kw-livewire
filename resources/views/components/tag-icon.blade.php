<div class="card_style-tasks-item tag-icon"  
    style="background-color: {{ $tag['color'] }}; color: #fff;"
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    data-bs-original-title="{{$tag['name'] }}"
    
>
@php
    $icon = 'bx bx-tag';
    if($tag['name'] == 'Urgent'){
        $icon = 'bx bx-bell';
    }elseif($tag['name'] == 'Waiting'){
        $icon = 'bx bx-time';
    }elseif($tag['name'] == 'Meeting'){
        $icon = 'bx bx-headphone';
    }elseif($tag['name'] == 'Optional'){
        $icon = 'bx bx-check-circle';
    }elseif($tag['name'] == 'Post') {
        $icon = 'bx bx-paper-plane';
    }
@endphp
    <span class="btn-icon-task-action"><i class='bx {{ $icon }}' ></i></span>

    {{ $tag['name'] }}
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".tag-icon").hover(function() {
            $(this).find('.btn-icon-task-action').addClass("bx-tada");
        }, function() {
            $(this).find('.btn-icon-task-action').removeClass("bx-tada");
        });
    });
</script>
@endpush