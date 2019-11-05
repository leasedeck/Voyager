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
@endsection
