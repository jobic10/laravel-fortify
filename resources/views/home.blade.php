@extends('template')
@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <p class="alert alert-success">Welcome {{ auth()->user()->name }}</p>
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
                        <hr>
                        <br>
                        @if (auth()->user()->role_id ==1)
                            <a href="{{ route('admin.users.index') }}"></a>
                        @elseif (auth()->user()->role_id == 2)
                        <a href="{{ route('student.lessons.index') }}"></a>
                        @elseif (auth()->user()->role_id == 3)
                        <a href="{{ route('staff.courses.index') }}"></a>
                        @else
                        Where are you from?
                        @endif
                        <br>
                        <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
