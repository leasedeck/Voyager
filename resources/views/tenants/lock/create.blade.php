@extends ('layouts.app', ['title' => 'Deactiveer huurder'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Deactiveer huurder</div>

            <div class="d-flex page-options">
                <a href="{{ route('tenants.overview') }}" class="btn btshadow btn-secondary">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('tenants._partials.sidenav', ['huurder' => $tenant])
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">{{ ucfirst($tenant->naam) }} als huurder deactiveren.</h6>

                    @csrf {{-- Form field protection --}}

                    <div class="alert alert-info alert-important border-0" role="alert">
                        <span class="font-weight-bold mr-2"><i class="fe fe-info"></i> Let op!</span>
                        Bij het deactiveren van een huurder verhinder je dat er nog verhuringen kunnen toegevoegd worden op naam van de gegeven huurder.<br>
                        Daarnaast vragen we je ook een reden op te geven waarom je de huurder deactiveerd. Zodat andere gebruikers in de applicatie weten waarom de huurder
                        is gedeactiveerd.
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="reason">Deactivatie reden <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('comment', 'is-invalid')" @input('comment') id="reason" rows="5" placeholder="Beschrijf waarom de huurder word gedeactiveerd">{{ old('comment') }}</textarea>
                            @error('comment')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-user-lock fa-fw mr-1"></i> deactiveren
                            </button>

                            <a href="{{ route('tenants.show', $tenant) }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger mr-1"></i> Annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
