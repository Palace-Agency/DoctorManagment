@section('title','patients')
@extends('layouts_user.master')
@section('content')
    <div class="container-fluid calendar-basic">
        @if (Session::has('success'))
            @include('alert.success')
        @elseif(Session::has('danger'))
            @include('alert.danger')
        @endif
        <div class="card">
            <div class="card-header border-0">
                <h4>
                    <i class="icofont icofont-users-alt-1"></i>&nbsp;Patients
                    <a href="{{route('mypatient.create')}}" class="float-end"><i class="fa icon-plus"></i>&nbsp;&nbsp;New Patient</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Phone number</th>
                                <th>City</th>
                                <th>patient file</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $id=1 ;

                            @endphp
                            @foreach ($patients as $patient)
                                @php
                                    $birthDate = Carbon\Carbon::parse($patient->date_naissance);
                                    // Get the current date
                                    $currentDate = Carbon\Carbon::now();

                                    // Calculate the difference in years between the birthdate and the current date
                                    $age = $currentDate->diffInYears($birthDate);
                                @endphp
                                <tr>
                                    <td>{{$id}}</td>
                                    <td>{{$patient->fname}}</td>
                                    <td>{{$patient->lname}}</td>
                                    <td>{{$age}} years old</td>
                                    <td>{{$patient->phone_number}}</td>
                                    <td>{{$patient->city->nom_city}}</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit "> <a href="{{route('mypatient.details',$patient->id)}}"><i class="fa fa-user-md f-20"></i>&nbsp; Details</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @php $id++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
