<div class="card mb-3">
    <div class="card-header">
        <i aria-hidden="true" class="fas mr-2 fa-fw fa-compass"></i> Informatie
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('lease.show', $lease) }}" class="list-group-item list-group-item-action {{ active('lease.show', 'font-weight-bold') }}">
            <i class="fas fa-info-circle fa-fw text-secondary mr-2"></i> Aanvraag informatie
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i aria-hidden="true" class="fas fa-bars mr-2 fa-fw"></i> Status
    </div>
</div>
