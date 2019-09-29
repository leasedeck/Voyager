@extends ('layouts.app', ['title' => 'Contacten'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Contacten</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                @if ($contacts->total() > 0)
                    <div class="dropdown">
                        <a class="btn btn-secondary mr-2" href="{{ config('app.url') }}" role="button" id="dropdownCreateLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe fe-plus"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownCreateLink">
                            <a class="dropdown-item" href="{{ route('contacts.create') }}">Nieuwe persoon</a>
                            <a class="dropdown-item" href="#">Nieuw adres</a>
                        </div>
                    </div>
                @else
                    <a class="btn btn-secondary mr-2" href="{{ route('contacts.create') }}" role="button" id="dropdownCreateLink">
                        <i class="fe fe-plus"></i>
                    </a>
                @endif

                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="{{ config('app.url') }}" role="button" id="dropdownFilterLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fe fe-filter mr-2"></i> Filter
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownFilterLink">
                        <a class="dropdown-item" href="{{ route('contacts.index') }}">Alle contacten</a>
                        <a class="dropdown-item" href="">Mijn contacten</a>
                        <a class="dropdown-item" href="">Verwijderde contacten</a>
                    </div>
                </div>

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
        @include('flash::message')

        @if ($contacts->total() === 0)
            <div class="blankslate bg-white shadow-sm">
                <h3 class="text-brown">Geen contacten gevonden!</h3>
                <p class="pt-2">
                    Het lijkt erop dat er geen contactpersonen zijn toegevoegd in {{ config('app.name') }}. Of er geen personen gevonden in je zoekopdracht of filter optie.
                </p>

                <a href="{{ route('contacts.create') }}" class="btn border-0 mt-2 btn-secondary">
                    <i class="fe fe-plus mr-2"></i> Contact toevoegen
                </a>
            </div>
        @else
            <div class="card card-body border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 table-hover">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Naam</th>
                                <th class="border-top-0" scope="col">Email adres</th>
                                <th class="border-top-0" scope="col">Organisatie/Bedrijf</th>
                                <th class="border-top-0" scope="col">Organisatie/Bedrijf functie</th>
                                <th class="border-top-0" scope="col">&nbsp;</th> {{-- Column only for the functions --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact) {{-- Loop trough the contacts --}}
                                <tr>
                                    <td class="font-weight-bold">{{ $contact->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                            {{ $contact->email }}
                                        </a>
                                    </td>

                                    <td>
                                        @if (! $contact->organidatie)
                                            <span class="font-italic">onbekend of n.v.t</i>
                                        @else
                                            {{ $contact->organisatie }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($contact->organisatie && ! $$contact->organisatie_functie)
                                            <span class="font-italic">Onbekend</span>
                                        @elseif (! $contact->organisatie)
                                            <span class="font-italic">n.v.t</span>
                                        @else
                                            {{ $contact->organisatie_functie }}
                                        @endif
                                    </td>

                                    <td> {{-- Options --}}
                                        <span class="float-right">
                                            <a href="" class="text-link text-decoration-none">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            @if ($currentUser->can('edit', $contact))
                                                <a href="" class="text-link ml-1 text-decoration-none">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                            @endif

                                            @if ($currentUser->can('delete', $contact))
                                                <a href="{{ route('contacts.delete', $contact) }}" data-method="delete" class="text-danger ml-1 text-decoration-none">
                                                    <i class="fe fe-trash-2"></i>
                                                </a>
                                            @endif
                                        </span>
                                    </td> {{-- /// END options --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $contacts->links() }} {{-- pagination view instance --}}
            </div>
        @endif
    </div>
@endsection
