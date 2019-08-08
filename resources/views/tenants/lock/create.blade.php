@extends ('layouts.app', ['title' => 'Deactiveer huurder'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Deactiveer huurder</div>

            <div class="d-flex page-options">
                <a href="{{ route('tenants.overview') }}" class="btn btshadow btn-secondary">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('tenants._partials.sidenav', ['huurder' => $tenant])
            </div> {{-- /// END sidebar --}}
        </div>
    </div>
@endsection
