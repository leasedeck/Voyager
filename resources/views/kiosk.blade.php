@extends('layouts.app', ['title' => 'Kiosk dashboard'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <div class="page-title">{{ config('app.name') }} - Kiosk</div>
            <div class="page-subtitle">Dashboard</div>

            <div class="page-options d-flex">
                <a href="{{ route('home') }}" class="btn btn-danger border-0 shadow-sm">
                    <i class="fe fe-rotate-ccw mr-2"></i> Verlaat kiosk
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row"> {{-- Widgets- --}}
            <div class="col-4"> {{-- User widget --}}
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-users"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $users->total }} <small>gebruikers</small></h5>
                            <small class="text-muted">waarvan {{ $users->deactivated_count }} gedeactiveerd</small>
                        </div>
                    </div>
                </div> {{-- /// END user widget --}}
            </div> {{-- /// END widgets --}}

            <div class="col-4"> {{-- Audit widget --}}
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-activity"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $audit->total }} <small>Audit logs</small></h5>
                            <small class="text-muted">waarvan {{ $audit->total_today }} vandaag</small>
                        </div>
                    </div>
                </div>
            </div> {{-- /// END audit widget --}}

            <div class="col-4"> {{-- system notifications widget --}}
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-bell"></i>
                        </span>

                        <div>
                            <h5 class="m-0">0 <small>Systeem notificaties</small></h5>
                            <small class="text-muted">waarvan 0 vandaag verzonden</small>
                        </div>
                    </div>
                </div>
            </div> {{-- /// END system notifications widget --}}
        </div> {{-- /// END widgets --}}

        <div class="row">
            @if ($audit->total > 0) 
                <div class="col-12"> {{-- Short activity overview --}}
                    <div class="card card-body border-0 shadow-sm">
                    </div>
                </div> {{-- /// END Short activity overview --}}
            @endif
        </div>
    </div>
@endsection