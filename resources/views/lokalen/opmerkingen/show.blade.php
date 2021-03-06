@extends ('layouts.app', ['title' => 'Lokalen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">{{ ucfirst($lokaal->naam) }}</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card border-0">
            @include ('lokalen._partials.navigation', ['lokaal' => $lokaal])

            <div class="card-body">
                <h6 class="border-bottom border-gray pb-1 mb-2">{{ ucfirst($note->titel) }}</h6>

                <div class="notitie-subheading">
                    <span class="font-weight-bold"><i class="fe fe-user mr-1"></i> Auteur:</span> {{ ucfirst($note->creator->name ?? config('app.name')) }}
                    <span class="font-weight-bold"><i class="fe fe-home ml-3 mr-1"></i> Lokaal:</span> {{ ucfirst($note->lokaal->naam) }}
                    <span class="font-weight-bold"><i class="fe fe-clock mr-1 ml-3"></i> Toegevoegd op:</span> {{ $note->created_at->format('d/m/Y') }} ({{ $note->created_at->diffForHumans() }})
                </div>

                <div class="markdown-text mt-3">
                    {!! md_to_html($note->opmerking) !!}
                </div>

                <hr>

                <p class="card-text notitie-options">
                    <a href="{{ route('lokalen.opmerkingen', $note->lokaal) }}" class="card-link text-muted">
                        <i class="fe fe-chevrons-left mr-1"></i> Overzicht
                    </a>

                    <span class="float-right">
                        @if ($currentUser->can('wijzig-lokaal-opmerking', $note))
                            <a href="{{ route('lokalen.opmerkingen.wijzig', $note) }}" class="card-link text-muted">
                                <i class="fe fe-edit-3 mr-1"></i> Wijzig
                            </a>
                        @endif

                        @if ($currentUser->can('verwijder-opmerking', $note))
                            <a href="{{ route('lokaal.opmerking.destroy', $note) }}" data-method="DELETE" class="card-link text-muted">
                                <i class="fe fe-trash-2 text-danger mr-1"></i> Verwijder
                            </a>
                        @endif
                    </span>
                </p>
            </div>
        </div>
    </div>
@endsection
