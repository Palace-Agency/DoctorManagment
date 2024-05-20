@section('title','edit Roles')
@extends('layouts.master')
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Role Management</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400 active"><a href="{{route('permission.index')}}">Roles</a></li>
        <li class="breadcrumb-item f-w-400 active">Edit</li>
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
                            Edit Roles
                            <a href="{{route('role.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" method="POST" action="{{route('role.update',$role->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12 position-relative">
                            <label class="form-label">Name of role <span class="text-danger">*</span></label>
                            <input class="form-control @error('namerole') is-invalid  @enderror" value="{{$role->name}}"  type="text" name="namerole" >
                            @error('namerole')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
