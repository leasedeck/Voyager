@extends ('layouts.app', ['title' => 'Lokaal opmerkingen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Opmerkingen omtrent {{ ucfirst($lokaal->naam) }}</div>

            <div class="page-options d-flex">
                <a href="" class="btn btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="form-inline border-0 shadow-sm form-search ml-2">
                    <div class="form-group has-search">
                        <span class="fe fe-search form-control-feedback"></span>
                        <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                    </div>
                </form>
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
                                <tr>
                                    <td class="font-weight-bold">{{ ucfirst($opmerking->creator->name ?? config('app.name')) }}</td>
                                    <td>{{ ucfirst($opmerking->titel) }}</td>
                                    <td>{{ $opmerking->created_at->diffForHumans() }}</td>

                                    <td> {{-- Option shortcut icons --}}
                                        <span class="float-right">
                                            <a href="{{ route('lokalen.opmerkingen.show', $opmerking) }}" class="text-decoration-none text-muted mr-1">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            @can('wijzig-lokaal-opmerking', $opmerking)
                                                <a href="{{ route('lokalen.opmerkingen.wijzig', $opmerking) }}" class="text-decoration-none text-muted mr-1">
                                                    <i class="fe fe-edit-3"></i>
                                                </a>
                                            @endcan

                                            @can('verwijder-opmerking', $opmerking)
                                                <a href="{{ route('lokaal.opmerking.destroy', $opmerking) }}" data-method="DELETE" class="text-decoration-none text-danger">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            @endcan
                                        </span>
                                    </td> {{-- /// Options shortcut options --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">
                                        <i class="fe fe-info mr-1"></i>

                                        @if (request()->has('term'))
                                            Er zijn geen opmerkingen gevonden die matchen met je zoekterm.
                                        @else
                                            Er zijn momenteel geen opmerkingen voor het <span class="font-weight-bold">{{ $lokaal->naam }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $opmerkingen->links() }} {{-- Pagination view partial --}}
            </div>
        </div>
    </div>
@endsection
