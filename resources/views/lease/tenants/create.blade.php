@extends('layouts.app', ['title' => 'Verhuring toevoegen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Verhuring toevoegen voor {{ ucfirst($tenant->naam) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.leases.overview', $tenant) }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Side navigation --}}
                @include('tenants._partials.sidenav', ['huurder' => $tenant])
            </div> {{-- /// Side navigation --}}

            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="{{ route('tenant.lease.store', $tenant) }}" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">Verhuring toevoegen voor {{ ucfirst($tenant->naam) }}.</h6>
                    @csrf {{-- Form field protection --}}

                    <div class="row mt-2">
                        <div class="col-3">
                            <h5>Algemene informatie</h5>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="startDate">Start datum <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_datum', 'is-invalid')" id="startData" @input('start_datum')>
                                    @error('start_datum')
                                </div>

                                <div class="form-group col-6">
                                    <label for="endDate">Eind datum <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('eind_datum', 'is-invalid')" id="endDate" @input('eind_datum')>
                                    @error('eind_datum')
                                </div>

                                <div class="form-group col-8 mb-0">
                                    <label for="aantalPersonen">Aantal personen <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('aantal_personen', 'is-invalid')" placeholder="Aantal personen" @input('aantal_personen')>
                                    @error('aantal_personen')
                                </div>

                                <div class="form-group col-4 mb-0">
                                    <label for="status">Status <span class="text-danger">*</span></label>

                                    <select type="text" @input('status') class="custom-select @error('status', 'is-invalid')">
                                        <option value="">-- selecteer status --</option>
                                        @options($tags, 'status', old('status'))
                                    </select>

                                    @error('status') {{-- Error view partial --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-2">
                        <div class="col-3">
                            <h5>Extra informatie</h5>
                            <p class="card-text small text-muted">Extra informatie omtrent de verhuring waarvoor geen notitie hoeft aangemaakt te worden.</p>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-12 mb-0">
                                    <textarea class="form-control" placeholder="Extra informatie" @input('extra_informatie') rows="5">{{ old('extra_informatie') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="col-12 mb-0">
                            <span class="float-right">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fe fe-plus mr-2"></i> Toevoegen
                                </button>

                                <button type="reset" class="btn btn-light">
                                    <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div> {{-- /// Content --}}
        </div>
    </div>
@endsection
