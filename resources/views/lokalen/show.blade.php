@extends ('layouts.app', ['title' => 'Lokalen'])

@section('content') 
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">{{ ucfirst($lokaal->naam) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.index') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
    
        <div class="card border-0">
            @include ('lokalen._partials.navigation', ['lokaal' => $lokaal])
            
            <form method="POST" action="{{ route('lokalen.store') }}" class="card-body">
                @csrf {{-- Form field protection --}}
                @form ($lokaal)

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
                                    <option value="">-- lokaal verantwoordelijke --</option>
                                    
                                
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
                                        Vul <strong>0</strong> in als u lokaal een nutslokaal is zoals een toilet, keuken, vuurplaats, enz.
                                    </small>
                                @endif
                            </div>

                            <div class="form-group- col-6 mb-0">
                                <label for="capactiyType">Capaciteits type <span class="text-danger">*</span></label>
                                
                                <select class="custom-select @error('capaciteits_type', 'is-invalid')" @input('capaciteits_type')>
                                    <option value="">-- selecteer capaciteits type --</option>
                                
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
                                
                                </select>

                                @error('werkpunten_beheer')
                            </div>

                            <div class="form-group col-5">
                                <label for="verantwoordelijke">Verantwoordelijke onderhoud <span class="text-danger">*</span></label>
                                
                                <select class="custom-select @error('verantwoordelijke_onderhoud', 'is-invalid')" @input('verantwoordelijke_onderhoud')>
                                    <option value="">-- onderhouds verantwoordelijke --</option>
                                    
                    
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
                                <i class="fe fe-save mr-2"></i> Aanpassen
                            </button>

                            <button type="reset" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection