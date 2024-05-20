@extends('layouts.bodyVisiteur')
@section('content')

    <div class="card mx-5 mt-5">
        <div class="card-header border-0">
            <h4 class="d-flex justify-content-center">
                Book an appointment immediately
            </h4>
        </div>
        <div class="card-body">

            <div class="row d-flex justify-content-start">
                @foreach ($doctors as $doctor)

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

                @endforeach

            </div>
        </div>
    </div>

@endsection


