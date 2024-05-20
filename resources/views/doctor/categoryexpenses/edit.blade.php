@section('title', 'Edit Category for your expenses')
@extends('layouts_user.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit category expense
                            <a href="{{ route('categoryexpense.index') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categoryexpense.update',$categoryexp->id) }}" class="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name of Category :
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="name" value="{{$categoryexp->name}}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description :</label>
                                <textarea class="form-control" rows="5" name="description">{{$categoryexp->description}}</textarea>
                                @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter description
                                </div>

                            </div>
                            <div>
                                <button class="btn ripple btn-primary my-4" type="submit">
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
