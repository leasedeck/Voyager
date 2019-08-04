@extends('layouts.app', ['title' => 'Huurders'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.create') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @if ($tenants->total() === 0)
            <div class="blankslate bg-white shadow-sm">
                <h3 class="text-brown">Geen huurders gevonden!</h3>
                <p class="pt-2">
                    Het lijkt erop dat er geen huurders zijn toegevoegd in {{ config('app.name') }}. Of er geen huurders gevonden zijn matchend met je zoekopdracht.
                </p>

                <a href="{{ route('tenants.create') }}" class="btn border-0 mt-2 btn-secondary">
                    <i class="fe fe-plus mr-2"></i> Huurder toevoegen
                </a>
            </div>
        @else
        @endif
    </div>
@endsection