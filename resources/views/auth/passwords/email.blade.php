{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.bodyAuth')
@section('body')
  <div class="row">
          <div class="col-12">
            <div class="login-card login-dark">
              <div>
                <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                <div class="login-main">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="theme-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="validationTooltip04"> {{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                            <input id="checkbox1" type="checkbox">
                            <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                            </div>
                            <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Send Password Reset Link') }}</button>
                        </div>

                        <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2" href="{{route('login')}}">Sign in</a></p>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
