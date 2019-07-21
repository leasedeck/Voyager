<a class="nav-link {{ active('home') }}" href="{{ route('home') }}">
    <i class="fe fe-home mr-1"></i> Dashboard
</a>

<a class="nav-link" href="">
    <i class="fe fe-list mr-1"></i> Verhuringen
    <small>(0)</small>
</a>

<a class="nav-link" href="">
    <i class="fe fe-users mr-1"></i> Huurders
</a>

<a class="nav-link" href="">
    <i class="fe fe-list mr-1"></i> Lokalen
</a>

<a class="nav-link" href="">
    <i class="fe fe-alert-triangle mr-1"></i> Werkpunten
    <small>(0)</small>
</a>

<a class="nav-link {{ active(['contacts.*', 'addresses.*']) }}" href="{{ route('contacts.index') }}">
    <i class="fe fe-book-open mr-1"></i> Contacten
</a>