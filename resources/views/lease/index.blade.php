@extends ('layouts.app', ['title' => 'Verhuringen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Verhuringen</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="http://localhost:8000/contacten/nieuw" role="button" id="dropdownCreateLink" class="btn btn-secondary mr-2">
                    <i class="fe fe-plus"></i>
                </a>
                <div class="dropdown">
                    <a href="http://localhost" role="button" id="dropdownFilterLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">
                        <i class="fe fe-filter mr-2"></i>Filter
                    </a>
                    <div aria-labelledby="dropdownFilterLink" class="dropdown-menu">
                        <a href="{{ route('leases.overview') }}" class="dropdown-item">Alle verhuringen</a>
                    </div>
                </div>
                <form method="GET" action="" class="form-inline border-0 shadow-sm form-search ml-2">
                    <div class="form-group has-search"><span class="fe fe-search form-control-feedback"></span>
                        <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0 table-sm">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Periode</th>
                            <th class="border-top-0" scope="col">Status</th>
                            <th class="border-top-0" scope="col">Opgevolgd door</th>
                            <th class="border-top-0" scope="col">Huurder</th>
                            <th class="border-top-0" scope="col">Aantal personen</th>
                            <th class="border-top-0" scope="col">Aangevraagd op</th>
                            <th class="border-top-0" scoep="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leases as $lease) {{-- Loop trough the leases --}}
                            <tr>
                                <td class="font-weight-bold">
                                    {{ $lease->periode }} <span class="small ml-1 text-muted">({{ $lease->start_datum->diffInDays($lease->eind_datum) }} dagen)</span>
                                </td>
                                <td>
                                     <span class="badge badge-{{ strtolower($lease->klasse->name) }}">
                                         {{ $lease->klasse->name }}
                                     </span>
                                </td>

                                <td>{{ $lease->verantwoordelijke->naam ?? 'Onbekend' }}</td>
                                <td>{{ $lease->huurder->naam }}</td>
                                <td>{{ $lease->aantal_personen }} Personen</td>
                                <td>{{ $lease->created_at->diffForhumans() }}</td>

                                <td> {{-- Options --}}
                                    <span class="float-right">
                                        <a href="" class="text-decoration-none text-secondary mr-2">
                                            <i class="fe fe-user"></i>
                                        </a>

                                        <a href="" class="text-decoration-none text-secondary mr-1">
                                            <i class="fe fe-eye"></i>
                                        </a>
                                        <a href="" class="text-danger text-decoration-none">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// Options --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">
                                    <i class="fe fe-info mr-1"></i> Er zijn momenteel geen verhuringen toegevoegd of gevonden in de matchende criteria
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $leases->links() }} {{-- Pagination view instances --}}
        </div>
    </div>
@endsection
