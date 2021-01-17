@extends('template')
@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        @if (!auth()->user()->two_factor_secret)
                            <p class="alert alert-warning">You are yet to enable 2fa</p>
                            <form action="{{ url('user/two-factor-authentication') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Enable
                            </button>
                            </form>
                            @else
                            <p class="alert alert-success">2fa is live on this account.</p>
                            @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="alert alert-success" role='alert'>
                                You have now enabled 2fa, please scan the following QR code into your phones authenticator application
                                <hr>
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}

                                <hr>
                                <p>Please store these recovery codes in a secure location</p>
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                                {{ trim($code) }}<br>
                                @endforeach
                            </div>
                        @endif
                            <form action="{{ url('user/two-factor-authentication') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">
                                    Disable
                                </button>
                                </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
