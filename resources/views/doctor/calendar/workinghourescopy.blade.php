@section('title', 'Working Houres')
@extends('layouts_user.master')

@section('content')

    <div class="container-fluid calendar-basic">
        @if (Session::has('success'))
            @include('alert.success')
        @elseif(Session::has('danger'))
            @include('alert.danger')
        @endif
        <div class="card">
            <div class="card-header border-0">
                <h4>
                    <i class="fa fa-calendar"></i>&nbsp;Working Houres
                </h4>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="card shadow-none">
                        <div class="card-header border-0">
                            <h4>Appointment duration</h4>
                            <p class="f-m-light mt-1">
                                Kindly specify the duration of the appointment that works for you.</p>
                        </div>
                        <div class="card-body">
                            <div class="main">
                                <form action="" class="formwork" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            @php
                                                $duree = App\Models\Parametre::where('doctor_id', Auth::id())->first();
                                            @endphp

                                            <div class="form-check radio radio-primary">
                                                <input class="form-check-input" id="radio111" type="radio" name="duree"
                                                    value="15" {{ $duree->duree_appointments == 15 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="radio111">15 Minute</label>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check radio radio-warning">
                                                <input class="form-check-input" id="radio333" type="radio" name="duree"
                                                    value="30" {{ $duree->duree_appointments == 30 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="radio333">30 Minute</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check radio radio-danger">
                                                <input class="form-check-input" id="radio444" type="radio" name="duree"
                                                    value="60" {{ $duree->duree_appointments == 60 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="radio444">60 Minute </label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="container mt-5">
                        <nav>
                            <div class="nav nav-tabs justify-content-start position-relative " id="nav-tab"
                                role="tablist">
                                <button class="nav-link active fw-semibold text-dark" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Working Hours</button>

                                <!-- Le bouton sera affiché seulement si la catégorie est "Men" ou "Women" -->
                                <button class="nav-link fw-semibold text-dark" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Vacancy</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active p-4" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <h4 class="mt-3">Please specify the daily working hours.</h4>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]"
                                                {{ isset($workingdays['sanday'][0]['day_off']) && $workingdays['sanday'][0]['day_off'] == 'disable' ? 'checked' : '' }}
                                                type="checkbox" id="checkbox-primary-7">
                                            <input type="hidden" name="nameofday[]" class="day" value="sanday">
                                            <label class="form-check-label" for="checkbox-primary-7">sanday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 work-hours" style="{{ isset($workingdays['sanday'][0]['start_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1 ftime work-hours" style="{{ isset($workingdays['sanday'][0]['start_time']) ? '' : 'display: none;' }}">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['sanday'][0]['start_time'] ?? '' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1 work-hours" style="{{ isset($workingdays['sanday'][0]['end_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1 stime">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['sanday'][0]['end_time'] ?? '' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2 work-hours" style="{{ isset($workingdays['sanday'][0]['end_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['sanday'][0]['type_consultation']) && $workingdays['sanday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2 work-hours" style="{{ isset($workingdays['sanday'][0]['start_time']) ? '' : 'display: none;' }}">
                                        @if (isset($workingdays['sanday'][1]))
                                        <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                        <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add work-hours"
                                    style="{{ isset($workingdays['sanday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime ">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['sanday'][1]['start_time']) ? $workingdays['sanday'][1]['start_time'] : '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime ">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['sanday'][1]['end_time']) ? $workingdays['sanday'][1]['end_time'] : '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                            @php
                                                $defaultValue = isset($workingdays['sanday'][1]['type_consultation']) ? $workingdays['sanday'][1]['type_consultation'] : 'personnel';
                                            @endphp
                                            @foreach (['personnel', 'remote', 'both'] as $item)
                                                <option {{ $defaultValue == $item ? 'selected' : '' }} value="{{ $item }}" class="text-capitalize">
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]" {{ isset($workingdays['monday'][0]['day_off']) && $workingdays['monday'][0]['day_off'] == 'disable' ? 'checked' : '' }}
                                                type="checkbox" id="checkbox-primary-6">
                                            <input type="hidden" name="nameofday[]" value="monday">

                                            <label class="form-check-label" for="checkbox-primary-6">Monday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 check_mon"style="{{ isset($workingdays['monday'][0]['start_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['monday'][0]['start_time'] ?? '' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1 check_mon" style="{{ isset($workingdays['monday'][0]['end_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['monday'][0]['end_time'] ?? '' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2 check_mon" style="{{ isset($workingdays['monday'][0]['start_time']) ? '' : 'display: none;' }}">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['monday'][0]['type_consultation']) && $workingdays['monday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach



                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2 check_mon" style="{{ isset($workingdays['monday'][1]) ? '' : 'display: none;' }}">
                                        @if (isset($workingdays['monday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add check_mon"
                                    style="{{ isset($workingdays['monday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3 check_mon">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['monday'][1]['start_time']) ? $workingdays['monday'][1]['start_time'] : '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1 check_mon">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['monday'][1]['end_time']) ? $workingdays['monday'][1]['end_time'] : '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2 check_mon">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['monday'][1]['type_consultation']) && $workingdays['monday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]"
                                                type="checkbox" checked id="checkbox-primary-5">
                                            <input type="hidden" name="nameofday[]" value="tuesday">

                                            <label class="form-check-label" for="checkbox-primary-5">Tuesday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['tuesday'][0]['start_time'] ?? '09:00:00' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['tuesday'][0]['end_time'] ?? '13:00:00' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['tuesday'][0]['type_consultation']) && $workingdays['tuesday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2">
                                        @if (isset($workingdays['tuesday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add"
                                    style="{{ isset($workingdays['tuesday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['tuesday'][1]['start_time']) ? $workingdays['tuesday'][1]['start_time'] : '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ isset($workingdays['tuesday'][1]['end_time']) ? $workingdays['tuesday'][1]['end_time'] : '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['tuesday'][1]['type_consultation']) && $workingdays['tuesday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]" checked
                                                type="checkbox" id="checkbox-primary-4">
                                            <input type="hidden" name="nameofday[]" value="wednesday">

                                            <label class="form-check-label" for="checkbox-primary-4">Wednesday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['wednesday'][0]['start_time'] ?? '09:00:00' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['wednesday'][0]['end_time'] ?? '13:00:00' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['wednesday'][0]['type_consultation']) && $workingdays['wednesday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2">

                                        @if (isset($workingdays['wednesday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add"
                                    style="{{ isset($workingdays['wednesday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                        <input type="hidden" name="nameofday2[]" class="day" value="wednesday">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['wednesday'][1]['start_time'] ?? '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['wednesday'][1]['end_time'] ?? '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['wednesday'][1]['type_consultation']) && $workingdays['wednesday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]" checked
                                                type="checkbox" id="checkbox-primary-3">
                                            <input type="hidden" name="nameofday[]" value="thursday">

                                            <label class="form-check-label" for="checkbox-primary-3">Thursday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['thursday'][0]['start_time'] ?? '09:00:00' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['wednesday'][0]['end_time'] ?? '13:00:00' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['thursday'][0]['type_consultation']) && $workingdays['thursday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2">
                                        @if (isset($workingdays['thursday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add"
                                    style="{{ isset($workingdays['thursday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['thursday'][1]['start_time'] ?? '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['thursday'][1]['end_time'] ?? '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['thursday'][1]['type_consultation']) && $workingdays['thursday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]" checked
                                                type="checkbox" id="checkbox-primary-2">
                                            <input type="hidden" name="nameofday[]" value="friday">

                                            <label class="form-check-label" for="checkbox-primary-2">Friday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['friday'][0]['start_time'] ?? '09:00:00' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['friday'][0]['end_time'] ?? '09:00:00' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['friday'][0]['type_consultation']) && $workingdays['friday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2">
                                        @if (isset($workingdays['friday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add"
                                    style="{{ isset($workingdays['friday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['friday'][1]['start_time'] ?? '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['friday'][1]['end_time'] ?? '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['friday'][1]['type_consultation']) && $workingdays['friday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-control border-0 mb-0">
                                            <input class="form-check-input" value="1" name="off[]" checked
                                                type="checkbox" id="checkbox-primary-1">
                                            <input type="hidden" name="nameofday[]" value="saturday">

                                            <label class="form-check-label" for="checkbox-primary-1">Saturday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['saturday'][0]['start_time'] ?? '09:00:00' }}"
                                                name="start_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 ">
                                            <input class="form-control digits" type="time"
                                                value="{{ $workingdays['saturday'][0]['end_time'] ?? '13:00:00' }}"
                                                name="end_time[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 ">
                                            <select class="form-select" name="type_consult[]" id="validationTooltip04">
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['saturday'][0]['type_consultation']) && $workingdays['saturday'][0]['type_consultation'] == $item ? 'selected' : ($item == 'Personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2">
                                        @if (isset($workingdays['saturday'][1]))
                                            <span class="add-icon"><i class="icon-minus"></i></span>
                                        @else
                                            <span class="add-icon"><i class="icon-plus"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row add"
                                    style="{{ isset($workingdays['saturday'][1]) ? '' : 'display: none;' }}">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="m-1 ftime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['saturday'][1]['start_time'] ?? '' }}"
                                                name="start_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-1">
                                        <div class="m-1 stime">
                                            <input class="form-control digits2" type="time"
                                                value="{{ $workingdays['saturday'][1]['end_time'] ?? '' }}"
                                                name="end_time2[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="m-1 type">
                                            <select class="form-select" name="type_consult2[]" id="validationTooltip04"
                                                required>
                                                @foreach (['personnel', 'remote', 'both'] as $item)
                                                    <option
                                                        {{ isset($workingdays['saturday'][1]['type_consultation']) && $workingdays['saturday'][1]['type_consultation'] == $item ? 'selected' : ($item == 'personnel' ? 'selected' : '') }}
                                                        value="{{ $item }}" class="text-capitalize">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn ripple btn-primary my-4" type="submit">
                                        Save</button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade p-4" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <h4 class="mt-3">Please indicate your annual vacation and holidays</h4>
                                <form action="" method="post" class="formholiday mt-3" id="holiday">
                                    @csrf
                                    <div class="row mt-3" id="therow">
                                        @foreach ($holidays as $item)
                                            <input type="hidden" name="vac_id[]" value="{{ $item->id }}">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <label>Label</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $item->label }}" name="label[]">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a class="removeholiday"><i
                                                                class="icofont icofont-ui-close"></i></a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-sm-6">Date start</label>

                                                        <input class="form-control" type="date"
                                                            value="{{ $item->date_start }}" name="date_start_holiday[]">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-sm-6">Time start</label>

                                                        <input class="form-control" type="time"
                                                            value="{{ $item->time_start }}" name="time_start_holiday[]">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-sm-6">Date end</label>

                                                        <input class="form-control" type="date"
                                                            value="{{ $item->date_end }}" name="date_end_holiday[]">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-sm-6">Time end</label>

                                                        <input class="form-control" type="time"
                                                            value="{{ $item->time_end }}" name="time_end_holiday[]">
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach



                                    </div>
                                    <div>
                                        <button class="btn  ripple btn-primary my-4" type="submit">
                                            Enregistrer</button>
                                        <a class="btn btn-primary" id="addholiday"><i class="fa fa-plus"></i></a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



    </div>
    </div>


@endsection


@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#addholiday').click(function() {
                var newColumn =
                    `
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Label</label>
                                    <input class="form-control"
                                        type="text" value="" name="label[]">
                            </div>
                            <div class="col-md-1">
                                <a class="removeholiday"><i class="icofont icofont-ui-close"></i></a>
                            </div>
                            <div class="col-md-6">
                            <label class="col-sm-6">Date start</label>

                                    <input class="form-control"
                                        type="date" value="" name="date_start_holiday[]">

                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-6">Time start</label>

                                    <input class="form-control" type="time"
                                        value="" name="time_start_holiday[]">

                            </div>
                            <div class="col-md-6">
                            <label class="col-sm-6">Date end</label>

                                    <input class="form-control"
                                        type="date" value="" name="date_end_holiday[]">

                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-6">Time end</label>

                                    <input class="form-control" type="time"
                                        value="" name="time_end_holiday[]">

                            </div>

                        </div>
                    </div>

                `;
                $('#holiday #therow').append(newColumn);
            });
            $('#holiday').on('click', '.removeholiday', function(e) {
                e.preventDefault();
                $(this).closest('.col-lg-6').remove();
            });

            // Add click event listener to the add icons
            $(document).on('click', '.add-icon', function() {
                // Toggle the visibility of the next sibling element with class "add"
                var addRow = $(this).closest('.row').next('.add');

                addRow.toggle();

                // Clear input values if the row is hidden
                if (!addRow.is(":visible")) {
                    addRow.find('input[type="time"]').val('');
                    addRow.find('select[name="type_consult2[]"]').val('personnel');

                    addRow.find('select[name="type_consult2[]"]').removeAttr('required');
                } else {
                    addRow.find('select[name="type_consult2[]"]').attr('required', true);
                }
                var icon = $(this).find('i');
                if (icon.hasClass('icon-minus')) {
                    icon.removeClass('icon-minus').addClass('icon-plus');
                } else {
                    icon.removeClass('icon-plus').addClass('icon-minus');
                }

            });

            // Add click event listener to the delete icons
            $('.formwork').on('submit', function(e) {
                e.preventDefault();

                    var offDays = [];
                    $('input[name="off[]"]').each(function(index) {
                        if (!$(this).is(':checked')) {
                            // If checkbox is not checked, it means the day is off
                            offDays.push(index);
                        }
                    });

                var workDays = [];
                $('input[name="nameofday[]"]').each(function(index) {
                    if (offDays.indexOf(index) === -1) {
                        // If the day index is not in offDays array, it means it's a work day
                        workDays.push(index);
                    }
                });



                var formData = {
                    nameday: $('input[name="nameofday[]"]').map(function() {
                        return $(this).val();
                    }).get(),

                    duree: $('input[name="duree"]:checked').val(),
                    start_time: $('input[name="start_time[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    end_time: $('input[name="end_time[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    start_time2: $('input[name="start_time2[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    end_time2: $('input[name="end_time2[]"]').map(function() {
                        return $(this).val();
                    }).get(),

                    type_consult: $('select[name="type_consult[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    type_consult2: $('select[name="type_consult2[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    workDays: workDays,
                    offDays: offDays
                    // Add more fields as needed
                };
                var form = $(this);
                $.ajax({
                    method: "POST",
                    url: "{{ route('bussinss.store') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.hasOwnProperty('danger')) {
                            let errorMessages = '';
                            response.danger.forEach(function(error) {
                                errorMessages += `* ${error.message} on ${error.day}\n`;
                            });
                            swal("Error!", errorMessages, "error");
                        } else if (response.hasOwnProperty('success')) {
                            // If response has 'success' key, show success message
                            swal("Success!", JSON.stringify(response.success), "success");
                        } else {
                            // If response has neither 'danger' nor 'success' key, show a generic error message
                            swal("Error!", "An unexpected error occurred.", "error");
                        }

                    }
                });
            });
            // Function to toggle required attribute
            // function toggleRequiredAttribute() {
            //     var inputs = $(".work-hours input[type='time'], .work-hours select");
            //     inputs.prop('required', function(_, value) {
            //         return !value;
            //     });
            // }


            $("#checkbox-primary-7").change(function() {
                if (this.checked) {
                    // Show work hours
                    $(".work-hours").show();
                    // Clear input values
                    $(".work-hours input[type='time']").val('');
                    $(".work-hours select").val('');

                    // toggleRequiredAttribute();
                } else {
                    // Hide work hours
                    $(".work-hours").hide();
                    // Clear input values
                    $(".work-hours input[type='time']").val('');
                    $(".work-hours select").val('personnel');

                    // toggleRequiredAttribute();
                }
            });
            $("#checkbox-primary-6").change(function() {
                if (this.checked) {
                    // Show work hours
                    $(".check_mon").show();
                    // Clear input values
                    $(".check_mon input[type='time']").val('');
                    $(".check_mon select").val('');

                    // toggleRequiredAttribute();
                } else {
                    // Hide work hours
                    $(".check_mon").hide();
                    // Clear input values
                    $(".check_mon input[type='time']").val('');
                    $(".check_mon select").val('personnel');

                    // toggleRequiredAttribute();
                }
            });



            $('.formholiday').on('submit', function(e) {
                e.preventDefault();
                var formData = {
                    label: $('input[name="label[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    vac_id: $('input[name="vac_id[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    start_time_h: $('input[name="time_start_holiday[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    end_time_h: $('input[name="time_end_holiday[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    date_start_h: $('input[name="date_start_holiday[]"]').map(function() {
                        return $(this).val();
                    }).get(),
                    date_end_h: $('input[name="date_end_holiday[]"]').map(function() {
                        return $(this).val();
                    }).get(),


                };

                var form = $(this);
                $.ajax({
                    method: "POST",
                    url: "{{ route('bussinss.vacance') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.hasOwnProperty('danger')) {

                            swal("Error!", JSON.stringify(response.danger), "error");
                        } else if (response.hasOwnProperty('success')) {
                            // If response has 'success' key, show success message
                            swal("Success!", JSON.stringify(response.success), "success");
                        } else {
                            // If response has neither 'danger' nor 'success' key, show a generic error message
                            swal("Error!", "An unexpected error occurred.", "error");
                        }

                    }
                });
            });
        });
    </script>


@endsection
