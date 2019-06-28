@extends('layouts.auth')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand tw-shadow">
                        <img src="{{ asset('img/logo.png') }}">
                    </div>
                    <div class="card fat">
                        <div class="card-body tw-shadow">
                            <h4 class="card-title">2FA verificatie code</h4>
                            <form method="POST" action="{{ route('2faVerify') }}">
                                @csrf {{-- Form field protection --}}

                                <div class="form-group">
                                    <label for="otp" class="sr-only">Verificatie code</label>

                                    <input id="otp" type="password" class="form-control {{ $errors->has('one_time_password-code') ? ' is-invalid' : '' }}" name="one_time_password" value="" required autofocus>

                                    @if ($errors->has('one_time_password-code'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('one_time_password-code') }}</strong>
                                        </span>
                                    @else
                                        <small id="otp" class="form-text text-muted pt-2">
                                            Gebruik de code van je Google Authenticator app om je identiteit te verifieren.
                                        </small>
                                    @endif
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection