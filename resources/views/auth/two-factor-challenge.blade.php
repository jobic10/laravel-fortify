@extends('template')

@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="/img/login.jpg" alt="login" class="login-card-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="/img/logo.png" alt="logo" class="logo">
                        </div>
                        <p class="login-card-description">Please enter your authentication code to login</p>
                        <form method="POST" action="{{ url('/two-factor-challenge') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="code" class="sr-only">Code</label>
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" >
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                        </form>
                        <p>Ener your recovery code</p>
                        <form method="POST" action="{{ url('/two-factor-challenge') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="recovery_code" class="sr-only">Code</label>
                                <input id="recovery_code" type="text" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" >
                                @error('recovery_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
