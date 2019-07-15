<div class="card">
    <div class="card-header">
        <i class="fe mr-2 fe-menu"></i> Menu
    </div>

    <div class="list-group list-group-flush">
        <a href="{{ route('alerts.index') }}" class="list-group-item list-group-item-action">
            <i class="fe fe-bell text-muted mr-2"></i> Notificatie verzenden
        </a>

        <a href="{{ route('alerts.overview') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span class="float-left"><i class="fe fe-list text-muted mr-2"></i> Verzonden notificaties</span>
            <span class="badge badge-primary badge-pill">1</span>
        </a>
    </div>
</div>