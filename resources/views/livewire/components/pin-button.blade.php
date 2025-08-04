<div>
    <button type="button" class="btn-sm btn-border btn-border-primary @if($pinned) active @endif" wire:click="togglePin" wire:loading.attr="disabled">
        
        <span wire:loading wire:target="togglePin">
            <i class='bx bx-loader-alt bx-spin'></i>
        </span>
    
        <i class='bx bx-pin'></i>
        @if($content)
            @if($pinned)
                Unpin
            @else
                Pin
            @endif
        @endif
    </button>
</div>
