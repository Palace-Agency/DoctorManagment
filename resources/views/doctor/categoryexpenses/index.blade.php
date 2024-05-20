@section('title', 'Category Expenses')
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
                            Category Expenses
                            <a href="{{route('categoryexpense.create')}}" class="btn btn-primary float-end">Add category expenses</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Created at</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $id=1 @endphp
                                    @foreach ($catexps as $catexp)
                                        <tr>
                                            <td>{{ $id }}</td>
                                            <td>{{ $catexp->name }}</td>
                                            <td>{{ $catexp->created_at->format('Y-m-d') }}</td>
                                            <td>{{ Str::limit($catexp->description, 30) }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit "> <a href="{{route('categoryexpense.edit',$catexp->id)}}"><i class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">

                                                        <a href="{{route('categoryexpense.destroy',$catexp->id)}}" onclick="confirm(event)"><i class="icon-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @php $id++ @endphp
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
