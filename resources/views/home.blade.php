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

    <div class="container-fluid pb-3">
        <div class="row"> {{-- Widgets --}}
            <div class="col-3"> {{-- lokalen widget --}}
                <div class="card border-0 shadow-sm mb-4 p-2">
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
            </div> {{-- /// END widgets --}}

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
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
            </div>

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2"> {{-- Huurders widget --}}
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
            </div>

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
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
            </div>
        </div> {{-- /// END widgets --}}
    </div>

    <div class="container-fluid pb-2">
    </div>
@endsection
