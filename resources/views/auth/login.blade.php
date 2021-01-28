@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @extends('layouts.app')

                    @section('content')
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1>Login</h1>
                            <div>
                                <input id="email" type="email" placeholder="Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">


                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <p>AMGROUP © {{date('Y')}}</p>
                                </div>
                            </div>
                        </form>
                    @endsection
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
