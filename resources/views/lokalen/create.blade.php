@extends('layouts.app', ['title' => 'Lokalen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Lokaal toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.index') }}" class="btn btn-secondary">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form method="POST" action="{{ route('lokalen.store') }}" class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">Lokaal toevoegen</strong></h6>
            @csrf {{-- Form field protection --}}
            
            <div class="row mt-2">
                <div class="col-3">
                    <h5>Algemene informatie</h5>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="name">Naam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('naam', 'is-invalid')" placeholder="Lokaal naam (vb. Kapoenenlokaal)" @input('naam')>
                            @error('naam')
                        </div>

                        <div class="form-group col-5">
                            <label for="verantwoordelijke">Verantwoordelijke algemeen <span class="text-danger">*</span></label>
                            
                            <select class="custom-select @error('verantwoordelijke_algemeen', 'is-invalid')" @input('verantwoordelijke_algemeen')>
                                <option>-- lokaal verantwoordelijke --</option>
                                
                                @foreach ($users as $user) {{-- Loop trough the users --}}
                                    <option value="{{ $user->id}}" @if (old('verantwoordelijke_algemeen') === $user->id) selected @endif>
                                        {{ ucfirst($user->voornaam) }} {{ ucfirst($user->achternaam) }}
                                    </option>
                                @endforeach {{-- /// END loop --}}
                            </select>

                            @error('verantwoordelijke_algemeen') {{-- Validation error view partial --}}
                        </div>

                        <div class="form-group col-6 mb-0">
                            <label for="persons">Aantal personen <span class="text-danger">*</span></label>
                            <input aria-describedby="personsHelpBlock" type="text" class="form-control @error('aantal_personen', 'is-invalid')" placeholder="Capaciteit aantal personen" @input('aantal_personen')>
                            
                            @if ($errors->has('aantal_personen'))
                                @error('aantal_personen') {{-- Validation error view partial --}}
                            @else {{-- Display the help text --}}
                                <small id="personsHelpBlock" class="form-text text-muted">
                                    Vul <strong>n.v.t</strong> in als u lokaal een nutslokaal is zoals een toilet, keuken, vuurplaats, enz.
                                </small>
                            @endif
                        </div>

                        <div class="form-group- col-6 mb-0">
                            <label for="capactiyType">Capaciteits type <span class="text-danger">*</span></label>
                            
                            <select class="custom-select @error('capaciteits_type', 'is-invalid')" @input('capaciteits_type')>
                                <option>-- selecteer capaciteits type --</option>
                                @options($capacityTypes, 'capaciteits_type', old('capaciteits_type'))
                            </select>

                            @error('capaciteits_type')
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-3">
                    <h5>Configuratie werkpunten</h5>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-7 mb-0">
                            <label for="werkpunten">Werkpunten beheer</label>

                            <select class="custom-select" @input('werkpunten_beheer')>
                                @options($todoSelect, 'werkpunten_beheer', old('werkpunten_beheer'))
                            </select>

                            @error('werkpunten_beheer')
                        </div>

                        <div class="form-group col-5">
                            <label for="verantwoordelijke">Verantwoordelijke onderhoud <span class="text-danger">*</span></label>
                            
                            <select class="custom-select @error('verantwoordelijke_onderhoud', 'is-invalid')" @input('verantwoordelijke_onderhoud')>
                                <option>-- onderhouds verantwoordelijke --</option>
                                
                                @foreach ($users as $user) {{-- Loop trough the users --}}
                                    <option value="{{ $user->id}}" @if (old('verantwoordelijke_onderhoud') === $user->id) selected @endif>
                                        {{ ucfirst($user->voornaam) }} {{ ucfirst($user->achternaam) }}
                                    </option>
                                @endforeach {{-- /// END loop --}}
                            </select>

                            @error('verantwoordelijke_onderhoud') {{-- Validation error view partial --}}
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group mb-0 col-12">
                    <div class="float-right">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fe fe-plus mr-2"></i> Toevoegen
                        </button>

                        <button type="reset" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection