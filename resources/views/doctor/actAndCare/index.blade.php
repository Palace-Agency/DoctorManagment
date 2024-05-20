@section('title', 'Act & Care')
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
                    <div class="card-header">
                        <h4>
                            Act & Care
                            <a href="{{ route('actcare.create') }}" class="btn btn-primary float-end">Add Act & Care</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th><span>Name</span></th>
                                        <th><span>Category</span></th>
                                        <th><span>Frais</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actcares as $actcare)
                                        <tr>
                                            <td class="text-capitalize">{{$actcare->name_act}}</td>
                                            <td class="text-capitalize">{{$actcare->category->name}}</td>
                                            <td class="text-success fw-bold">{{$actcare->honoraires}} Dh</td>
                                            <td>
                                                <ul class='action'>
                                                    <li class='edit'><a href='{{route('actcare.edit',$actcare->id)}}'><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete"><a href="{{route('actcare.deleteAct',$actcare->id)}}" onclick="confirm(event)"><i class="icon-trash"></i></a></li>
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
