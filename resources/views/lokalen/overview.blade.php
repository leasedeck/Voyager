@extends('layouts.app', ['title' => 'Lokalen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.create') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @include ('flash::message') {{-- Flash session view partial --}}

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
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Lokaal naam</th>
                                <th class="border-top-0" scope="col">Verantwoordelijke</th>
                                <th class="border-top-0" scope="col">Capaciteit</th>
                                <th class="border-top-0" scope="col">Werkpunten beheer</th>
                                <th class="border-top-0" scope="col">&nbsp;</th> {{-- OKolom voor de functie shortcuts --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokalen as $lokaal) {{-- Loop door de lokalen heen --}}
                                <tr>
                                    <td class="font-weight-bold">{{ $lokaal->naam }}</td>

                                    <td> {{-- Verantwoordelijke --}}
                                        <i class="fe fe-home text-secondary mr-1"></i> {{ $lokaal->verantwoordelijkeAlgemeen->name ?? 'Onbekend' }}
                                        <span class="text-muted px-1">/</span>
                                        <i class="fe fe-settings text-secondary mr-1"></i> {{ $lokaal->verantwoordelijkeOnderhoud->name ?? 'Onbekend'}}
                                    </td> {{-- /// verantwoordelijke --}}

                                    <td class="text-muted"> {{-- Capaciteit --}}
                                        @if ($lokaal->capaciteits_type !== 'n.v.t')
                                            {{ $lokaal->aantal_personen }} {{ $lokaal->capaciteits_type }}
                                        @else {{-- Lokaal is een nuts lokaal --}}
                                            n.v.t
                                        @endif
                                    </td> {{-- /// Capciteit --}}

                                    <td class="text-muted"> {{-- Werkpunten --}}
                                        @if ($lokaal->werkpunten_beheer)
                                            <span class="text-success">0 Open</span>
                                            <span class="text-muted px-1">/</span>
                                            <span class="text-danger">0 Gesloten</span>
                                        @else 
                                            gedeactiveerd
                                        @endif
                                    </td> {{-- /// Werkpunten --}}

                                    <td>
                                        <span class="float-right">
                                            <a href="" class="text-decoration-none text-muted">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            <a href="" class="text-decoration-none text-muted ml-1">
                                                <i class="fe fe-edit-2"></i>
                                            </a>

                                            @if ($currentUser->can('delete', $lokaal))
                                                <a href="" class="text-decoration-none text-danger ml-1">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $lokalen->links() }} {{-- Pagination view instance --}}
            </div>
        @endif
    </div>
@endsection