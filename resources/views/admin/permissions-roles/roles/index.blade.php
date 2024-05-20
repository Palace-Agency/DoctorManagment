@section('title', 'Roles')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Roles Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active">Roles</li>
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
                            Roles
                            <a href="{{route('role.create')}}" class="btn btn-primary float-end">Add Role</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a href="{{route('role.edit',$role->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">
                                                        <form id="deleteForm" action="{{route('role.destroy',$role->id)}}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a href="#" onclick="confirmation(event)"><i class="icon-trash"></i></a></li>
                                                    <li class="m-l-10">
                                                        <a href="{{route('role.givepermissions',$role->id)}}">
                                                            <i class="fa fa-sliders "></i>
                                                        </a>
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
