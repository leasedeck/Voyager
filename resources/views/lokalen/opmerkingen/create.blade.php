@extends('layouts.app', ['title' => 'Lokaal opmerkingen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Lokalen</h1>
            <div class="page-subtitle">Opmerking toevoegen omtrent {{ ucfirst($lokaal->naam) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card oborder-0">
            @include ('lokalen._partials.navigation', ['lokaal' => $lokaal])

            <form method="POST" action="{{ route('lokalen.opmerkingen.store', $lokaal) }}" class="card-body">
                <h6 class="border-bottom border-gray pb-1 mb-3">Opmerking toevoegen</strong></h6>
                @csrf {{-- Form field protection --}}

                <div class="form-row">
                    <div class="form-group col-7">
                        <label for="title">Titel <span class="text-danger">*</span></label>
                        <input type="text" id="title" class="form-control @error('title', 'is-invalid')" placeholder="Titel van uw opmerking" @input('titel')>
                        @error('titel')
                    </div>

                    <div class="form-group col-12">
                        <label for="title">Opmerking tekst <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('opmerking', 'is-invalid')" @input('opmerking') data-hidden-buttons="cmdPreview cmdCode cmdImage cmdUrl" id="markdown" rows="10">{{ old('opmerking') }}</textarea>
                        @error('opmerking')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group col-12 mb-0">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-plus mr-2"></i> Opslaan
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