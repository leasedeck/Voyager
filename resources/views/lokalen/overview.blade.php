@extends('layouts.app', ['title' => 'Lokalen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.create') }}" class="btn btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @if ($lokalen->total() === 0)
            <div class="blankslate bg-white shadow-sm">
                <h3 class="text-brown">Geen lokalen gevonden!</h3>
                <p class="pt-2">
                    Het lijkt erop dat er geen lokalen zijn toegevoegd in {{ config('app.name') }}. Of er geen lokalen gevonden zijn matchend met je zoekopdracht.
                </p>

                <a href="{{ route('lokalen.create') }}" class="btn border-0 mt-2 btn-secondary">
                    <i class="fe fe-plus mr-2"></i> Lokaal toevoegen
                </a>
            </div>
        @else {{-- Dorms are found so display the overview table --}}
            <div class="card card-body border-0 shadow-sm">
            </div>
        @endif
    </div>
@endsection