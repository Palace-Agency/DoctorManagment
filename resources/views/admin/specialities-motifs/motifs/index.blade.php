@section('title', 'Motifs')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Motifs Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active">Motifs</li>
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
                    <script>
                        swal("success", "{{ Session::get('success') }}", "success");
                    </script>
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Motifs
                            <a href="{{route('motif.create')}}" class="btn btn-primary float-end">Add motif</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Speciality</th>
                                        <th>Name reason</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($motifs as $reason)
                                        <tr>
                                            <td>{{$reason->id}}</td>
                                            <td>{{$reason->speciality->name_sp}}</td>
                                            <td>{{$reason->nom_motif}}</td>
                                            <td>{{$reason->description}}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a href="{{route('motif.edit',$reason->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">
                                                        <form id="deleteForm" action="{{ route('motif.destroy', $reason->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a href="" onclick="confirmation(event)"><i class="icon-trash"></i></a>
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
@section('script')
<script>
    $.ajax({
        // AJAX request to delete motif
        success: function(response) {
            if (response.success) {
                swal("Success", response.message, "success");
            }
        },
        error: function(xhr, status, error) {
            swal("Error", "Failed to delete motif", "error");
        }
    });
</script>
@endsection
