@section('title','Create patients')
@extends('layouts_user.master')
@section('content')
<div class="container-fluid calendar-basic">
    <div class="card">
        <div class="card-header border-0">
            <h4>
                <i class="icon-user"></i>&nbsp;Create new Patient
                <a href="{{route('mypatient.index')}}" class="float-end"><i class="icon-arrow-circle-left"></i>&nbsp;&nbsp;Go back</a>
            </h4>
        </div>
        <div class="card-body">
            <form class="theme-form" method="POST" id="cityForm" action="{{route('mypatient.store')}}">
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
                    <div class="col-4 select-box-city mt-2">
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
                    <div class="col-md-4 mt-2">
                        <label class="form-label" for="validationTooltip04">Gender <span class="text-danger">*</span></label>
                        <select class="form-select  @error('gender') is-invalid @enderror" name="gender">
                            <option selected disabled>Choose...</option>
                            @foreach (['man','women'] as $gender)
                                <option value="{{$gender}}">{{$gender}}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2">
                        <label class="form-label" for="validationTooltip04">Date of birth day <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('datenaiss') is-invalid @enderror" value="{{old("datenaiss")}}" name="datenaiss" id="">
                        @error('datenaiss')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="col-md-8 mt-2">
                        <label class="form-label" >adresse<span class="txt-danger">*</span></label>
                        <input class="form-control @error('adresse') is-invalid @enderror" value="{{old("adresse")}}" name="adresse"  type="text" >
                        @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2">
                        <label class="form-label" >Zip Code<span class="txt-danger">*</span></label>
                        <input class="form-control @error('zip_code') is-invalid @enderror" value="{{old("zip_code")}}" name="zip_code"  type="text" >
                        @error('zip_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="col-sm-6 mt-2">
                        <label class="form-label" >Email<span class="txt-danger">*</span></label>
                        <input class="form-control @error('email') is-invalid @enderror" value="{{old("email")}}" name="email"  type="email" placeholder="Enter your email">
                        @error('email')
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
                    {{-- <div class="col-md-12 mt-2">
                        <label class="col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="form-input position-relative">
                            <input placeholder="password" id="passwordInput"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <input type="checkbox" class="mt-2" id="showPasswordCheckbox"> Show Password
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label class="col-form-label">Confirmer Password <span class="text-danger">*</span></label>
                        <div class="form-input position-relative">
                                <input id="password-confirm" id="passwordInput2"  type="password" placeholder="Confirmer password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <input type="checkbox" class="mt-2" id="showPasswordCheckbox2"> Show Password

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <div class="show-hide"><span class="show"></span></div>
                        </div>
                    </div> --}}
                </div>
                <div class="form-group mb-0 mt-3">
                    <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/js/select2/tagify.js')}}"></script>
    <script src="{{asset('assets/js/select2/tagify.polyfills.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/intltelinput.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/telephone-input.js')}}"> </script>
    <script src="{{asset('assets/js/select2/custom-inputsearch.js')}}"></script>
    <script src="{{asset('assets/js/select2/select3-custom.js')}}"></script>

@endsection

