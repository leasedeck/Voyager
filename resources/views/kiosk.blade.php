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
@endsection