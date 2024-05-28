@section('title', 'Patients of doctor')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Doctor Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dash')}}"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active"><a href="{{route('doctor.index')}}">Doctor</a></li>
                <li class="breadcrumb-item f-w-400 active">Détails</li>

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
                            Appointments of Dr. {{$doctor->fname .' '.$doctor->lname}}
                            <a href="{{route('doctor.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>type appointment</th>
                                        <th>First Name Patient</th>
                                        <th>Last Name Patient</th>
                                        <th>Phone number Patient</th>
                                        <th>First Name Doctor</th>
                                        <th>Last name Doctor</th>
                                        <th>Phone number Doctor</th>
                                        <th>Motifs</th>
                                        <th>date appointment</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)

                                        <tr>
                                            <td class="d-flex justify-content-center">
                                                {{$appointment->type_appointment}}
                                            </td>
                                            <td> {{$appointment->patient->fname}} </td>
                                            <td> {{$appointment->patient->lname}} </td>
                                            <td> {{$appointment->patient->phone_number}}</td>
                                            <th> {{$appointment->doctor->fname}}</th>
                                            <th> {{$appointment->doctor->lname}}</th>
                                            <th> {{$appointment->doctor->phone_number}}</th>
                                            <td>{{$appointment->motif->nom_motif}}</td>
                                            <td>{{$appointment->appontment_date}}</td>
                                            <td><span class="{{$appointment->status == "pending" ? 'badge text-bg-warning' :
                                                        ($appointment->status == "inprogress" ? 'badge text-bg-primary badge-small' :
                                                        ($appointment->status == "cancelled" ? 'badge text-bg-danger badge-small' :
                                                        ($appointment->status == "completed" ? 'badge text-bg-success badge-small' : 'badge bg-warning')))}}">



                                                        <strong class="text-light text-capitalize">{{$appointment->status}}</strong></span></td>

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


