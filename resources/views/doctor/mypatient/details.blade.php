@section('title', 'Details patients')
@extends('layouts_user.master')

@section('content')

    <div class="container-fluid calendar-basic">
        @if (Session::has('success'))
            @include('alert.success')
        @elseif(Session::has('danger'))
            @include('alert.danger')
        @endif
        <div class="card" style="min-height: 600px">
            <div class="card-header border-0">
                <h4>
                    <a href="{{ route('mypatient.index') }}" class=""><i
                            class="icofont icofont-users-alt-1"></i>&nbsp;Patients > </a> <a
                        href="">{{ $patient->fname . ' ' . $patient->lname }}</a>
                    <button class="btn btn-success float-end" type="button" data-bs-toggle="modal"
                        data-bs-target=".bd-example-modal-lg">Book an appointment</button>

                </h4>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myExtraLargeModal" aria-hidden="true" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myExtraLargeModal">Book an appointment for the patient {{$patient->fname}}</h4>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post" class="formappointment">
                                @csrf
                                <div class="modal-body dark-modal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Type of consultation
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="radio" checked name="type" value="personnel"
                                                        id="personnel">
                                                    <label for="personnel">face-to-face</label>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="radio" name="type" value="remote" id="remote">
                                                    <label for="remote">teleconsultation</label>
                                                </div>
                                            </div>
                                            <div class="row mt-6">
                                                <div class="col-md-12">
                                                    Controle
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="radio" checked name="controle" value="1"
                                                        id="y">
                                                    <label for="y">Yes</label>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="radio" name="controle" value="0" id="n">
                                                    <label for="n">NO</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 mb-0  w-100">
                                                        <div class="mb-3 mb-0 animated-modal-md-mb w-100">
                                                            <label class="me-3">Reason for the consultation</label>
                                                            <select class="form-select w-75" id="exit"
                                                                name="reason_consult">
                                                                @foreach ($specialities as $item)
                                                                    <optgroup label="{{ $item->name_sp }}"></optgroup>

                                                                    @foreach ($motifs as $motif)
                                                                        @if ($motif->speciality_id == $item->id)
                                                                            <option value="{{ $motif->id }}">
                                                                                {{ $motif->nom_motif }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <a href="" class="w-100 p-0"><span class="float-start">choose the
                                                            date</span><i class="icofont icofont-time "></i></a>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row agenda-days">
                                        <div class="card">
                                            <div class="card-header">
                                                choose the date and the time
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-3 mb-0  w-100">
                                                        <div class="mb-3 mb-0 animated-modal-md-mb w-100">
                                                            @php
                                                                $currentMonth = $now->month;
                                                                $currentYear = $now->year;
                                                            @endphp
                                                            <select name="year_month" class="form-select w-50">
                                                                @for ($i = 0; $i < 2; $i++)
                                                                    @php
                                                                        $year = $currentYear + $i;
                                                                        $startMonth = $i === 0 ? $currentMonth : 1;
                                                                        $endMonth = $i === 0 ?: $currentMonth - 1;
                                                                    @endphp

                                                                    <optgroup label="{{ $year }}">
                                                                        @for ($month = $startMonth; $month <= 12; $month++)
                                                                            <option
                                                                                value="{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}"
                                                                                {{ $year == $currentYear && $month == $currentMonth ? 'selected' : '' }}>
                                                                                {{ Carbon\Carbon::createFromDate($year, $month, 1)->format('F') }}
                                                                            </option>
                                                                        @endfor
                                                                    </optgroup>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 owl">
                                                        @php
                                                            $currentMonth = $now->month;
                                                            $daysInMonth = Carbon\Carbon::createFromDate(
                                                                $currentYear,
                                                                $currentMonth,
                                                            )->daysInMonth;
                                                        @endphp
                                                        <div class="owl-carousel owl-theme" id="owl-carousel-13">
                                                            @for ($day = $now->day; $day <= $daysInMonth; $day++)
                                                                @php
                                                                    $currentDate = Carbon\Carbon::createFromDate(
                                                                        $currentYear,
                                                                        $currentMonth,
                                                                        $day,
                                                                    );
                                                                    $fullDayName = $currentDate->format('l');
                                                                @endphp
                                                                <div class="item">
                                                                    <div
                                                                        class="d-flex justify-content-center bg-primary p-3 rounded-pill">
                                                                        <input type="hidden" class="get-day" name=""
                                                                            value="{{ $day }}">
                                                                        {{ Carbon\Carbon::createFromDate($currentYear, $currentMonth, $day)->format('D. d/m') }}
                                                                    </div>
                                                                    <div class="vertical-scroll scroll-demo scroll-b-none mt-5">
                                                                        <div class="list-group">
                                                                            @php $flag = 0 ; @endphp
                                                                            @foreach ($workhours as $work)
                                                                                @php $flag == 1 ? '' : $period = [] @endphp
                                                                                @if (strtolower($fullDayName) === $work->day_of_week)
                                                                                    @php
                                                                                        $startTime =
                                                                                            Carbon\Carbon::parse(
                                                                                                $work->start_time,
                                                                                            ) ?? null;
                                                                                        $endTime =
                                                                                            Carbon\Carbon::parse(
                                                                                                $work->end_time,
                                                                                            ) ?? null;
                                                                                        if ($startTime && $endTime) {
                                                                                            $periodStart = $startTime->copy();
                                                                                            while (
                                                                                                $periodStart->lessThanOrEqualTo(
                                                                                                    $endTime,
                                                                                                )
                                                                                            ) {
                                                                                                $period[] = $periodStart->copy();
                                                                                                $periodStart->addMinutes(
                                                                                                    $difftime->duree_appointments,
                                                                                                );
                                                                                            }

                                                                                            if (
                                                                                                $currentDate->isToday()
                                                                                            ) {
                                                                                                // echo 'hello';
                                                                                                $isNot = true;
                                                                                                foreach (
                                                                                                    $period
                                                                                                    as $key => $datetime
                                                                                                ) {
                                                                                                    if (
                                                                                                        $datetime->greaterThan(
                                                                                                            $now,
                                                                                                        )
                                                                                                    ) {
                                                                                                        $period = array_slice(
                                                                                                            $period,
                                                                                                            $key,
                                                                                                        ); // Discard past time slots
                                                                                                        $isNot = false;
                                                                                                        break;
                                                                                                    }
                                                                                                }
                                                                                                if ($isNot) {
                                                                                                    $period = [];
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        $flag = 1;
                                                                                        $checkday =
                                                                                            $work->day_off ===
                                                                                            'disable';
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                            @php

                                                                                $date = Carbon\Carbon::createFromFormat(
                                                                                    'Y-m-d',
                                                                                    $currentYear .
                                                                                        '-' .
                                                                                        $currentMonth .
                                                                                        '-' .
                                                                                        $day,
                                                                                );
                                                                                foreach ($holidays as $holiday) {
                                                                                    $holidayStartDate = Carbon\Carbon::parse(
                                                                                        $holiday->date_start,
                                                                                    )->format('Y-m-d');
                                                                                    $holidayEndDate = Carbon\Carbon::parse(
                                                                                        $holiday->date_end,
                                                                                    )
                                                                                        ->addDays(1)
                                                                                        ->format('Y-m-d');
                                                                                    if (
                                                                                        $holidayEndDate ===
                                                                                            $holidayStartDate &&
                                                                                        $date->format('Y-m-d') ===
                                                                                            $holidayStartDate
                                                                                    ) {
                                                                                        foreach (
                                                                                            $period
                                                                                            as $key => $datetime
                                                                                        ) {
                                                                                            if (
                                                                                                $datetime->between(
                                                                                                    $holiday->time_start,
                                                                                                    $holiday->time_end,
                                                                                                )
                                                                                            ) {
                                                                                                unset($period[$key]);
                                                                                            }
                                                                                        }
                                                                                    } elseif (
                                                                                        $date->between(
                                                                                            $holidayStartDate,
                                                                                            $holidayEndDate,
                                                                                        )
                                                                                    ) {
                                                                                        if (
                                                                                            $date->format('Y-m-d') ===
                                                                                            $holidayStartDate
                                                                                        ) {
                                                                                            $newPeriod = [];
                                                                                            $startTime = Carbon\Carbon::parse(
                                                                                                $holiday->time_start,
                                                                                            );
                                                                                            foreach (
                                                                                                $period
                                                                                                as $datetime
                                                                                            ) {
                                                                                                if (
                                                                                                    $datetime->lessThan(
                                                                                                        $startTime,
                                                                                                    )
                                                                                                ) {
                                                                                                    $newPeriod[] = $datetime->copy();
                                                                                                } else {
                                                                                                    break; // Stop adding time slots once we reach the holiday start time
                                                                                                }
                                                                                            }
                                                                                            $period = $newPeriod;
                                                                                        } elseif (
                                                                                            $date->format('Y-m-d') ===
                                                                                            $holidayEndDate
                                                                                        ) {
                                                                                            $newPeriod = [];
                                                                                            $endTime = end($period);
                                                                                            $holidayEndTime = Carbon\Carbon::parse(
                                                                                                $holiday->time_end,
                                                                                            );
                                                                                            foreach (
                                                                                                $period
                                                                                                as $datetime
                                                                                            ) {
                                                                                                if (
                                                                                                    $datetime->greaterThanOrEqualTo(
                                                                                                        $holidayEndTime,
                                                                                                    )
                                                                                                ) {
                                                                                                    $newPeriod[] = $datetime->copy();
                                                                                                }
                                                                                            }
                                                                                            $period = $newPeriod;
                                                                                        } else {
                                                                                            $period = [];
                                                                                        }
                                                                                    }
                                                                                }
                                                                                foreach (
                                                                                    $appointments
                                                                                    as $appointment
                                                                                ) {
                                                                                    $date_appointment = Carbon\Carbon::parse(
                                                                                        $appointment->appontment_date,
                                                                                    )->format('Y-m-d');
                                                                                    $start_at = Carbon\Carbon::parse(
                                                                                        $appointment->start_at,
                                                                                    );
                                                                                    if (
                                                                                        $date->format('Y-m-d') ===
                                                                                        $date_appointment
                                                                                    ) {
                                                                                        foreach (
                                                                                            $period
                                                                                            as $key => $datetime
                                                                                        ) {
                                                                                            if (
                                                                                                $datetime->eq($start_at)
                                                                                            ) {
                                                                                                // Remove the time slot from $period
                                                                                                unset($period[$key]);
                                                                                                // Exit the loop for this appointment
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            @if ($checkday ?? false)
                                                                                @foreach ($period as $datetime)
                                                                                    <a class="list-group-item list-group-item-action time-link list-hover-primary"
                                                                                        href="javascript:void(0)"
                                                                                        data-time="{{ $datetime->format('G:i') }}">{{ $datetime->format('G:i') }}</a>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Medical information<span
                                                    class="txt-danger">*</span></label>
                                            <textarea class="form-control @error('informations') is-invalid @enderror" value="{{ old('informations') }}"
                                                name="informations" id="" rows="3"></textarea>
                                            @error('informations')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="container mt-5">
                        <nav>
                            <div class="nav nav-tabs justify-content-start position-relative " id="nav-tab"
                                role="tablist">
                                <button class="nav-link active fw-semibold text-dark" id="nav-home-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                    aria-controls="nav-home" aria-selected="true">My personal information</button>
                                <button class="nav-link fw-semibold text-dark" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">liste of appointments</button>
                                <button class="nav-link fw-semibold text-dark" id="nav-ordonnance-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-ordonnance" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">E-Ordonnances</button>
                                <button class="nav-link fw-semibold text-dark" id="nav-remarque-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-remarque" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Observation</button>
                            </div>
                        </nav>
                        @php
                            $birthDate = Carbon\Carbon::parse($patient->date_naissance);
                            $currentDate = Carbon\Carbon::now();
                            $age = $currentDate->diffInYears($birthDate);
                        @endphp
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active p-4" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <h4 class="mt-3 f-14 text-muted">About {{ $patient->fname . ' ' . $patient->lname }} ,
                                    {{ $age }} year old</h4>
                                <form class="forminfo">
                                    <div class="row mt-3">
                                        <div class="col-sm-4">
                                            <label class="form-label">First Name<span class="txt-danger">*</span></label>
                                            <input class="form-control @error('fname') is-invalid @enderror"
                                                name="fname" value="{{ $patient->fname }}" type="text"
                                                placeholder="Enter your first name">
                                            @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Last Name<span class="txt-danger">*</span></label>
                                            <input class="form-control @error('lname') is-invalid @enderror"
                                                name="lname" value="{{ $patient->lname }}" type="text"
                                                placeholder="Enter your last name">
                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 p-0">
                                            <label class="form-label" for="validationTooltip04">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select  @error('gender') is-invalid @enderror"
                                                name="gender">
                                                <option selected disabled>Choose...</option>
                                                @foreach (['man', 'women'] as $gender)
                                                    <option {{ $patient->gender == $gender ? 'selected' : '' }}
                                                        value="{{ $gender }}">{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="validationTooltip04">Date of birth day <span
                                                    class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('datenaiss') is-invalid @enderror"
                                                value="{{ $patient->date_naissance }}" name="datenaiss">
                                            @error('datenaiss')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-4 select-box-city mt-2">
                                            <label class="form-label" for="validationTooltip04">City <span
                                                    class="text-danger">*</span></label>
                                            <select data-live-search="true"
                                                class="form-select @error('city_id') is-invalid @enderror" name="city_id">
                                                <option selected disabled>Choose...</option>
                                                @foreach (App\Models\City::all() as $city)
                                                    <option {{ $patient->city_id == $city->id ? 'selected' : '' }}
                                                        value="{{ $city->id }}">{{ $city->nom_city }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label">Zip Code<span class="txt-danger">*</span></label>
                                            <input class="form-control @error('zip_code') is-invalid @enderror"
                                                value="{{ $patient->zip_code }}" name="zip_code" type="text">
                                            @error('zip_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4 mt-2">
                                            <label class="form-label">Adresse<span class="txt-danger">*</span></label>
                                            <input class="form-control @error('adresse') is-invalid @enderror"
                                                value="{{ $patient->address }}" name="adresse" type="text"
                                                placeholder="Enter your adresse">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <label class="form-label">Phone number<span
                                                    class="txt-danger">*</span></label>
                                            <input class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ $patient->phone_number }}" name="phone" type="text"
                                                placeholder="Enter your phone number">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <label class="form-label">Email<span class="txt-danger">*</span></label>
                                            <input readonly
                                                class="text-muted form-control @error('email') is-invalid @enderror"
                                                value="{{ $patient->email }}" name="email" type="email"
                                                placeholder="Enter your email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="">
                                            {{-- <input type="submit" class="btn btn-primary mt-3" value="Save"> --}}
                                            <button type="button" class="btn btn-primary mt-3 save">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade p-4" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <div class="row" id="appointmentGet">

                                </div>
                            </div>
                            <div class="tab-pane fade p-4" id="nav-ordonnance" role="tabpanel" aria-labelledby="nav-ordonnance-tab" tabindex="0">
                                <h4 class="mt-3">E-Ordonnances
                                    <a class="float-end btn btn-success" type="button" data-bs-toggle="modal" data-bs-target=".ordonnance"><i class="icon-plus"></i>&nbsp;Add Ordonnance</a>
                                </h4>
                                <div class="row" id="ordonnanceContainer"> </div>
                            </div>
                            <div class="tab-pane fade p-4" id="nav-remarque" role="tabpanel" aria-labelledby="nav-remarque-tab" tabindex="0">
                                <h4 class="mt-3">List of Observation
                                    <a class="float-end" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLong"><i class="icon-plus"></i>&nbsp;Add observation</a>
                                </h4>
                                <div class="row" id="observationsContainer"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade ordonnance" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
            <h5 class="mb-2">New ordonnance for {{$patient->fname}}</h5>
            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body dark-modal">
            <form class="form-wizard formOrdo" id="regForm" action="#" method="POST">
                @csrf
                <div class="tab">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="radio" name="type_ordonnance" value="pharmacy" id="pharmacy">
                            <label for="pharmacy">Pharmacy</label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" name="type_ordonnance" value="biology" id="biology">
                            <label for="biology">Biology</label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" name="type_ordonnance" value="imagery" id="imagery">
                            <label for="imagery">Imagery</label>
                        </div>
                    </div>
                </div>
                <div class="tab medicament_tab">
                    <div class="row">
                        <span class="text-danger msg"></span>
                        <div class="col-md-6">
                            <label>Medicaments</label>
                            <div class="select-box">
                                <div class="options-container">
                                    @foreach ($medicaments as $medicament)
                                        <div class="selection-option">
                                            <input class="radio getmedicament" id="{{$medicament->code}}" type="radio" name="{{$medicament->code}}">
                                            <label class="mb-0" class="text-capitalize" for="{{$medicament->code}}">{{$medicament->nom.', '.$medicament->dosage1.''.$medicament->unite_dosage1.', '.$medicament->forme}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="selected-box">Select Your Profession</div>
                                <div class="search-box">
                                <input type="text" placeholder="Start Typing...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">treatment</label>
                            <input class="form-control" name="treatment" value="{{old("treatment")}}" id="treatment" type="text" placeholder="treatment">

                        </div>
                        <div class="col-md-2 mt-2 mt-4">
                            <span  class="btn btn-primary addMedicament">Plus</span>
                        </div>
                        <div class="mt-4" id="showMedicament">

                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="row mt-3">
                        <textarea name="description" placeholder="ordonnance/Remarque" id="" cols="" rows="10"></textarea>
                    </div>
                </div>
                <div>
                    <div class="text-end pt-3">
                        <button class="btn btn-secondary" id="prevBtn" type="button" onclick="nextPrev(-1)">Previous</button>
                        <button class="btn btn-primary" id="nextBtn" type="button" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>
                <div class="text-center"><span class="step"></span><span class="step step2"></span><span class="step"></span></div>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{-- <div class="modal fade ordonnance_update" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
            <h5 class="mb-2">New ordonnance for {{$patient->fname}}</h5>
            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body dark-modal">
            <form class="form-wizard formOrdo" id="regForm" action="#" method="POST">
                @csrf

                <div class="tab2 medicament_tab">
                    <div class="row">
                        <span class="text-danger msg"></span>
                        <div class="col-md-6">
                            <label>Medicaments</label>
                            <div class="select-box">
                                <div class="options-container">
                                    @foreach ($medicaments as $medicament)
                                        <div class="selection-option">
                                            <input class="radio getmedicament" id="{{$medicament->code}}" type="radio" name="{{$medicament->code}}">
                                            <label class="mb-0" class="text-capitalize" for="{{$medicament->code}}">{{$medicament->nom.', '.$medicament->dosage1.''.$medicament->unite_dosage1.', '.$medicament->forme}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="selected-box">Select Your Profession</div>
                                <div class="search-box">
                                <input type="text" placeholder="Start Typing...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">treatment</label>
                            <input class="form-control" name="treatment" value="{{old("treatment")}}" id="treatment" type="text" placeholder="treatment">

                        </div>
                        <div class="col-md-2 mt-2 mt-4">
                            <span  class="btn btn-primary addMedicament">Plus</span>
                        </div>
                        <div class="mt-4" id="showMedicamentUp">

                        </div>
                    </div>
                </div>
                <div class="tab2">
                    <div class="row mt-3">
                        <textarea name="description" placeholder="ordonnance/Remarque" id="" cols="" rows="10"></textarea>
                    </div>
                </div>
                <div>
                    <div class="text-end pt-3">
                        <button class="btn btn-secondary" id="previousBtn" type="button" onclick="nextPrevious(-1)">Previous</button>
                        <button class="btn btn-primary submitBtn" id="nexttBtn"  type="button" onclick="nextPrevious(1)">Next</button>
                    </div>
                </div>
                <div class="text-center"><span class="step step2"></span><span class="step"></span></div>
            </form>
            </div>
        </div>
        </div>
    </div> --}}


    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Write Observation</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mypatient.observation', $patient->id) }}" method="POST"
                        id="formObservation">
                        @csrf

                        <textarea class="form-control" value="{{ old('observation') }}" name="observation" id="" rows="3"></textarea>
                        <div class="modal-footer border-0">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editObservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Update Observation</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="observationupdate">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="idobservation" id="putid">
                        <textarea class="form-control" value="" name="observupdate" id="obs" rows="3"></textarea>
                        <div class="modal-footer border-0">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateAppointment" tabindex="-1" role="dialog"aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Modify Appointment</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="appointmentUp">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id_appointment" id="id_appointment" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 mb-0  w-100">
                                    <div class="mb-3 mb-0 animated-modal-md-mb w-100">
                                        <label class="me-3">Reason for the consultation</label>
                                        <select class="form-select w-75" id="reasons" name="reason_consult_up">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="color: #222f5b">Type of consultation</h4>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="type_consult_up" value="personnel" id="inpersone">
                                <label for="personnel">face-to-face</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="type_consult_up" value="remote" id="inremote">
                                <label for="remote">teleconsultation</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="color: #222f5b">Controle</h4>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="radio" name="controle_up" value="1" id="yes">
                                <label for="y">Yes</label>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="radio" name="controle_up" value="0" id="non">
                                <label for="n">NO</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="color: #222f5b">Medical information</h4>
                                <label class="form-label">Medical information<span class="txt-danger">*</span></label>
                                <textarea class="form-control" id="info_update" name="info" id="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <select name="status" id="status_g" class="form-control"></select>
                        </div>


                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary" type="submit" data-bs-dismiss="modal">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('assets/js/scrollable/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollable/scrollable-custom.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('assets/js/select2/custom-inputsearch.js')}}"></script>
    <script src="{{asset('assets/js/form-wizard/form-wizard.js')}}"></script>

    <script>


        // function setOrdonnanceId(ordonnanceId) {
        //     // console.log(ordonnanceId);
        //     $.ajax({
        //         method: "Get", // Use POST method
        //         url: "{{ route('ordonnance.getspecifique', '') }}" + "/" + ordonnanceId,
        //         data: [],
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             OrdonnanceModal(response);
        //         }
        //     });
        // }
        // function OrdonnanceModal(response) {



        //     if(!response[1].trim()){

        //     }else{
        //         $('#showMedicamentUp').empty();
        //         var addup = "";
        //         response[1].forEach(function(item) {
        //             addup += "<div class='row'><div class='col-md-5 mt-3'>" + item.medicament + "</div>" +
        //                 "<div class='col-md-5 mt-3'>" + item.treatment + "</div>" +
        //                 "<div class='col-md-2 mt-3'><span class='btn btn-danger'><i class='icon-trash'></i></span></div></div>";
        //         });
        //         $('#showMedicamentUp').append(addup);
        //     }

        // }

        function setAppointmentId(appointmentId) {
            // console.log(appointmentId);
            $.ajax({
                method: "Get", // Use POST method
                url: "{{ route('appointment.modify', '') }}" + "/" + appointmentId,
                data: [],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    appointmentModal(response);
                }
            });
        }


        function appointmentModal(response) {
            $('#id_appointment').val(response[0].id);

            if (response[0].controle == 1) {
                $('#yes').prop('checked', true);
            } else if (response[0].controle == 0) {
                $('#non').prop('checked', true);
            }
            var type = response[0].type_appointment;


            if (type == 'personnel') {
                $('#inpersone').prop('checked', true);
            } else if (type == 'remote') {
                $('#inremote').prop('checked', true);
            }

            $('#info_update').val(response[0].medical_information).text(response[0].medical_information);

            $('#status_g').empty();
            var status_ht = "";

            var status = ["pending", "inprogress", "waiting", "completed", "cancelled"];

            for (var i = 0; i < status.length; i++) {
                if (response[0].status == 'completed' || response[0].status == 'cancelled') {
                    status_ht += '<option>the status can\'t change</option>';
                    break;
                } else if (response[0].status == 'inprogress') {
                    if (status[i] === 'inprogress') {
                        status_ht += '<option selected value="inprogress">inprogress</option>';
                    } else if (status[i] === 'pending') {
                        continue;
                    } else {
                        status_ht += '<option value="' + status[i] + '">' + status[i] + '</option>';

                    }
                } else if (response[0].status == 'waiting') {
                    if (status[i] === 'waiting') {
                        status_ht += '<option selected value="' + status[i] + '">' + status[i] + '</option>';
                    } else if (status[i] === 'pending' || status[i] === 'inprogress') {
                        continue;
                    } else {
                        status_ht += '<option value="' + status[i] + '">' + status[i] + '</option>';

                    }
                } else if (status[i] === response[0].status) {
                    status_ht += '<option selected value="' + response[0].status + '">' + response[0].status + '</option>';
                } else {
                    status_ht += '<option value="' + status[i] + '">' + status[i] + '</option>';
                }
            }
            $('#status_g').append(status_ht); // changed from append(html) to append(status_html)


            let html = "";
            $('#reasons').empty();
            let spec = null; // Clear previous content before populating again
            for (let i = 0; i < response[1].length; i++) {
                // Clear html variable at the beginning of each iteration
                html += '<optgroup label="' + response[1][i].name_sp + '"></optgroup>';

                for (let j = 0; j < response[2].length; j++) {
                    if (response[2][j].speciality_id == response[1][i].id) {
                        if (response[0].motif_id == response[2][j].id) {
                            html += '<option selected value="' + response[2][j].id + '">' + response[2][j].nom_motif +
                                '</option>';
                        } else {
                            html += '<option value="' + response[2][j].id + '">' + response[2][j].nom_motif + '</option>';
                        }
                    }
                }
            }

            $('#reasons').append(html);
        }

        function formatDateHour(dateString) {
            // Parse the date string into a Date object
            var date = new Date(dateString);

            // Extract the hours, minutes, and seconds components from the Date object
            var hours = date.getHours();
            var minutes = date.getMinutes();

            // Format the components as strings and add leading zeros if necessary
            var formattedTime = hours + ':' + minutes ;

            return formattedTime;
        }

        function formatDate(dateString) {
            // Parse the date string into a Date object
            var date = new Date(dateString);

            // Extract the hours, minutes, and seconds components from the Date object
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var day = date.getDate();

            // Format the components as strings and add leading zeros if necessary
            var formattedTime = year + '-' + month + '-' + day;

            return formattedTime;
        }

        function getObservationId(observationId) {
            // console.log(observationId);
            $.ajax({
                method: "Get", // Use POST method
                url: "{{ route('getObser', '') }}" + "/" + observationId,
                data: [],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    editObserv(response);
                }
            });
        }

        function editObserv(response) {
            $('#obs').text(response[0].observation_desc);
            $('#putid').val(response[0].id);
        }

        function getObservations(patientId) {
            $.ajax({
                url: "{{ route('observation.get', ':id') }}".replace(':id', patientId),
                method: "GET",
                success: function(response) {
                    // Clear the existing observations
                    $('#observationsContainer').empty();
                    // Append new observations
                    $.each(response, function(index, observation) {
                        var deleteUrl = "{{ route('observation.delete', '') }}/" + observation.id;
                        var observationHtml = `
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <div class="card-header border-t-info">
                                    <h4>Created in ${formatDateHour(observation.created_at)}
                                        <a class="text-danger float-end" href="${deleteUrl}" onclick="confirm(event)"><i class="icofont icofont-ui-delete"></i></a>

                                    </h4>
                                    <small class="text-mute float-end">${formatDate(observation.created_at)}</small>
                                </div>
                                <div class="card-body">
                                    <p class="mt-1 f-m-light text-dark">${ observation.observation_desc}</p>
                                </div>
                                <div class="card-footer">
                                    <ul class="action">
                                        <li class="edit"><a type="button" class="text-info" data-bs-toggle="modal" onclick="getObservationId(${observation.id})" data-bs-target="#editObservation"><i class="icofont icofont-edit"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                        // Append the observation HTML to the container element
                        $('#observationsContainer').append(observationHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        getObservations({{ $patient->id }});
        function hours(hour){
            // Diviser la chaîne en heures, minutes et secondes
            var parts = hour.split(':');
            // Extraire les heures, minutes et secondes de la chaîne
            var hours = parseInt(parts[0]);
            var minutes = parseInt(parts[1]);
            // Créer un nouvel objet Date avec les heures et minutes extraites
            var startAt = new Date();
            startAt.setHours(hours);
            startAt.setMinutes(minutes);
            // Formater l'heure
            var formattedTime = startAt.getHours() + ":" + startAt.getMinutes();
            // Retourner l'heure formatée
            return formattedTime;
        }
        function getAppointment(patientId) {
            $.ajax({
                url: "{{ route('appointment.get', ':id') }}".replace(':id', patientId),
                method: "GET",
                success: function(response) {
                    // Clear the existing observations
                    $('#appointmentGet').empty();
                    // Append new observations
                    $.each(response, function(index, appointment) {
                        var appointmentHtml = `
                        <div class="col-md-4">
                            <div class="card mt-3" style="min-height: 210px">
                                <div class="card-header border-t-info">
                                    <h4>start at : ${hours(appointment.start_at)}
                                        <a class="text-danger float-end" href="{{ route('appointmentget.deleted', '') }}/${appointment.id}" onclick="confirm(event)"><i class="icofont icofont-ui-delete"></i></a>

                                        </h4>
                                        <small class="text-mute float-end"> date appointment : ${formatDate(appointment.appontment_date)}</small>
                                </div>
                                <div class="card-body">
                                    <p class="mt-1 f-m-light text-dark">the reason of the consultation is : <strong>${appointment.motif.nom_motif}</strong></p>
                                </div>
                                <div class="card-footer">
                                            <a class="text-info float-start" type="button" data-bs-toggle="modal" onclick="setAppointmentId('${appointment.id}')" data-bs-target="#updateAppointment"><i class="icofont icofont-edit"></i></a>
                                            <span class="float-end text-capitalize fw-bold"><strong>${appointment.status}</strong></span>

                                </div>
                            </div>
                        </div>
                    `;
                        // Append the observation HTML to the container element
                        $('#appointmentGet').append(appointmentHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        getAppointment({{ $patient->id }});

        function getOrdonnance(patientId) {
            $.ajax({
                url: "{{ route('ordonnance.get', ':id') }}".replace(':id', patientId),
                method: "GET",
                success: function(response) {
                    // Clear the existing observations
                    $('#ordonnanceContainer').empty();
                    // Append new observations
                    $.each(response, function(index, ordonnance) {
                        var deleteOrd = "{{ route('ordonnance.delete', '') }}/" + ordonnance.id;
                        var pdfOrdonnance = "{{route('pdf.ordonnance','')}}/"+ordonnance.id;
                        var ordonnanceHtml = `
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <div class="card-header border-t-info">
                                    <h4>Created in ${formatDateHour(ordonnance.created_at)}
                                        <a class="text-danger float-end" href="${deleteOrd}" onclick="confirm(event)"><i class="icofont icofont-ui-delete"></i></a>
                                    </h4>
                                    <small class="text-mute float-end">${formatDate(ordonnance.created_at)}</small>
                                </div>
                                <div class="card-body">
                                    <p class="mt-1 f-m-light text-dark text-capitalize fw-normal">${ ordonnance.remarque}</p>
                                </div>
                                <div class="card-footer">
                                    <a class="text-info float-start" href="${pdfOrdonnance}" ><i class="fa fa-file-text-o"></i>Download</a>

                                    <span class="float-end text-capitalize fw-bold"><strong>${ordonnance.type_ordonnance}</strong></span>

                                </div>
                            </div>
                        </div>
                    `;
                        // Append the observation HTML to the container element
                        $('#ordonnanceContainer').append(ordonnanceHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        getOrdonnance({{ $patient->id }});

        $(document).ready(function() {
            $('.save').on('click', function(e) {

                var idmypatient = {{ $patient->id }};

                $.ajax({
                    method: "POST",
                    url: "{{ route('mypatient.update', ['idmypatient' => ':idpatient']) }}/"
                        .replace(':idpatient', idmypatient),
                    data: {
                        fname : $('input[name="fname"]').val(),
                        lname : $('input[name="lname"]').val(),
                        gender : $('select[name="gender"]').val(),
                        datenaiss : $('input[name="datenaiss"]').val(),
                        city_id : $('select[name="city_id"]').val(),
                        zip_code : $('input[name="zip_code"]').val(),
                        adresse : $('input[name="adresse"]').val(),
                        email : $('input[name="email"]').val(),
                        phone : $('input[name="phone"]').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.hasOwnProperty('danger')) {
                            let errorMessages = '';
                            $.each(response.danger, function(key, messages) {
                                errorMessages += messages.join(' ') + ' \n';
                            });
                            swal("Error!", errorMessages.trim(), "error");

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

            $(document).on('click', '.time-link', function() {
                $('.time-link').removeClass('clicked'); // Remove 'clicked' class from all time-links
                $(this).addClass('clicked'); // Add 'clicked' class to the clicked time-link
            });

            $('#observationupdate').on('submit', function(e) {
                e.preventDefault();

                var observation = $('textarea[name="observupdate"]').val();
                var idobservation = $('input[name="idobservation"]').val();
                $.ajax({
                    method: "PUT", // Use POST method
                    url: "{{ route('observation.update', ['idobservation' => ':idobservation']) }}"
                        .replace(':idobservation', idobservation),

                    data: {
                        idobservation: idobservation,
                        observation: observation
                    }, // Pass observation as an object
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('danger')) {
                            swal("Error!", response.danger, "error");
                        } else if (response.hasOwnProperty('success')) {
                            getObservations({{ $patient->id }});
                            swal("Success!", JSON.stringify(response.success), "success");
                        } else {
                            swal("Error!", "An unexpected error occurred.", "error");
                        }
                    }
                });
            });

            $('#formObservation').on('submit', function(e) {
                e.preventDefault();

                var observation = $('textarea[name="observation"]').val();
                $.ajax({
                    method: "POST", // Use POST method
                    url: "{{ route('mypatient.observation', ['idmypatient' => ':idmypatient']) }}"
                        .replace(':idmypatient', {{ $patient->id }}),

                    data: {
                        observation: observation
                    }, // Pass observation as an object
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('danger')) {
                            swal("Error!", response.danger, "error");
                        } else if (response.hasOwnProperty('success')) {
                            getObservations({{ $patient->id }});
                            swal("Success!", JSON.stringify(response.success), "success");
                        } else {
                            swal("Error!", "An unexpected error occurred.", "error");
                        }
                    }
                });
            });

            $('.formappointment').on('submit', function(e) {
                e.preventDefault();
                var yearMonth = $('select[name="year_month"]').val().split('-');
                var timeClicked = $('.time-link.clicked').data('time');
                var dayClicked = $('.time-link.clicked').closest('.item').find('.get-day')
                    .val(); // Get the day clicked

                var formData = {
                    type: $('input[name="type"]:checked').val(),
                    controle: $('input[name="controle"]:checked').val(),
                    reason: $('select[name="reason_consult"] option:selected').val(),
                    medical_information: $('textarea[name="informations"]').val(),
                    year: yearMonth[0],
                    month: yearMonth[1],
                    time: timeClicked,
                    day: dayClicked,
                };

                $.ajax({
                    method: "POST", // Use POST method
                    url: "{{ route('mypatient.makeapp', ['idmypatient' => $patient->id]) }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('danger')) {
                            let errorMessages = "";
                            if (response.danger.day) {
                                errorMessages += response.danger.day.join(", ") + "\n";
                            }
                            if (response.danger.medical_information) {
                                errorMessages += response.danger.medical_information.join(
                                    ", ") + "\n";
                            }
                            swal("Error!", errorMessages.trim(), "error");
                        } else if (response.hasOwnProperty('success')) {
                            swal("Success!", JSON.stringify(response.success), "success");
                            getAppointment({{ $patient->id }});
                        } else {
                            swal("Error!", "An unexpected error occurred.", "error");
                        }
                    }
                });
            });

            $('#appointmentUp').on('submit', function(e) {
                e.preventDefault();
                var idappointment = $('input[name="id_appointment"]').val();
                var reason = $('select[name="reason_consult_up"] option:selected').val();
                var type = $('input[name="type_consult_up"]:checked').val();
                var controle = $('input[name="controle_up"]:checked').val();
                var status = $('select[name="status"] option:selected').val();
                var info = $('textarea[name="info"]').val();
                $.ajax({
                    method: "PUT", // Use POST method
                    url: "{{ route('appointmentget.update', ['idappointment' => 'idappointment']) }}"
                        .replace('idappointment', idappointment),
                    data: {
                        reason: reason,
                        type: type,
                        controle: controle,
                        status: status,
                        info: info
                    }, // Pass observation as an object
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('danger')) {
                            swal("Error!", response.danger, "error");
                        } else if (response.hasOwnProperty('success')) {

                            swal("Success!", JSON.stringify(response.success), "success");
                            getAppointment({{ $patient->id }});
                        } else {
                            swal("Error!", "An unexpected error occurred.", "error");
                        }
                    }
                });
            });

            $(function($) {
                $('#myModal').on('change', 'select[name="year_month"]', function() {
                    // Get the selected value of the select element
                    var selectedValue = $(this).val();
                    // Split the selected value into year and month
                    var [year, month] = selectedValue.split('-');

                    // Make an AJAX request to get new items
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('getDaysInMonth') }}',
                        data: {
                            year: year,
                            month: month
                        },
                        success: function(response) {
                            // Remove existing items from the carousel
                            $('#owl-carousel-13').owlCarousel('destroy');

                            // Append new items to the carousel
                            $('#owl-carousel-13').html(response.html);

                            // Reinitialize Owl Carousel after updating content
                            $("#owl-carousel-13").owlCarousel({
                                items: 5,
                                loop: false,
                                margin: 10,
                                autoplay: false,
                                nav: true,
                                dots: false
                            });

                            // Event handlers (if needed)
                            $(".play").on("click", function() {
                                $("#owl-carousel-13").trigger(
                                    "play.owl.autoplay", [1000]);
                            });

                            $(".stop").on("click", function() {
                                $("#owl-carousel-13").trigger(
                                    "stop.owl.autoplay");
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
            var store = [];
            $(document).on('click','.addMedicament',function(){
                var row = $(this).closest('.row');

                // Find the radio button within that row
                var medicament = row.find('input[type="radio"]:checked').siblings('label').text();
                var treatment = $('#treatment').val();

                if(!medicament.trim()){
                    $('.msg').text('The medicament is obligatory');
                } else if(!treatment.trim()){
                    $('.msg').text('The treatment is obligatory');
                } else {
                    store.push({medicament: medicament, treatment: treatment});
                    // Clear previous content
                    $('#showMedicament').empty();

                    // Construct HTML for all stored medicaments
                    var add = "";
                    store.forEach(function(item) {
                        add += "<div class='row'><div class='col-md-5 mt-3'>" + item.medicament + "</div>" +
                            "<div class='col-md-5 mt-3'>" + item.treatment + "</div>" +
                            "<div class='col-md-2 mt-3'><span class='btn btn-danger'><i class='icon-trash'></i></span></div></div>";
                    });

                    // Append the new content to the container
                    $('#showMedicament').append(add);

                    // Uncheck the radio button
                    row.find('input[type="radio"]:checked').prop('checked', false);

                    // Clear the treatment input
                    $('#treatment').val('');
                }
            });

                // Attach a delegated event handler to handle delete button clicks
            $('#showMedicament').on('click', '.btn-danger', function() {
                    // Find the closest row
                var row = $(this).closest('.row');

                // Find the medicament and treatment values from the row being deleted
                var medicament = row.find('.col-md-5:first').text().trim();
                var treatment = row.find('.col-md-5:last').text().trim();

                // Find the index of the entry in the store array that matches the medicament and treatment values
                var index = store.findIndex(function(item) {
                    return item.medicament === medicament && item.treatment === treatment;
                });

                // Remove the corresponding entry from the store array
                if (index !== -1) {
                    store.splice(index, 1);
                }
                // Remove the row from the UI
                row.remove();
                // console.log(store);
            });

            $('#regForm').on('submit',function(e){
                e.preventDefault();
                var type_ord = $('input[name="type_ordonnance"]:checked').val();
                var store_med = store;
                var remarque = $('textarea[name="description"]').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('ordonnance.store', ['id' => ':idpatient']) }}".replace(':idpatient', {{ $patient->id }}),

                    data: {
                        type_ordonance: type_ord,
                        medicament : store_med,
                        remarque : remarque
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.hasOwnProperty('danger')) {
                            swal("Error!", response.danger, "error");
                        } else if (response.hasOwnProperty('success')) {

                            swal("Success!", JSON.stringify(response.success), "success");
                            $('textarea[name="description"]').val(' ');
                            $('input[name="type_ordonnance"]:checked').prop('checked', false);
                            $("#nextBtn").attr("type", "button");
                            $('#showMedicament').empty();
                            store = [];
                            getOrdonnance({{ $patient->id }});

                        } else {
                            swal("Error!", "An unexpected error occurred.", "error");
                        }
                        $('textarea[name="description"]').val(' ');
                        $('input[name="type_ordonnance"]:checked').prop('checked', false);
                        $("#nextBtn").attr("type", "button");
                        $('#showMedicament').empty();
                        store = [];
                    }
                });
            })



        });
    </script>

@endsection
