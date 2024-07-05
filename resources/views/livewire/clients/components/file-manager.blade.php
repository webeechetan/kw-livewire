<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}"><i class='bx bx-line-chart'></i>{{ Auth::user()->organizations ? Auth::user()->organizations->name : 'No organization' }}</a></li>
            <li class="breadcrumb-item"><a wire:navigate href="{{ route('client.index') }}">All Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
        </ol>
    </nav>
    <livewire:clients.components.client-tabs :client="$client" @saved="$refresh" />

    <div class="row">
        <div class="col-md-12">
            <livewire:components.file-manager :client="$client" />
        </div>
    </div>

</div>
