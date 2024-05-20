@section('title', __('Add or give permissions'))
@extends('layouts.master')
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Role Management</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('role.index')}}">Roles</a></li>
        <li class="breadcrumb-item f-w-400 active">Add or give permissions</li>
    </ol>
    </nav>
</div>
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    @include('alert.success')
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Role  : {{$role->name}}
                            <a href="{{route('role.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('role.givepermissions',$role->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="">Permissions</label>
                            <div class="row">
                                @error('permission')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox" name="permission[]" {{in_array($permission->id,$rolePermissions) ? 'checked':''}} value="{{$permission->name}}" id="">
                                        {{$permission->name}}
                                    </label>
                                </div>

                                @endforeach
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
