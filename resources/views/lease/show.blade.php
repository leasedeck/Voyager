@extends('layouts.app', ['title' => 'Informatie verhuring'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Verhuringen</h1>
            <div class="page-subtitle">Verhurings informatie</div>

            <div class="d-flex page-options">
                <a href="{{ route('leases.overview') }}" class="shadow-sm btn btn-secondary">
                    <i class="fe fe-list mr-2"></i> Verhuringen
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('lease._partials._lease-sidenav', ['lease', $lease])
            </div> {{-- /// Sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="" method="POST" class="card card-body shadow-sm border-0">
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
