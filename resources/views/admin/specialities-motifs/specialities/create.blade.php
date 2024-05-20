@section('title','Create Specialities')
@extends('layouts.master')
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Speciality Management</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('speciality.index')}}">Specialities</a></li>
        <li class="breadcrumb-item f-w-400 active">create</li>
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
                            Add Specialities
                            <a href="{{route('speciality.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" method="POST" action="{{route('speciality.store')}}">
                        @csrf

                        <div class="col-md-12 position-relative">
                            <label class="form-label">Name speciality <span class="text-danger">*</span></label>
                            <input class="form-control @error('namespeciality') is-invalid  @enderror"  type="text" name="namespeciality" >
                            @error('namespeciality')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 position-relative">
                            <label class="form-label">Description speciality <span class="text-danger">*</span></label>
                            {{-- <input class="form-control @error('description') is-invalid  @enderror"  type="text" name="description" > --}}
                            <textarea class="form-control @error('description') is-invalid  @enderror" name="description" id="" cols="" rows="5"></textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
