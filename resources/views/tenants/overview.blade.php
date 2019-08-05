@extends('layouts.app', ['title' => 'Huurders'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.create') }}" class="btn shadow-sm btn-secondary">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @if ($tenants->total() === 0)
            <div class="blankslate bg-white shadow-sm">
                <h3 class="text-brown">Geen huurders gevonden!</h3>
                <p class="pt-2">
                    Het lijkt erop dat er geen huurders zijn toegevoegd in {{ config('app.name') }}. Of er geen huurders gevonden zijn matchend met je zoekopdracht.
                </p>

                <a href="{{ route('tenants.create') }}" class="btn border-0 mt-2 btn-secondary">
                    <i class="fe fe-plus mr-2"></i> Huurder toevoegen
                </a>
            </div>
        @else
            <div class="card card-body border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="border-top-0">Naam</th>
                                <th scope="col" class="border-top-0">Email adres</th>
                                <th scope="col" class="border-top-0">Telefoon nummer</th>
                                <th scope="col" class="border-top-0">Aantal verhuringen</th>
                                <th scope="col" class="border-top-0">&nbsp;</th> {{-- Column only dedicated for the functions --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant) {{-- Loop door de tenants --}}
                                <tr>
                                    <td class="font-weight-bold">{{ $tenant->naam }}</td>
                                    <td><a class="text-decoration-none text-muted" href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></td>
                                    <td>{{ $tenant->telefoon_nummer }}</td>
                                    <td>{{ $tenant->verhuringen_count }} verhuringen</td>

                                    <td> {{-- Options --}}
                                        <span class="float-right">
                                            <a href="{{ route('tenants.show', $tenant) }}" class="text-decoration-none text-muted">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            @if ($currentUser->can('delete', $tenant))
                                                <a href="" class="text-danger text-danger ml-1">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            @endif
                                        </span>
                                    </td> {{-- /// END tenant options --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $tenants->links()  }} {{-- Pagination view insance --}}
            </div>
        @endif
    </div>
@endsection
