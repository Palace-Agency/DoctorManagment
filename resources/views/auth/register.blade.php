{{-- @extends('layouts.app') --}}

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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

<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card login-dark">
        <div>
            <div><a class="logo" href="index.html"><img class="img-fluid for-light w-25" src="{{asset("images/logo/landing_logo.png")}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset("assets/images/logo/logo_dark.png")}}" alt="looginpage"></a></div>
            <div class="login-main" style="width: 600px">
            <form class="theme-form" method="POST" action="{{ route('register') }}">
                @csrf
                <h4>Create your account</h4>
                <p>Enter your personal details to create account</p>
                <div class="form-group">
                    <label class="col-form-label pt-0">Your Name <span class="text-danger">*</span></label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" placeholder="First Name" name="fname" value="{{ old('fname') }}"  autocomplete="fname" autofocus>

                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input  type="text" placeholder="Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}"  autocomplete="lname" autofocus>

                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label" for="validationTooltip04">Gender <span class="text-danger">*</span></label>
                            <select class="form-select  @error('gender') is-invalid @enderror" name="gender">
                                <option selected disabled>Choose...</option>
                                <option value="man">Man</option>
                                <option value="women">Women </option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 select-box-city">
                            <label class="form-label" for="validationTooltip04">City <span class="text-danger">*</span></label>
                            <select data-live-search="true" class="form-select @error('city_id') is-invalid @enderror" name="city_id">
                                <option selected disabled>Choose...</option>
                                @foreach(App\Models\City::all() as $city)

                                    <option value="{{$city->id}}">{{$city->nom_city}}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label" for="cleave-date1">Date de naissance <span class="text-danger">*</span></label>
                            <input class="form-control @error('datenaiss') is-invalid @enderror" id="cleave-date1" name="datenaiss" type="date" placeholder="DD-MM-YYYY">
                            @error('datenaiss')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="validationTooltip04"> Phone number <span class="text-danger">*</span></label>
                            <input  type="tel" placeholder="Phone number" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}"  autocomplete="tel">

                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Email Address <span class="text-danger">*</span></label>
                    <input id="email" placeholder="test@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-form-label">Password <span class="text-danger">*</span></label>
                    <div class="form-input position-relative">
                        <input placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <div class="show-hide"><span class="show"></span></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Confirmer Password <span class="text-danger">*</span></label>
                    <div class="form-input position-relative">
                            <input id="password-confirm" type="password" placeholder="Confirmer password" class="form-control" name="password_confirmation" autocomplete="new-password">

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <div class="show-hide"><span class="show"></span></div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="checkbox p-0">
                    <input id="checkbox1" type="checkbox">
                    <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                </div>
                <h6 class="text-muted mt-4 or">Or signup with</h6>
                <div class="social mt-4 ">
                    <div class="btn-showcase "><a class="btn btn-light btn-block w-100" href="https://www.linkedin.com/login" target="_blank"><i class="icon-google"></i> Google </a></div>
                </div>
                @if (Route::has('login'))
                    <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
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
        $(document).ready(function(){
            $('.select-box-city select').selectpicker();

        })
    </script>
@endsection
