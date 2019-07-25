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
            
            <form method="POST" action="{{ route('lokalen.delete', $lokaal) }}" class="card card-body shadow-sm border-0">
                @csrf               {{-- Form field protection --}}
                @method ('DELETE')  {{-- HTTP method spoofing --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">{{ $lokaal->naam }} verwijderen</h6>

                <p class="card-text text-danger">
                    <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt het lokaal <span class="font-weight-bold">{{ $lokaal->naam }}</span> te verwijderen in {{ config('app.name') }}.
                </p>

                <p class="card-text">
                    <span class="font-weight-bold mr-2">Let op!</span> Bij het verwijderen van {{ $lokaal->naam }} als lokaal in {{ config('app.name') }}, zullen ook de werkpunten en opmerkingen worden verwijderd.<br>
                    Als ook zal dit lokaal niet meer kunnen worden gekoppeld aan een verhuring en zullen de verantwoordelijke personen worden losgekoppeld en op de hoogte worden gebracht worden 
                    van de verwijdering.
                </p>

                <p class="card-text font-weight-bold">Dus wees zeker of dit lokaal wel degelijk wilt verwijderen!</p> 

                <hr class="mt-0">
                
                <div class="form-row">
                    <div class="form-group mb-0 col-12">
                        <button type="submit" class="btn btn-danger">
                            <i class="fe fe-trash-2 mr-2"></i> verwijderen
                        </button>

                        <a href="{{ route('lokalen.index') }}" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-2"></i> annuleren
                        </a>
                    </div>
                </div>
            </form>

    </div>
@endsection