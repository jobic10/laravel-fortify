@extends('template')
@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        @if (!auth()->user()->two_factor_secret)
                            <p class="alert alert-warning">You are yet to enable 2fa</p>
                            @else
                            <p class="alert alert-success">2fa is live on this account.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
