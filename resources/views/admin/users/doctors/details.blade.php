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
                            Patients of Dr. {{$doctor->fname .' '.$doctor->lname}}
                            <a href="{{route('doctor.index')}}" class="btn btn-primary float-end">back</a>
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
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>

                                            <td>{{$patient->id}}</td>
                                            <td><img src="{{asset('/images/patient/'.$patient->image)}}" width="80px" height="80px" alt=""></td>
                                            <td>{{$patient->fname}}</td>
                                            <td>{{$patient->lname}}</td>
                                            <td>{{$patient->gender}}</td>
                                            <td>{{$patient->city->nom_city}}</td>
                                            <td>{{$patient->phone_number}}</td>
                                            <td>{{$patient->date_naissance}}</td>
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


