@section('title','dashboard')
@extends('layouts_user.master')
@section('content')
    <div class="container-fluid calendar-basic">
        @if (Session::has('success'))
            @include('alert.success')
        @endif
        <div class="card">
            <div class="card-header border-0">
                <h4>
                    <i class="icon-user"></i>&nbsp;Personnel Information
                </h4>
            </div>
            <div class="card-body">
                <form class="theme-form formprofile" method="post" action="{{route('client.update',$patient->id)}}" enctype="multipart/form-data">
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
                            <input class="form-control @error('lname') is-invalid @enderror"  value="{{$patient->lname}}" name="lname" value="{{old("lname")}}"  type="text" placeholder="Enter your last name">
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 select-box-city mt-2">
                            <label class="form-label" for="validationTooltip04">City <span class="text-danger">*</span></label>
                            <select data-live-search="true"   class="form-select @error('city_id') is-invalid @enderror" name="city_id">
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
                        <div class="col-md-4 mt-2">
                            <label class="form-label" >Adresse</label>
                            <input class="form-control @error('adresse') is-invalid @enderror" value="{{$patient->address ?? ''}}" name="adresse"  type="text" >
                            @error('adresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2">
                            <label class="form-label" >Zip Code</label>
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
                                <option  {{$patient->gender ==="man" ? 'selected' :''}} value="man">Man</option>
                                <option {{$patient->gender ==="women" ? 'selected' :''}} value="women">Women </option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="col-form-label">picture</label>
                            <input class="form-control @error('image') is-invalid @enderror" name="image" id="formFile" type="file">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img src="{{asset('images/doctor/'.$patient->image)}}" style="width:100px; height: 100px;" alt="">
                        </div>

                        <div class="col-sm-12 mt-2">
                            <label class="form-label" >Email<span class="txt-danger">*</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" readonly value="{{$patient->email}}" readonly name="email"  type="email" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
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
                                <div class="col-md-6 mt-2">
                                    <label class="col-form-label">Confirmer Password <span class="text-danger">*</span></label>
                                    <div class="form-input position-relative">
                                            <input id="password-confirm" id="passwordInput2"  type="password" placeholder="Confirmer password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                            {{-- <input type="checkbox" class="mt-2" id="showPasswordCheckbox2"> Show Password --}}

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                    </div>
                    <div class="form-group mb-0 mt-3">
                        <input type="submit" class="btn btn-primary btn-block w-100" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
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
