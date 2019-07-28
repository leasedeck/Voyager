@extends ('layouts.app', ['title' => 'Lokaal opmerkingen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Opmerkingen omtrent {{ ucfirst($lokaal->naam) }}</div>

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

            <div class="card-body">
                @include('flash::message') {{-- Flash session view partial. --}}

                <div class="table-responsive">
                    <table class="table-sm table-hover mb-0 table">
                        <thead>
                            <tr>
                                <th scope="col" class="border-top-0" style="width: 20%;">Auteur</th>
                                <th scope="col" class="border-top-0" style="width: 50%;">Titel</th>
                                <th scope="col" class="border-top-0" style="width: 15%;">Toegevoegd op</th>
                                <th scope="col" class="border-top-0" style="width: 15%;">&nbsp;</th> {{-- Kolom waar alleen functies worden gedefinieerd --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($opmerkingen as $opmerking)
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">
                                        <i class="fe fe-info mr-1"></i>
                                        Er zijn momenteel geen opmerkingen voor het <span class="font-weight-bold">{{ $lokaal->naam }}</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
