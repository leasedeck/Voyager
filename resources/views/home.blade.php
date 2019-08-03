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

    </div>
@endsection
