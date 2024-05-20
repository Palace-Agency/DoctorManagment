@section('title', 'Medicament')
@extends('layouts.master')
@section('road')
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">Medicament Management</h4>
        <nav>
            <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
                <li class="breadcrumb-item f-w-400">Dashboard</li>
                <li class="breadcrumb-item f-w-400 active">Medicament</li>
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
                    @include('alert.success')
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Medicament
                            <a href="{{route('medicament.create')}}" class="btn btn-primary float-end">Add/Update medicament</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <td>code</td>
                                        <td>nom</td>
                                        <td>dci1</td>
                                        <td>dosage1</td>
                                        <td>unite_dosage1</td>
                                        <td>forme</td>
                                        <td>presentation</td>
                                        <td>ppv</td>
                                        <td>ph</td>
                                        <td>prix_br</td>
                                        <td>princeps_generique</td>
                                        <td>taux_remboursement</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicaments as $item)
                                        <tr>
                                            <td>{{$item->code}}</td>
                                            <td>{{$item->nom}}</td>
                                            <td>{{$item->dcil}}</td>
                                            <td>{{$item->dosage1}}</td>
                                            <td>{{$item->unite_dosage1}}</td>
                                            <td>{{Str::limit($item->forme,30) }}</td>
                                            <td>{{$item->presentation}}</td>
                                            <td>{{$item->ppv}}</td>
                                            <td>{{$item->ph}}</td>
                                            <td>{{$item->prix_br}}</td>
                                            <td>{{$item->princeps_generique}}</td>
                                            <td>{{$item->taux_remboursement}}</td>
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


@endsection
