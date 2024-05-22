@section('title','Edit Doctor')
@extends('layouts.master')
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Doctor Management</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('admin.dash')}}"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('doctor.index')}}">Doctors</a></li>
        <li class="breadcrumb-item f-w-400 active">edit</li>
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
                            edit Doctor
                            <a href="{{route('doctor.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="theme-form" method="POST" action="{{route('doctor.update',$doctor->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                <label class="form-label">First Name<span class="txt-danger">*</span></label>
                                <input class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{$doctor->fname}}" type="text" placeholder="Enter your first name">
                                @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" >Last Name<span class="txt-danger">*</span></label>
                                <input class="form-control @error('lname') is-invalid @enderror"  value="{{$doctor->lname}}" name="lname" value="{{old("lname")}}"  type="text" placeholder="Enter your last name">
                                @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 select-box-city mt-2">
                                    <label class="form-label" for="validationTooltip04">City <span class="text-danger">*</span></label>
                                    <select data-live-search="true"   class="form-select @error('city_id') is-invalid @enderror" name="city_id">
                                        <option selected disabled>Choose...</option>
                                        @foreach(App\Models\City::all() as $city)

                                            <option {{$doctor->city_id === $city->id ? 'selected' :''}} value="{{$city->id}}">{{$city->nom_city}}</option>
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
                                <input class="form-control @error('phone') is-invalid @enderror" value="{{$doctor->phone_number}}" name="phone"  type="text" placeholder="Enter your phone number">
                                @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label" for="validationTooltip04">Gender <span class="text-danger">*</span></label>
                                    <select class="form-select  @error('gender') is-invalid @enderror" name="gender">
                                        <option selected disabled>Choose...</option>
                                        <option  {{$doctor->gender ==="man" ? 'selected' :''}} value="man">Man</option>
                                        <option {{$doctor->gender ==="women" ? 'selected' :''}} value="women">Women </option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-8 mt-2">
                                    <label class="form-label" >Adress du cabinet<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('adresse') is-invalid @enderror" value="{{$doctor->address}}" name="adresse"  type="text" >
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label" >Zip Code<span class="txt-danger">*</span></label>
                                    <input class="form-control @error('zip_code') is-invalid @enderror" value="{{$doctor->zip_code}}" name="zip_code"  type="text" >
                                    @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label class="form-label" for="validationTooltip04">languages speak<span class="text-danger">*</span></label>
                                    <select data-live-search="true" name="languages[]" multiple class="form-select @error('languages') is-invalid @enderror" id="languages">
                                        <option disabled>Choose...</option>
                                        @foreach (['anglais', 'arabe', 'espagnol', 'francais'] as $language)
                                            <option {{ in_array($language, $selectedlanguages) ? 'selected' : '' }} value="{{ $language }}">{{ ucfirst($language) }}</option>
                                        @endforeach
                                    </select>

                                    @error('languages')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label class="form-label" for="validationTooltip04">Specialities <span class="text-danger">*</span></label>
                                    <select data-live-search="true" name="specialities[]" multiple class="form-select @error('specialities') is-invalid @enderror" id="speciality">
                                        <option disabled>Choose...</option>
                                        @foreach($specialities as $speciality)
                                            <option {{ in_array($speciality->id, $selectedSpecialities) ? 'selected' : '' }} value="{{ $speciality->id }}">{{ $speciality->name_sp }}</option>
                                        @endforeach
                                    </select>

                                    @error('specialities')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label" for="validationTooltip04">Motif<span class="text-danger">*</span></label>
                                    <select name="motifs[]" multiple class="form-select @error('motifs') is-invalid @enderror" id="motifs">
                                        <!-- Options will be dynamically populated based on the selected specialities -->
                                    </select>
                                    @error('motifs')
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
                                </div>
                                <div class="col-sm-12 mt-2">
                                <label class="form-label" >Email<span class="txt-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" value="{{$doctor->email}}" readonly name="email"  type="email" placeholder="Enter your email">
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
    //new MultiSelectTag('speciality')  // id
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

    function handleSpecialitySelection() {
            var selectedSpecialities = $('#speciality').val();

            // Hide all motifs initially
            $('#motifs').empty();

            // Show motifs associated with selected specialities
            $.each(selectedSpecialities, function(index, specialityId){
                var specialityName = $('#speciality option[value="' + specialityId + '"]').text();
                $('#motifs').append('<optgroup label="' + specialityName + '"></optgroup>');

                // Filter motifs for the selected speciality and populate the dropdown
                   @foreach($motifs as $motif)
                        if({{ $motif->speciality_id }} == specialityId) {
                            @if(empty($selectedmotifs) || is_null($selectedmotifs))
                                $('#motifs optgroup[label="' + specialityName + '"]').append('<option value="{{ $motif->id }}">{{ $motif->nom_motif }}</option>');
                            @else
                                $('#motifs optgroup[label="' + specialityName + '"]').append('<option {{in_array( $motif->id ,$selectedmotifs) ? "selected" :"" }} value="{{ $motif->id }}">{{ $motif->nom_motif }}</option>');
                            @endif
                        }
                    @endforeach
            });
        }

        // Trigger the speciality selection handler on page load
        handleSpecialitySelection();

        // Attach the speciality selection handler to the change event
        $('#speciality').change(handleSpecialitySelection);

</script>
@endsection
