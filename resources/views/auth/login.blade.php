{{-- @extends('layouts.app') --}}

@extends('layouts.bodyAuth')
{{-- @extends('layouts.head') --}}
@section('body')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                @if(session('danger'))
                    <div class="alert txt-white border-danger position-absolute top-0  bg-danger p-13 outline-2x alert-dismissible fade show alert-icons" style="margin: 12px; width: 30%;left: 2px;" role="alert"><i
                            data-feather="thumbs-up"></i>
                        <p><b> Well done! </b>{{session('danger')}}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('success'))
                    <div class="alert txt-white border-success position-absolute top-0  bg-success p-13 outline-2x alert-dismissible fade show alert-icons" style="margin: 12px; width: 30%;left: 2px;" role="alert"><i
                            data-feather="thumbs-up"></i>
                        <p><b> Well done! </b>{{session('success')}}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif

                <div>
                    <div><a class="logo" href="index.html"><img class="img-fluid for-light" style="width: 50%;" src="{{asset("images/logo/landing_page.png")}}" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form"  method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4>Login to account</h4>
                            <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">

                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>

                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Login') }}</button>
                                    </div>
                                </div>
                                @if (Route::has('register'))
                                    <p class="mt-4 mb-0 text-center">Don't have account?
                                        @if (Route::has('register'))
                                            <a class="ms-2" href="{{ route('register') }}">
                                                Create Patient account</a>
                                            <a class="ms-2"
                                                    href="{{ route('register.docotr') }}">Create Doctor account</a>
                                        @endif
                                    </p>
                                @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelector('.show-hide').addEventListener('click', function() {
            var passwordField = document.getElementById('password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
@endsection
