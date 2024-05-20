@section('title','Edit Employee')
@extends('layouts_user.master')
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Add Employee
                            <a href="{{route('employee.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="theme-form" method="POST" action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                <label class="form-label">First Name<span class="txt-danger">*</span></label>
                                <input class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{$employee->fname}}" type="text" placeholder="Enter your first name">
                                @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" >Last Name<span class="txt-danger">*</span></label>
                                <input class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{$employee->lname}}"  type="text" placeholder="Enter your last name">
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

                                            <option {{$employee->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->nom_city}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <label class="form-label" >Phone number<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('phone') is-invalid @enderror" value="{{$employee->phone_number}}" name="phone"  type="text" placeholder="Enter your phone number">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <label class="form-label" >Salary<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('salary') is-invalid @enderror" value="{{$employee->salary}}" name="salary"  type="number" placeholder="Enter your salary number">
                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label class="form-label" >Zip Code<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('zip_code') is-invalid @enderror" value="{{$employee->zip_code}}" name="zip_code"  type="text" >
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
                                            <option {{$employee->gender == $gender ? 'selected' : ''}} value="{{$gender}}">{{$gender}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label" >Adress du cabinet<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('adresse') is-invalid @enderror" value="{{$employee->address}}" name="adresse"  type="text" >
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <label class="col-form-label">Picture</label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image" id="formFile" type="file">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img src="{{asset('images/employee/'.$employee->image)}}" style="width:100px; height: 100px;" alt="">

                                </div>
                                <div class="col-sm-12 mt-2">
                                <label class="form-label" >Email<span class="txt-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" value="{{$employee->email}}" readonly name="email"  type="email" placeholder="Enter your email">
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
                                    <input type="checkbox" class="mt-2" id="showPasswordCheckbox"> Show Password

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
    new MultiSelectTag('languages2')  // id
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var passwordInput = document.getElementById("passwordInput");
    var passwordInput2 = document.getElementById("passwordInput2");
    var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
            passwordInput2.prop('type', 'text');
        } else {
            passwordInput.type = "password";
            passwordInput2.type = "password";
        }
    });
});

</script>
@endsection
