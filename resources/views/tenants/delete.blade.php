@extends ('layouts.app', ['title' => 'Huurders'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">{{ ucfirst($tenant->naam) }} verwijderen als huurder. </div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.overview') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-users mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- SIDENAV --}}
                @include ('tenants._partials.sidenav', ['huurder' => $tenant])
            </div> {{-- /// END sidenav --}}

            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="{{ route('tenants.delete', $tenant) }}" class="card card-body border-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">{{ ucfirst($tenant->naam) }} verwijderen als huurder.</h6>
                    @csrf {{-- Form field protection --}}
                    @method('DELETE') {{-- HTTP method spoofing --}}

                    <p class="card-text text-danger">
                        <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om <span class="font-weight-bold">{{ ucfirst($tenant->naam) }}</span> als huurder te verwijderen.
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van {{ ucfirst($tenant->naam) }} worden ook de notities, status en verhuringen mee verwijderdin de applicatie. <br>
                        Dus wees zeker of u wel degelijk wilt doorgaan met de handeling. En daarom vragen wij ook u wachtwoord in te geven ter controle.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="bevestiging" class="sr-only">bevestiging</label>
                            <input id="bevestiging" type="password" class="form-control @error('bevestiging', 'is-invalid')" placeholder="Wachtwoord ter controle" @input('bevestiging')>
                            @error('bevestiging')
                        </div>

                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-2"></i> verwijder
                            </button>

                            <a class="btn btn-light" href="{{ route('tenants.overview') }}">
                                <i class="fe fe-rotate-ccw text-danger mr-2"></i> annuleer
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
