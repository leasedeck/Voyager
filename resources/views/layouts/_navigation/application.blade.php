<a class="nav-link {{ active('home') }}" href="{{ route('home') }}">
    <i class="fe fe-home mr-1 text-secondary"></i> Dashboard
</a>

@if ($currentUser->hasRole('admin'))
    <a class="nav-link {{ active('users.*') }}" href="{{ route('users.index') }}">
        <i class="fe fe-users mr-1 text-secondary"></i> Gebruikers
    </a>
@endif