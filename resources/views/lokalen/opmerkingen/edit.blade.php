@extends ('layouts.app', ['title' => 'Wjzig opmerking'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Opmerking wijzigen van {{ ucfirst($opmerking->lokaal->naam) }} lokaal.</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.opmerkingen', $opmerking->lokaal) }}" class="btn btn-secondary btn-shadow">
                    <i class="fe fe-list mr-2"></i> Opmerkingen
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card border-0">
            @include ('lokalen._partials.navigation', ['lokaal' => $opmerking->lokaal])

            <form method="POST" action="{{ route('lokalen.opmerkingen.update', $opmerking) }}" class="card-body">
                <h6 class="border-bottom border-gray pb-1 mb-3">Lokaal notitie wijzigen</h6>

                @csrf {{-- Form field protection --}}
                @method('PATCH') {{-- HTTP method spoofing --}}
                @form($opmerking) {{-- Bind data to the form --}}
                @include('flash::message') {{-- Flash session view partial --}}

                @if ($errors->first('titel') || $errors->first('opmerking'))
                    <ul class="list-unstyled mb-0">
                        @if ($errors->has('titel'))
                            <li><i class="fe fe-x-circle mr-2">{{ $errors->first('titel') }}</i></li>
                        @endif

                        @if ($errors->has('opmerking'))
                            <li><i class="fe fe-x-circle mr-2">{{ $errors->first('opmerking') }}</i></li>
                        @endif
                    </ul>
                @endif

                <div class="form-row">
                    <div class="form-group col-7">
                        <label for="titel">Titel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titel', 'is-invalid')" @input('titel') placeholder="Titel van de opmerking">
                    </div>

                    <div class="form-group col-12">
                        <label for="title">Opmerking tekst <span class="text-danger">*</span></label>
                        <textarea class="form-control" @input('opmerking') data-hidden-buttons="cmdPreview cmdCode cmdImage cmdUrl" id="markdown" rows="10">{{ old('opmerking') ?? $opmerking->opmerking }}</textarea>
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group col-12 mb-0">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-save mr-2"></i> Aanpassen
                        </button>

                        <button type="reset" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-2"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
