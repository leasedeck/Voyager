<a class="nav-link {{ active('kiosk.dashboard') }}" href="{{ route('kiosk.dashboard') }}">
    <i class="fe fe-home mr-1 text-secondary"></i> Dashboard
</a>

@if ($currentUser->hasAnyRole(['admin', 'webmaster']))
    <a class="nav-link {{ active('users.*') }}" href="{{ route('users.index') }}">
        <i class="fe fe-users mr-1 text-secondary"></i> Gebruikers
    </a>
@endif