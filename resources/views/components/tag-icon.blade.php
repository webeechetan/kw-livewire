<div class="btn-batch tag-icon"  
    style="color: {{ $tag['color'] }};"
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    data-bs-original-title="{{$tag['name'] }}"
    
>
@php
    $icon = 'bx bx-tag';
    if($tag['name'] == 'Client Event'){
        $icon = 'bx bx-calendar-event';
    }elseif($tag['name'] == 'Waiting'){
        $icon = 'bx bx-time';
    }elseif($tag['name'] == 'Meeting'){
        $icon = 'bx bx-headphone';
    }elseif($tag['name'] == 'Office Event'){
        $icon = 'bx bx-calendar-event';
    }elseif($tag['name'] == 'Post') {
        $icon = 'bx bx-paper-plane';
    }elseif($tag['name'] == 'Stuck') {
        $icon = 'bx bx-pause-circle';
    }
@endphp
    <span class="btn-icon-task-action"><i class='bx {{ $icon }}' ></i></span>
    {{ $tag['name'] }}
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".tag-icon").hover(function() {
            $(this).find('.bx').addClass("bx-tada");
        }, function() {
            $(this).find('.bx').removeClass("bx-tada");
        });
    });
</script>
@endpush