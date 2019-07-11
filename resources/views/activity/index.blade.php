@extends('layouts.app', ['title' => 'Audit'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Activiteit audit</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                @if ($currentUser->hasRole('webmaster'))
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe mr-1 fe-download"></i> Export
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('audit.export', ['filter' => '3-months'])}}">Afgelopen 3 maanden</a>
                            <a class="dropdown-item" href="{{ route('audit.export', ['filter' => '6-months']) }}">Afgelopen 6 maanden</a>
                            <a class="dropdown-item" href="{{ route('audit.export', ['filter' => 'recent-year']) }}">Afgelopen jaar</a>
                            <a class="dropdown-item" href="{{ route('audit.export') }}">Alle logs</a>
                        </div>
                    </div>
                @endif

                <form method="GET" action="{{ route('audit.search') }}" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="{{ request()->get('term') }}" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-sm mb-0 table-hover">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Persoon</th>
                            <th class="border-top-0" scope="col">Categorie</th>
                            <th class="border-top-0" scope="col">Handeling</th>
                            <th class="border-top-0" scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log) {{-- Loop trough the application logs --}}
                            <tr>
                                <td class="font-weight-bold">
                                    <a href="{{ route('users.show', $log->causer) }}" class="text-secondary text-decoration-none">
                                        {{ ucfirst($log->causer->name) ?? 'Verwijderde gebruiker' }}
                                    </a>
                                </td>
                                <td>{{ ucfirst($log->log_name) }}</td>
                                <td>{{ ucfirst($log->description) }}</td>
                                <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty {{-- There are no logs found in the application --}}
                            <tr>
                                <td class="text-secondary" colspan="4">
                                    Er zijn nog geen applicatie logs van {{ config('app.name') }}
                                </td>
                            </tr>
                        @endforelse {{-- /// END application logs loop --}}
                    </tbody>
                </table>
            </div>

            {{ $logs->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
