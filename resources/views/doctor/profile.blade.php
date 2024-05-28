@section('title','Profil')
@extends('layouts_user.master')
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section('content')
    <div class="container-fluid calendar-basic">
        @if (Session::has('success'))
            @include('alert.success')
        @endif
        <div class="card">
            <div class="card-header border-0">
                <h4>
                    <i class="icon-user"></i>&nbsp;Profil
                </h4>
            </div>
            <div class="card-body">
                <form class="theme-form formprofile" method="post" action="" enctype="multipart/form-data">
                    @csrf
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
                        <div class="col-6 select-box-city mt-2">
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
                        <div class="col-sm-6 mt-2">
                            <label class="form-label" >Phone number<span class="txt-danger">*</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" value="{{$doctor->phone_number}}" name="phone"  type="text" placeholder="Enter your phone number">
                            @error('phone')
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
                        <div class="col-md-4 mt-2">
                            <label class="form-label">Average price consultation</label>
                            <input class="form-control @error('tarif_consult') is-invalid @enderror" name="tarif_consult" value="{{$parametres->tarif_consult}}" type="text" placeholder="Average price consultation rate">
                            @error('tarif_consult')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
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
                            <div id="speciality-feedback" class="text-danger"></div>
                        </div>


                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="validationTooltip04">Motif<span class="text-danger">*</span></label>
                            <select name="motifs[]" multiple class="form-select" id="motifs">
                                <!-- Options will be dynamically populated based on the selected specialities -->
                            </select>

                    </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Presentation of the work place</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" id=""  rows="3">{{$parametres->bio}}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Experience and Diplome</label>
                            <textarea class="form-control @error('experience_diplome') is-invalid @enderror" name="experience_diplome" id=""  rows="3">{{$parametres->experience}}</textarea>
                            @error('experience_diplome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 mt-2">
                            <label class="col-form-label">Head</label>
                            <input class="form-control @error('head') is-invalid @enderror" name="head" id="formFile" type="file">
                            @error('head')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img src="{{asset('images/head/'.$parametres->entete)}}" style="width:100px; height: 100px;" alt="">

                        </div>
                        <div class="col-sm-6 mt-2">
                            <label class="col-form-label">picture of the doctor</label>
                            <input class="form-control @error('image') is-invalid @enderror" name="image" id="formFile" type="file">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img src="{{asset('images/doctor/'.$doctor->image)}}" style="width:100px; height: 100px;" alt="">
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="col-form-label">Pictures of the office work</label>
                                <input class="form-control @error('pictures') is-invalid @enderror" name="pictures[]" id="formFile" type="file" multiple>
                                @error('pictures')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if(!$pictures->isEmpty())
                            <div class="col-md-12 mt-3 d-flex">
                                @foreach ($pictures as $pic)
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center m-0">
                                            <img src="{{asset($pic->picture)}}" class="border" style="width:100px; height: 100px;" alt="">

                                        </div>
                                        <div class="col-md-12 d-flex justify-content-center">

                                            <a href="{{route('office-work.delete',$pic->id)}}" class=" text-danger ml-5">Delete</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="col-sm-12 mt-2">
                            <label class="form-label" >Email<span class="txt-danger">*</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" readonly value="{{$doctor->email}}" readonly name="email"  type="email" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        // new MultiSelectTag('speciality')  // id
        new MultiSelectTag('languages')  // id
        // new MultiSelectTag('motifs')  // id
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.select-box-city select').selectpicker();
        })
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

        $('.formprofile').on('submit', function(e) {
            e.preventDefault();


            var formData = new FormData(this);
            $.ajax({
                method: "POST",
                url: "{{ route('cabinet.store') }}", // Change the route to doctor/profile
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.hasOwnProperty('danger')) {
                        let errorMessages = "";
                        if (response.danger.fname) {
                            errorMessages += response.danger.fname.join(", ") + "\n";
                        }
                        if (response.danger.lname) {
                            errorMessages += response.danger.lname.join(", ") + "\n";
                        }
                        if (response.danger.phone) {
                            errorMessages += response.danger.phone.join(", ") + "\n";
                        }
                        if (response.danger.adresse) {
                            errorMessages += response.danger.adresse.join(", ") + "\n";
                        }
                        if (response.danger.zip_code) {
                            errorMessages += response.danger.zip_code.join(", ") + "\n";
                        }
                        if (response.danger.motifs) {
                            errorMessages += response.danger.motifs.join(", ") + "\n";
                        }
                        if (response.danger.specialities) {
                            errorMessages += response.danger.specialities.join(", ") + "\n";
                        }
                        if (response.danger.bio) {
                            errorMessages += response.danger.bio.join(", ") + "\n";
                        }
                        if (response.danger.languages) {
                            errorMessages += response.danger.languages.join(", ") + "\n";
                        }

                        // console.log(response)
                        swal("Error!",errorMessages.trim(), "error");
                    } else if (response.hasOwnProperty('success')) {
                        // If response has 'success' key, show success message
                        swal("Success!", JSON.stringify(response.success), "success");
                        setTimeout(function() {
                            // Reload the page
                            window.location.reload();
                        }, 2000);
                    } else {
                        // If response has neither 'danger' nor 'success' key, show a generic error message
                        swal("Error!", "An unexpected error occurred.", "error");
                    }

                }
            });
        });

    </script>

@endsection
