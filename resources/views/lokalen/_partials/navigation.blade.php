<div class="card-header card-header-nav bg-card-nav">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link text-brown {{ active('lokalen.show') }}" href="{{ route('lokalen.show', $lokaal) }}">
                <i class="fe text-brown fe-info mr-1"></i> Algemene informatie
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-brown" href="#">
                <i class="fe text-brown fe-edit-3 mr-1"></i> Opmerkingen
                <span class="badge badge-secondary ml-1 badge-pill">0</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link text-brown dropdown-toggle" data-toggle="dropdown" href="{{ config('app.url') }}" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fe fe-alert-triangle mr-1 text-brown"></i> Werkpunten
            </a>
                        
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Open werkpunten <span class="small text-muted">(0)</span></a>
                <a class="dropdown-item" href="#">Gesloten werkpunten <span class="small text-muted">(0)</span></a>
                <a class="dropdown-item" href="#">Toegewezen werkpunten <span class="small text-muted">(0)</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Alle werkpunten <span class="small text-muted">(0)</span></a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link text-brown {{ active('lokalen.delete') }}" href="{{ route('lokalen.delete', $lokaal) }}">
                <i class="fe fe-trash-2 text-brown mr-1"></i> Lokaal verwijderen
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link text-brown dropdown-toggle" data-toggle="dropdown" href="{{ config('app.url') }}" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fe fe-plus mr-1"></i> Toevoegen
            </a>
                        
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Werkpuntje</a>
                <a class="dropdown-item" href="#">Opmerking</a>
            </div>
        </li>
    </ul>
</div>