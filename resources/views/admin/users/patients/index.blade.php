@section('title', 'Patients')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Patients Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active">Patient</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                @if (Session::has('success'))
                    @include('alert.success')
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Patients
                            <a href="{{route('patient.create')}}" class="btn btn-primary float-end">Add patient</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Picture</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>City</th>
                                        <th>Phone number</th>
                                        <th>Date Naissance</th>
                                        {{-- <th>status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $id = 1 ;@endphp
                                    @foreach ($patients->filter(function ($patient) {
                                            return $patient->hasRole('patient');
                                        }) as $patient)
                                        <tr>
                                            <td>{{$id++}}</td>
                                            <td><img src="{{asset('/images/patient/'.$patient->image)}}" width="80px" height="80px" alt=""></td>
                                            <td>{{$patient->fname}}</td>
                                            <td>{{$patient->lname}}</td>
                                            <td>{{$patient->gender}}</td>
                                            <td>{{$patient->city->nom_city}}</td>
                                            <td>{{$patient->phone_number}}</td>
                                            <td>{{$patient->date_naissance}}</td>
                                            {{-- <td><span class="{{$patient->isActive === "1" ? "badge text-bg-success" :"badge text-bg-danger"}}">{{$patient->isActive === "1" ? "Active" :"Disable"}}</span></td> --}}
                                            <td>
                                                <ul class="action">
                                                    <li class="edit "> <a href="{{route('patient.edit',$patient->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">

                                                        <a href="{{route('patient.destroy',$patient->id)}}" onclick="confirm(event)"><i class="icon-trash"></i></a>
                                                    </li>
                                                    {{-- <li class="m-l-10">
                                                        <span class="dropdown">
                                                            <a aria-expanded="false" aria-haspopup="true" class="border-0 " data-bs-toggle="dropdown" id="dropdownMenuButton" type="button"><i class="fa fa-ellipsis-v text-black"></i></a>
                                                            <div  class="dropdown-menu tx-13">
                                                            @if($patient->isActive!=1)
                                                                <form id="statusform" data-patient-id="{{ $patient->id }}">
                                                                    @csrf
                                                                    <input type="hidden" class="status" name="status" value="1">
                                                                    <button class="dropdown-item" type="submit" >Active </button>
                                                                </form>
                                                            @else
                                                                <form  id="statusform" data-patient-id="{{ $patient->id }}">
                                                                    @csrf
                                                                    <input type="hidden" class="status" name="status" value="0">
                                                                    <button class="dropdown-item" type="submit">Disable </button>
                                                                </form>
                                                            @endif
                                                            </div>
                                                        </span>
                                                    </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#statusform').on('submit', function(e) {
    e.preventDefault();
    var status_change = $(this).find('.status').val();
    var patient_id  = $(this).data('patient-id');

    var form = $(this); // Store reference to the form
    $.ajax({
        method: "POST",
        url: "{{route('patient.status', ['idpatient' => ':patient_id'])}}/".replace(':patient_id', patient_id), // Concatenate the patient's ID to the URL
        data: form.serialize(), // Serialize the form data
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            swal("", response.status, "success");
        }
    });
});


    });
</script>

@endsection
