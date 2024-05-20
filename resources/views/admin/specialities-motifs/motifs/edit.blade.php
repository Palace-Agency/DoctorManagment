@section('title','Edit Motif')
@extends('layouts.master')
@section("road")
<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">Motif Management</h4>
    <nav>
    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
        <li class="breadcrumb-item f-w-400">Dashboard</li>
        <li class="breadcrumb-item f-w-400"><a href="{{route('motif.index')}}">Motifs</a></li>
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
                            Edit Motifs
                            <a href="{{route('motif.index')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" method="POST" action="{{route('motif.update',$motif->id)}}">
                        @csrf
                        @method("PUT")
                            <div class="col-md-6">
                                <label class="form-label" for="validationTooltip04">Specialities <span class="text-danger">*</span></label>
                                <select data-live-search="true" class="form-select @error('sp_id') is-invalid @enderror" name="sp_id">
                                    <option selected disabled>Choose...</option>
                                    @foreach($specialities as $speciality)

                                        <option {{$speciality->id === $motif->speciality_id ? 'selected ':''}} value="{{$speciality->id}}">{{$speciality->name_sp}}</option>
                                    @endforeach
                                </select>
                                @error('sp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        <div class="col-md-6 position-relative">
                            <label class="form-label">Name Motif <span class="text-danger">*</span></label>
                            <input value="{{$motif->nom_motif}}" class="form-control @error('namemotif') is-invalid  @enderror"  type="text" name="namemotif" >
                            @error('namemotif')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 position-relative">
                            <label class="form-label">Description speciality <span class="text-danger">*</span></label>
                            {{-- <input class="form-control @error('description') is-invalid  @enderror"  type="text" name="description" > --}}
                            <textarea class="form-control @error('description') is-invalid  @enderror" name="description" id="" cols="" rows="5">{{$motif->description}}</textarea>
                            @error('description')
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

