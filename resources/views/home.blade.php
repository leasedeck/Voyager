@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <div class="page-title">{{ config('app.name') }}</div>
            <div class="page-subtitle">Dashboard</div>

            @if ($currentUser->hasAnyRole(['admin', 'webmaster']))
                <div class="page-options d-flex">
                    <a href="{{ route('kiosk.dashboard') }}" class="btn btn-secondary border-0 shadow-sm">
                        <i class="fe fe-corner-up-right mr-2"></i> Naar kiosk
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="container-fluid">
        <div class="row"> {{-- Widgets --}}
            <div class="col-3"> {{-- lokalen widget --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body mb-1 p-2">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md shadow-sm bg-brown mr-3">
                                <i class="fe fe-home"></i>
                            </span>

                            <div>
                                <h5 class="m-0">0 <small>lokalen</small></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div> {{-- /// END lokalen widget --}}

                    <div class="card-footer border-top-0 p-1 text-center bg-widget font-weight-bolder">
                        <a href="{{ route('lokalen.index') }}" class="text-decoration-none text-muted">
                            Bekijk alle lokalen <i class="fe fe-chevrons-right"></i>
                        </a>
                    </div>
                </div>
            </div> {{-- /// END widgets --}}

            <div class="col-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body mb-1 p-2">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md shadow-sm bg-brown mr-3">
                                <i class="fe fe-calendar"></i>
                            </span>

                            <div>
                                <h5 class="m-0">0 <small>Verhuringen</small></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer p-1 border-top-0 text-center bg-widget font-weight-bolder">
                        <a href="{{ route('leases.overview') }}" class="text-decoration-none text-muted">
                            Bekijk alle verhuringen <i class="fe fe-chevrons-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body mb-1 p-2"> {{-- Huurders widget --}}
                        <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm bg-brown mr-3">
                            <i class="fe fe-users"></i>
                        </span>

                            <div>
                                <h5 class="m-0">0 <small>Huurders</small></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div> {{-- /// ENd huurder widget --}}

                    <div class="card-footer p-1 border-top-0 text-center bg-widget font-weight-bolder">
                        <a href="{{ route('tenants.overview') }}" class="text-decoration-none text-muted">
                            Bekijk alle huurders <i class="fe fe-chevrons-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body mb-1 p-2">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md shadow-sm bg-brown mr-3">
                                <i class="fe fe-alert-triangle"></i>
                            </span>

                            <div>
                                <h5 class="m-0">0 <small>werkpunten</small></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-top-0 p-1 text-center bg-widget font-weight-bolder">
                        <a href="" class="text-decoration-none text-muted">
                            Bekijk alle werkpunten <i class="fe fe-chevrons-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> {{-- /// END widgets --}}
    </div>

    <div class="container-fluid py-4">
        <div class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="text-brown fe fe-home mr-1"></i> Nieuwe aanvragen
                <a href="{{ route('leases.overview') }}" class="text-decoration-none text-primary small float-right">
                    <i class="fe fe-list mr-1"></i> Alle verhuringen
                </a>
            </h6>
        </div>
    </div>
@endsection
