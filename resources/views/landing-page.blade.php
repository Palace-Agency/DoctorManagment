@extends('layouts.bodyVisiteur')
@section('content')
@if (Session::has('success'))
    @include('alert.success')
@elseif(Session::has('danger'))
    @include('alert.danger')
@endif


<div class="content">
        <div class="card mx-5 mt-5">
            <div class="card-header border-0">
                <h4 class="d-flex justify-content-center">
                    Search Doctors
                </h4>
            </div>
            <div class="card-body">
                <form action="{{route('searchdoctor')}}" method="POST">
                    @csrf
                    <div class="row  mx-auto p-4">
                        <div class="col-md-4">
                            <input type="text" name="speciality" id="search_speciality" class="form-control" placeholder="speciality" id="">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="city" id="search_city" class="form-control" placeholder="city" id="">

                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <input type="submit" class="btn" value="Faind" style="background-color: #a61057; color: white"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <div class="card mx-5">
        <div class="card-header border-0">

            <h4 class="d-flex justify-content-center">
                Book an appointment immediately
            </h4>
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-center">
                @php $i = 0; $flag = false; @endphp

                @foreach ($doctors as $doctor)
                    @php $i++ @endphp

                    <div class="col-md-4 owl">
                        <a href="{{route('doctor.info',$doctor->id)}}">
                            <div class="card card-absolute border-l-info border-4">
                                <div class="card-header bg-primary">
                                    <h5 class="txt-light">Dr.{{$doctor->fname.' '.$doctor->lname}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex list-behavior-1">
                                        <div class="flex-shrink-0 p-r-5">
                                            <img class="tab-img img-fluid" src="{{asset('images/doctor/'.$doctor->image)}}" alt="home">
                                            @php
                                                $parametres = App\Models\Parametre::where('doctor_id', $doctor->id)->first();
                                                $serializedSpecialities = $parametres->speciality_id;
                                                $selectedSpecialities = unserialize($serializedSpecialities);
                                                $specialities = App\Models\Speciality::whereIn('id', $selectedSpecialities)->get();
                                                $j= 0;
                                                $sp = " ";
                                                foreach ($specialities as $speciality){
                                                    $sp .= $speciality->name_sp;
                                                    if($j < 1) {
                                                        $sp .= "...";
                                                        break;
                                                    }else{
                                                        $sp .= ", ";
                                                    }
                                                    $j++;
                                                }
                                            @endphp

                                            <p class="breadcrumb-item m-0">{{ $sp }}</p>

                                        </div>
                                        <div class="flex-grow-1 ">
                                            <p><span class="fw-bold">Phone number</span> : {{$doctor->phone_number}}</p>
                                            <p><span class="fw-bold">Address</span> : {{$doctor->address}}</p>
                                            <p><span class="fw-bold">city</span> : {{$doctor->city->nom_city}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @php
                        if($i == 6){
                            $flag = true ;
                             break;
                        }
                    @endphp
                @endforeach
                @if($flag)
                    <a href="{{route('alldoctors')}}" class="btn btn-primary fw-bold w-25 l-50">List of Doctors</a>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection


@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


 <script>

        $.ajax({
            method:'GET',
            url: "{{route('specialityList')}}",
            success: function (response) {
                autoCompleteSpecialities(response);
            }
        });
        $.ajax({
            method:'GET',
            url: "{{route('cityList')}}",
            success: function (response) {
                autoCompleteCities(response);
            }
        });

        function autoCompleteSpecialities(availableTags){
            $( "#search_speciality" ).autocomplete({
                source: availableTags
            });
        }
        function autoCompleteCities(availableTags){
            $( "#search_city" ).autocomplete({
                source: availableTags
            });
        }

  </script>

@endsection
