@section('title', 'Emplyee')
@extends('layouts_user.master')
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
                    <div class="card-header border-0">
                        <h4>
                            <h4>Employee Management</h4>
                            <a href="{{route('employee.create')}}" class="btn btn-primary float-end">Add Emplyee</a>

                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
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
                                    @foreach ($employees->filter(function ($employee) {
                                            return $employee->hasRole('employee');
                                        }) as $employee)
                                        <tr>
                                            <td><img src="{{asset('/images/employee/'.$employee->image)}}" width="80px" height="80px" alt=""></td>
                                            <td>{{$employee->fname}}</td>
                                            <td>{{$employee->lname}}</td>
                                            <td>{{$employee->gender}}</td>
                                            <td>{{$employee->city->nom_city}}</td>
                                            <td>{{$employee->phone_number}}</td>
                                            <td><span class="{{$employee->isActive === "1" ? "badge text-bg-success" :"badge text-bg-danger"}}">{{$employee->isActive === "1" ? "Active" :"Disable"}}</span></td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit "> <a href="{{route('employee.edit',$employee->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">

                                                        <a href="{{route('employee.delete',$employee->id)}}" onclick="confirm(event)"><i class="icon-trash"></i></a>
                                                    </li>
                                                    <li class="m-l-10">
                                                        <span class="dropdown">
                                                            <a aria-expanded="false" aria-haspopup="true" class="border-0 " data-bs-toggle="dropdown" id="dropdownMenuButton" type="button"><i class="fa fa-ellipsis-v text-black"></i></a>
                                                            <div  class="dropdown-menu tx-13">
                                                                @if($employee->isActive != 1)
                                                                    <form id="statusformemp" method="POST" action="{{ route('employee.status',$employee->id)}}">
                                                                        @csrf
                                                                        <input type="hidden" class="status" name="status" value="1">
                                                                        <button class="dropdown-item" type="submit">Active</button>
                                                                    </form>
                                                                @else
                                                                    <form id="statusformemp" method="POST" action="{{ route('employee.status',$employee->id)}}">
                                                                        @csrf
                                                                        <input type="hidden" class="status" name="status" value="0">
                                                                        <button class="dropdown-item" type="submit">Disable</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </span>
                                                    </li>
                                                    {{-- @if(auth()->user()->can('view permissions')) --}}
                                                    {{-- <li class="m-l-10">
                                                        <a href="{{route('employee.givepermissions',$employee->id)}}">
                                                            <i class="fa fa-sliders f-20"></i>
                                                        </a>
                                                    </li> --}}
                                                    {{-- @endif --}}
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
<!-- Include jQuery from a CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
