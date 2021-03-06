<div class="card mb-4 shadow-sm">
    <div class="card-header">
        <i class="fas mr-2 fa-fw fa-compass"></i> Informatie
    </div>

    <div class="list-group list-group-flush">
        <a href="{{ route('tenants.show', $tenant) }}" class="list-group-item-action {{ active('tenants.show', 'font-weight-bold') }} list-group-item">
            <i class="fas fa-fw fa-user text-secondary mr-2"></i> Algemene informatie
        </a>

        <a href="{{ route('tenants.leases.overview', $huurder) }}" class="list-group-item-action {{ active('tenants.leases*', 'font-weight-bold') }} list-group-item">
            <i class="fas fa-list fa-fw text-secondary mr-2"></i>Verhuringen
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class=card-header>
        <i class="fas fa-sliders-h fa-fw mr-2"></i> Opties
    </div>

    <div class="list-group list-group-flush">
        <a href="mailto: {{ $huurder->email }}" class="list-group-item list-group-item-action">
            <i class="fas fa-envelope-open-text mr-2 text-secondary fa-fw"></i> Contacteer huurder
        </a>

        @if ($currentUser->can('lock', $huurder))
            <a href="{{ route('tenants.lock', $huurder) }}" class="{{ active('tenants.lock', 'font-weight-bold') }} list-group-item list-group-item-action">
                <i class="fas fa-user-lock fa-fw text-secondary mr-2"></i> Huurder deactiveren
            </a>
        @elseif($currentUser->can('unlock', $huurder))
            <a href="{{ route('tenants.unlock', $huurder) }}" class="list-group-item list-group-item-action">
                <i class="fas fa-unlock-alt fa-fw text-secondary mr-2"></i> Deactivatie opheffen
            </a>
        @endif

        <a href="{{ route('tenants.delete', $huurder) }}" class="list-group-item {{ active('tenants.delete', 'font-weight-bold') }} shadow-sm list-group-item-action">
            <i class="fas text-danger fa-user-slash fa-fw text-danger mr-2"></i> Verwijder huurder
        </a>
    </div>
</div>
