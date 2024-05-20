@section('title', 'Edit Act & Care')
@extends('layouts_user.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
        @if (Session::has('success'))
            @include('alert.success')
        @elseif(Session::has('danger'))
            @include('alert.danger')
        @endif
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Act & Care
                            <a href="{{ route('actcare.index') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('actcare.update',$actcare->id) }}" class="form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-contol">
                                        <div class="form-group ">
                                            <label>Name of act :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="nameact" value="{{$actcare->name_act}}" class="form-control @error('nameact') is-invalid @enderror">
                                            @error('nameact')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Name of mutuelle : </label>
                                        <input type="text" name="name_m" value="{{$actcare->name_mutuelle}}" class="form-control @error('name_m') is-invalid @enderror">
                                        @error('name_m')
                                            <span class="text-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-contol">
                                        <label>Name of Category  :
                                        </label>
                                        <select class="form-control select2 select2-accessible" aria-label="Default select example" name='category_act' required>
                                            <option disabled>Choose category</option>
                                            @foreach ($category_acts as $category_act)
                                                <option {{$category_act->id == $actcare->cat_id ? 'selected' : ''}} value="{{$category_act->id}}">{{$category_act->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Honoraires
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control @error('honoraires') is-invalid @enderror" value="{{$actcare->honoraires}}" name="honoraires">
                                        @error('honoraires')
                                        <span class="text-danger" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Code </label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{$actcare->code}}" name="code">
                                        @error('code')
                                        <span class="text-danger" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Coefficient
                                        </label>
                                        <input type="number" class="form-control @error('coefficient') is-invalid @enderror" value="{{$actcare->coefficient}}" name="coefficient">
                                        @error('coefficient')
                                        <span class="text-danger" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mt-2">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="status" type="radio" value="0" {{$actcare->remboursement_acte ==0 ? 'checked' : ''}} >
                                                    <label class="form-check-label"> non remboursable </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="status"  type="radio" value="1" {{$actcare->remboursement_acte ==1 ? 'checked' : ''}} >
                                                    <label class="form-check-label" for=""> remboursable </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn ripple btn-primary my-4" type="submit">update</button>
                                <a type="button" class="float-end" data-bs-toggle="modal" data-bs-target="#createCategory">Create Category</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Create Category</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="catCreate">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category </label>
                                    <input type="text" class="form-control @error('name_cat') is-invalid @enderror" value="{{old('name_cat')}}" required name="name_cat">
                                </div>
                            </div>
                        </div>
                        <div class="theme-scrollbar mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><span>Name</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyCat">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer border-0">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function rowCat(){
        $.ajax({
            url: "{{ route('actcare.get') }}",
            method: "GET",
            success: function(response) {
                $("#bodyCat").empty();
                $.each(response, function(index, category_act_array) {
                    category_act_array.forEach(function(category_act) {
                        var deleteCat = "{{ route('actcare.delete', '') }}/" + category_act.id;
                        var tr = `
                            <tr>
                                <td>${category_act.name}</td>
                                <td>
                                    <ul class='action'>
                                        <li class='edit'><a href=''><i class="icon-pencil-alt"></i></a></li>
                                        <li class='delete'><a href='${deleteCat}' onclick='confirm(event)'><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>`;
                        $("#bodyCat").append(tr);
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    rowCat();

    $(document).ready(function(){ // Use "document" without quotes
        $('#catCreate').on('submit', function(e){
            e.preventDefault();
            var name_cat = $('input[name="name_cat"]').val();
            $.ajax({
                method: "POST",
                url: "{{ route('actcare.store') }}", // Ensure that this route exists in your Laravel routes
                data: {
                    name_cat : name_cat
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Make sure this is the correct way to get CSRF token
                },
                success: function(response) {

                    if (response.hasOwnProperty('danger')) {
                        swal("Error!", response.danger, "error");
                    } else if (response.hasOwnProperty('success')) {
                        rowCat();
                        swal("Success!", response.success, "success");
                    } else {
                        swal("Error!", "An unexpected error occurred.", "error");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    swal("Error!", "Failed to communicate with the server.", "error");
                }
            });
        });
    });

</script>

@endsection
