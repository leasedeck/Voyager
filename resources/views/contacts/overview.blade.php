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
                        <a class="dropdown-item" href="#">Alle contacten</a>
                    </div>
                </div>

                <form method="GET" action="" class="border-0 shadow-sm form-search ml-2">
                    <input type="text" name="term" value="" placeholder="Zoeken" class="form-search border-0 form-control">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @if ($contacts->total() === 0) 
            <div class="blankslate bg-white shadow-sm">
                <h3 class="text-brown">Geen contacten gevonden!</h3>
                <p class="pt-2">
                    Het lijkt erop dat er geen contact personen zijn toegevoegd in de applicatie. Of er geen personen gevonden in je zoekopdracht of filter optie.
                </p>

                <a href="{{ route('contacts.create') }}" class="btn border-0 mt-2 btn-secondary">
                    <i class="fe fe-plus mr-2"></i> Contact toevoegen
                </a>
            </div>
        @else
        @endif
    </div>
@endsection