@section('title','Edit Patient')
@extends('layouts.master')
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Patient manager</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('admin.dash')}}"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('patient.index')}}">Patients</a></li>
        <li class="breadcrumb-item f-w-400 active">Edit</li>
    </ol>
    </nav>
</div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Patient
                            <a href="{{route('patient.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="theme-form" method="POST" action="{{route('patient.update',$patient->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">First Name<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{$patient->fname}}" type="text" placeholder="Enter your first name">
                                    @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" >Last Name<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{$patient->lname}}"  type="text" placeholder="Enter your last name">
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

                                            <option {{$patient->city_id === $city->id ? 'selected' :''}} value="{{$city->id}}">{{$city->nom_city}}</option>
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
                                    <input class="form-control @error('phone') is-invalid @enderror" value="{{$patient->phone_number}}" name="phone"  type="text" placeholder="Enter your phone number">
                                    @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>


                                <div class="col-md-8 mt-2">
                                    <label class="form-label" >Adress<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('adress') is-invalid @enderror" value="{{$patient->adress}}" name="adress"  type="text" >
                                    @error('adress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label" >Zip Code<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('zip_code') is-invalid @enderror" value="{{$patient->zip_code}}" name="zip_code"  type="text" >
                                    @error('zip_code')
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
                                            <option {{$gender === $patient->gender ? 'selected' : ''}} value="{{$gender}}">{{$gender}}</option>
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
                                    <input type="date" class="form-control @error('datenaiss') is-invalid @enderror" value="{{$patient->date_naissance}}" name="datenaiss" id="">
                                    @error('datenaiss')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">picture</label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image" id="formFile" type="file">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <label class="form-label" >Email<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('email') is-invalid @enderror" readonly value="{{$patient->email}}" name="email"  type="email" placeholder="Enter your email">
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
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
                                            {{-- <input type="checkbox" class="mt-2" id="showPasswordCheckbox2"> Show Password --}}

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    {{-- <div class="show-hide"><span class="show"></span></div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('speciality')  // id
    new MultiSelectTag('languages')  // id
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var passwordInput = document.getElementById("passwordInput");
    var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
});

</script>
@endsection
