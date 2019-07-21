@extends ('layouts.app', ['title' => 'Contacten'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Contacten</h1>
            <div class="page-subtitle">Contactpersoon toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                    <i class="fe fe-book-open mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form method="POST" action="" class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">Contactpersoon toevoegen</strong></h6>

            <div class="row mt-2">
                <div class="col-3">
                    <h5>Algemene informatie </h5>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-3">
                    <h5>Adres gegevens</h5>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label for="type">Adres type</label>
                            
                            <select class="custom-select" @input('type') id="type" @input('type')>
                                @options($addressTypes, 'type')
                            </select>
                        </div>

                        <div class="form-group col-7">
                            <label for="street">Straatnaam</label>
                            <input type="text" id="street" class="form-control" @input('street') placeholder="Straatnaam">
                        </div>

                        <div class="form-group- col-3">
                            <label for="number">Huis nummer</label>
                            <input type="text" id="number" class="form-control" @input('number') placeholder="Huisnummer">
                        </div>
                        
                        <div class="form-group col-4">
                            <label for="postal">Postcode</label>
                            <input type="text" id="postal" class="form-control" @input('postal') placeholder="Postcode">
                        </div>

                        <div class="form-group col-4">
                            <label for="city">Stad</label>
                            <input type="text" id="city" class="form-control" @input('city') placeholder="Stad">
                        </div>

                        <div class="form-group col-4">
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group mb-0 col-12">
                    <div class="float-right">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fe fe-user-plus mr-2"></i> Toevoegen
                        </button>

                        <button type="reset" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection