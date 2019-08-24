@extends('layouts.app', ['title' => 'Verhuringen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Verhuringen van {{ $tenant->naam }}</div>

            <div class="d-flex page-options">
                <a href="{{ route('tenants.leases.create', $tenant) }}" class="btn btshadow btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <div class="btn-group ml-2">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">
                        <i class="fe mr-1 fe-filter"></i> Filter
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('tenants.leases.overview', $tenant) }}" class="dropdown-item">Alle verhuringen</a>
                    </div>
                </div>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoek verhuring" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidenav --}}
                @include('tenants._partials.sidenav', ['huurder' => $tenant])
            </div> {{-- /// END sidenav --}}

            <div class="col-9"> {{-- Content --}}
                @if ($leases->total() === 0)
                    <div class="blankslate bg-white shadow-sm">
                        <h3 class="text-brown">Geen verhuringen gevonden!</h3>
                        <p class="pt-2">
                            Het lijkt erop dat {{ ucfirst($tenant->naam) }} geen verhuringen heeft aangevraagd. Of er geen verhuringen zijn gevonden in je zoekopdracht of toegepaste filter optie.
                        </p>

                        <a href="{{ route('tenants.leases.create', $tenant) }}" class="btn border-0 mt-2 btn-secondary">
                            <i class="fe fe-plus mr-2"></i> Verhuring toevoegen
                        </a>
                    </div>
                @else {{-- Er zijn verhuringen gevonden --}}
                    <div class="card card-body border-0 shadow-sm">
                    </div>
                @endif
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
