@extends('layouts.bodyAuth')
@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section('body')

<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card login-dark">
        <div>
            <div><a class="logo" href="{{route('homepage')}}"><img class="img-fluid for-light w-25" src="{{asset("images/logo/landing_page.png")}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset("assets/images/logo/logo_dark.png")}}" alt="looginpage"></a></div>
            <div class="login-main" style="width: 600px">
             <form class="theme-form" method="POST" action="{{route('register.store')}}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                      <label class="form-label">First Name<span class="txt-danger">*</span></label>
                      <input class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{old("fname")}}" type="text" placeholder="Enter your first name">
                      @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" >Last Name<span class="txt-danger">*</span></label>
                      <input class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{old("lname")}}"  type="text" placeholder="Enter your last name">
                      @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 select-box-city mt-2">
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
                    <div class="col-sm-6 mt-2">
                      <label class="form-label" >Phone number<span class="txt-danger">*</span></label>
                      <input class="form-control @error('phone') is-invalid @enderror" value="{{old("phone")}}" name="phone"  type="text" placeholder="Enter your phone number">
                      @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="validationTooltip04">Specialities <span class="text-danger">*</span></label>
                        <select data-live-search="true" name="specialities[]" multiple class="form-select @error('specialities') is-invalid @enderror" id="speciality" >
                            <option disabled>Choose...</option>
                            @foreach($specialities as $speciality)
                                <option value="{{$speciality->id}}">{{$speciality->name_sp}}</option>
                            @endforeach
                        </select>
                        @error('specialities')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="speciality-feedback" class="text-danger"></div>

                    </div>



                    <div class="col-md-6 mt-2">
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
                    <div class="col-sm-12 mt-2">
                      <label class="form-label" >Email<span class="txt-danger">*</span></label>
                      <input class="form-control @error('email') is-invalid @enderror" value="{{old("email")}}" name="email"  type="email" placeholder="Enter your email">
                      @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="form-input position-relative">
                            <input placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <div class="show-hide"><span class="show"></span></div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
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
                </div>
                <div class="form-group mb-0">

                    <button class="btn btn-primary btn-block w-100 mt-4 " type="submit">Create Account</button>
                </div>
                {{-- <h6 class="text-muted mt-4 or">Or signup with</h6>
                <div class="social mt-4 ">
                    <div class="btn-showcase "><a class="btn btn-light btn-block w-100" href="https://www.linkedin.com/login" target="_blank"><i class="icon-google"></i> Google </a></div>
                </div> --}}
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
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var specialitySelect = document.getElementById("speciality");
        var specialityFeedback = document.getElementById("speciality-feedback");

        specialitySelect.addEventListener("change", function() {
            var selectedOptions = specialitySelect.selectedOptions;
            if (selectedOptions.length > 4) {
                specialityFeedback.textContent = "You can select up to 4 specialities.";
                // Disable selection of additional options
                for (var i = 0; i < specialitySelect.options.length; i++) {
                    if (!selectedOptions.includes(specialitySelect.options[i])) {
                        specialitySelect.options[i].disabled = true;
                    }
                }
            } else {
                specialityFeedback.textContent = "";
                // Enable all options
                for (var i = 0; i < specialitySelect.options.length; i++) {
                    specialitySelect.options[i].disabled = false;
                }
            }
        });
    });
</script> --}}

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('speciality')  // id
    new MultiSelectTag('languages')  // id
</script>
    <script>
            $(document).ready(function(){
                $('.select-box-city select').selectpicker();

            })
        </script>
@endsection
