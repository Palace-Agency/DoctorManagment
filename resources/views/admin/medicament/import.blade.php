@section('title','Create Patient')
@extends('layouts.master')
@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
@endsection
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Patient manager</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('medicament.index')}}">Medicament</a></li>
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
                            add/update medicament
                            <a href="{{route('medicament.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="theme-form" method="POST" action="{{route('medicament.import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-6">
                                    <label class="form-label">Import file<span class="txt-danger">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control @error('import_file') is-invalid @enderror" name="import_file" value="{{old("import_file")}}" type="file" >
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        @error('import_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>



                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

