@section('title', __('Add or give permissions'))
@extends('layouts_user.master')
@section("road")

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
                        <h4>Employee  : {{$employee->fname.' '.$employee->lname}}
                            <a href="{{route('employee.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('employee.storePermissions',$employee->id)}}" method="post">
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
                                        <input type="checkbox" name="permission[]" {{in_array($permission->id,$modelPermissions) ? 'checked':''}} value="{{$permission->name}}" id="">
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
