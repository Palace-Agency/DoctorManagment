@section('title', 'Doctors')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Doctors Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active">Doctors</li>
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
                            Doctors
                            <a href="{{route('doctor.create')}}" class="btn btn-primary float-end">Add doctor</a>
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
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors->filter(function ($doctor) {
                                            return $doctor->hasRole('doctor');
                                        }) as $doctor)
                                        <tr>
                                            <td>{{$doctor->id}}</td>
                                            <td><img src="{{asset('/images/doctor/'.$doctor->image)}}" width="80px" height="80px" alt=""></td>
                                            <td>{{$doctor->fname}}</td>
                                            <td>{{$doctor->lname}}</td>
                                            <td>{{$doctor->gender}}</td>
                                            <td>{{$doctor->city->nom_city}}</td>
                                            <td>{{$doctor->phone_number}}</td>
                                            <td><span class="{{$doctor->isActive === "1" ? "badge text-bg-success" :"badge text-bg-danger"}}">{{$doctor->isActive === "1" ? "Active" :"Disable"}}</span></td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit "> <a href="{{route('doctor.edit',$doctor->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">

                                                        <a href="{{ route('doctor.destroy', $doctor->id) }}" onclick="confirm(event)"><i class="icon-trash"></i></a>
                                                    </li>
                                                    <li class="m-l-10">
                                                        <span class="dropdown">
                                                            <a aria-expanded="false" aria-haspopup="true" class="border-0 " data-bs-toggle="dropdown" id="dropdownMenuButton" type="button"><i class="fa fa-ellipsis-v text-black"></i></a>
                                                            <div  class="dropdown-menu tx-13">
                                                                @if($doctor->isActive != 1)
                                                                    <form id="statusformdoc" method="POST" action="{{ route('doctor.status',$doctor->id) }}">
                                                                        @csrf
                                                                        <input type="hidden" class="status" name="status" value="1">
                                                                        <button class="dropdown-item" type="submit">Active</button>
                                                                    </form>
                                                                @else
                                                                    <form id="statusformdoc" method="POST" action="{{ route('doctor.status',$doctor->id) }}">
                                                                        @csrf
                                                                        <input type="hidden" class="status" name="status" value="0">
                                                                        <button class="dropdown-item" type="submit">Disable</button>
                                                                    </form>
                                                                @endif

                                                            </div>
                                                        </span>
                                                    </li>
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


