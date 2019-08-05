@extends('layouts.app', ['title' => 'Huurders'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Huurders</h1>
            <div class="page-subtitle">Algemene informatie omtrent {{ ucfirst($huurder->naam) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('tenants.overview') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-users mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- side navigation --}}
                @include ('tenants._partials.sidenav', ['tenant' => $huurder])
            </div> {{-- /// END side navigation --}}

            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">Algemene informatie omtrent <span class="font-weight-bold">{{ ucfirst($huurder->naam) }}</span></h6>
                    @csrf            {{-- Form field protection --}}
                    @method('PATCH') {{-- HTTP method spoofing --}}
                    @form($huurder)  {{-- Bind data to the form--}}

                    <fieldset @if (! $canEdit) disabled @endif>
                        <div class="row mt-2">
                            <div class="col-3">
                                <h5>Algemene informatie</h5>
                            </div>
                            <div class="offset-1 col-8">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="name">Voornaam <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control @error('voornaam', 'is-invalid')" placeholder="Voornaam van de huurder" @input('voornaam')>
                                        @error('voornaam')
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="lastname">Achternaam <span class="text-danger">*</span></label>
                                        <input type="text" id="lastname" class="form-control @error('achternaam', 'is-invalid')" placeholder="Achternaam van de huurder" @input('achternaam')>
                                        @error('achternaam')
                                    </div>

                                    <div class="form-group col-7 mb-0">
                                        <label for="email">Email adres <span class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control @error('email', 'is-invalid')" placeholder="Email adres van de huurder" @input('email')>
                                        @error('email')
                                    </div>

                                    <div class="form-group col-5 mb-0">
                                        <label for="phoneNumb">Tel. nummer <span class="text-danger">*</span></label>
                                        <input type="text" id="telNumb" class="form-control" placeholder="Telefoon nr van de huurder" @input('telefoon_nummer')>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-3">
                                <h5>Adres gegevens</h5>
                            </div>

                            <div class="offset-1 col-8">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="straat">Straat + huis nr. <span class="text-danger">*</span></label>
                                        <input type="text" id="straat" class="form-control @error('adres', 'is-invalid')" placeholder="Straatnaam + huisnummer" @input('adres')>
                                        @error("adres")
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="postcode">Postcode <span class="text-danger">*</span></label>
                                        <input type="text" id="postcode" class="form-control @error('postcode', 'is-invalid')" placeholder="Postcode" @input('postcode')>
                                        @error('postcode')
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="stad">Stad <span class="text-danger">*</span></label>
                                        <input type="text" id="stad" class="form-control @error('stad', 'is-invalid')" placeholder="Stad" @input('stad')>
                                        @error('stad')
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="land">Land <span class="text-danger">*</span></label>

                                        <select class="custom-select @error('land_id', 'is-invalid')" @input('land_id')>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if ($country->id == $huurder->land_id || old('land_id') == $country->id) selected @endif>
                                                    {{ ucfirst($country->name) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('land_id') {{-- Validation error view partial --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group mb-0 col-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fe fe-plus mr-2"></i> Toevoegen
                                    </button>

                                    <button type="reset" class="btn btn-light">
                                        <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
