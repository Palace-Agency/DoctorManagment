@section('title', 'Details')
@extends('layouts_user.master')
@section('content')
@if (Session::has('success'))
            @include('alert.success')
        @elseif(Session::has('danger'))
            @include('alert.danger')
        @endif

@endsection
